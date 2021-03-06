<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Account_Controller.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 21:56:43 -0400 (Fri, 18 May 2012)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/** 
 *  Laika_Account_Controller class.
 * 
 *  @package        Laika
 *  @subpackage     module
 *  @category       control
 *
 *  @extends        Laika_Abstract_Page_Controller
 */
class Laika_Account_Controller extends Laika_Abstract_Page_Controller {

//-------------------------------------------------------------------
//  VARIABLES
//-------------------------------------------------------------------

    protected static $instance;
    protected        $parameters;
    public    static $access_level = 'PUBLIC';
    public    static $access_group = 'USER';
    protected        $ignore       = array('action_handler','validate','add_user', 'send_confirmation', 'display_validation_errors', 'check_username');
    
//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------

    /**
     * display function.
     * 
     * @access public
     * @return void
     */
    public function display(){
        $args = func_get_args();
        $view = str_replace('_Controller', '_Page', __CLASS__);
        ob_start(OB_HANDLER);
        $view::init()->render_page($args);
        ob_end_flush();
    }

    /**
     * display_validation_errors function.
     * 
     * @access public
     * @param array $failed
     * @return void
     */
    public function display_validation_errors($failed){
        $error = 'The following errors were encountered:<br />';
        $previous = '';
        foreach($failed as $key => $message){
            if(!is_array($message))
                $error .= $message;
            else foreach($message as $key => $value){
                if($value != $previous)
                    $error .= $value;
                $previous = $value;}}
        $this->display(array("component"=>"create","alert"=>$error,"alert_type"=>"warning","autofill"=>$_POST));
    }

    /**
     * create function.
     * 
     * @access public
     * @return void
     */
    public function create(){
        $this->display(array("component"=>"create"));
    }
    
    /**
     * message function.
     * 
     * @access public
     * @return void
     */
    public function message(){
        $this->display(array("component"=>"message"));
    }
    
    /**
     * default_action function.
     * 
     * @access public
     * @return void
     */
    public function default_action(){
        $this->create();
    }
    
    /**
     * submit function.
     * 
     * @access public
     * @return void
     */
    public function submit(){
        $validation = $this->validate($_POST);
        if($validation->passed())
            $this->add_user($_POST);
        else
            $this->display_validation_errors($validation->failed());
    }
    
    /**
     * validate function.
     * 
     * @access public
     * @param array $data
     * @return void
     */
    public function validate($data){
        $check = array('email','password');
        $required[] = 'ALL';
        $custom = array(__CLASS__.'::check_username',$data['username']);        
        return Laika_Validation::validate_form($data,$check,$required,$custom);
    }

    /**
     * check_username function.
     * 
     * @access public
     * @param string $username
     * @return void
     */
    public function check_username($username){
        $result = Laika_Database::select_where('id','users',"username = '$username'");
        if($result)
            return '<li>Username already exists.</li>';
    }    

    /**
     * add_user function.
     * 
     * @access public
     * @param array $data
     * @return void
     */
    public function add_user($data){     
        $data['salt']     = rand(1,99999999);
        $data['password'] = md5($data['password'].$data['salt']);
        $data['verify']   = md5($data['verify'  ].$data['salt']); 
        
        $user = Laika_User::from_array(Laika_Validation::sanitize_form($data));
        Laika_User::add($user);
        
        $account = Laika_Account::create($data['username']);
        $account::add();

        self::send_confirmation($user);
        self::redirect_to("/account/message");
    }
    
    /**
     * send_confirmation function.
     * 
     * @access public
     * @param object $user
     * @return void
     */
    public function send_confirmation($user){
        $sender  = ADMIN_EMAIL;
        $subject = 'Registration confirmation';
        $query   = array('token'=>Laika_Account::get('token'));
        
        $link = self::link_to('Confirm your account', '/account/confirm', array('title'=>'click to confirm','style'=>'color:#3399cc;'), $query);
        $template = Laika_Mail::load_template(dirname(dirname(__FILE__)).'/view/Registration_Confirmation.php',array('link'=>$link));
        
        Laika_Mail::sendmail($user,$subject,$template,array('SENDER'=>$sender,'FORMAT'=>'html'));        
    }
     
    /**
     * resend_confirmation function.
     * 
     * @access public
     * @return void
     */
    public function resend_confirmation(){
        
        $token = md5(rand(1,99999999).SESSION_TOKEN);        
        //$user = Laika_User::find('email',$_POST['email']);
        $user  = Laika_User::find('username',$_POST['user']);
        $email = $user->email();
        $id = $user->id();
        if(isset($id)):
            $account = $user->account();
            $account->dset('token',$token);        
            self::send_confirmation($user);
            $message = "Please check your email at <$email> for a comfirmation key";
            $this->display(array("component"=>"confirm","alert"=>$message,"alert_type"=>"success"));
        else:
            $message = "The username you entered does not match our records.";
            $this->display(array("component"=>"confirm","alert"=>$message,"alert_type"=>"warning","status"=>false));
        endif;
    }     
         
    /**
     * confirm function.
     * 
     * @access public
     * @return void
     */
    public function confirm(){
        if(isset($this->parameters['token'])&&!empty($this->parameters['token'])):
            $account = Laika_Account::find('token',$this->parameters['token']);
            $token = $account->token();
            if( isset($token) ):            
                Laika_Controller::process(new Laika_Command('ACCESS','GRANT_ACCESS', NULL));
                Laika_User::bind($account->user);
                Laika_User::active()->logged_in(true);
                
                /** @todo replace with update method to reduce database calls */
                $account->dset('confirmed',true);
                $account->dset('deactivated',false);
                $account->dset('token',NULL);
                
                $message = "Thank you for activating your account.";
                $this->display(array("component"=>"confirm","alert"=>$message,"alert_type"=>"success","status"=>true));
            else:
                $message = "The confirmation key did not match our records";
                $this->display(array("component"=>"confirm","alert"=>$message,"alert_type"=>"warning","status"=>false));
            endif;
        else:
            $this->display(array("component"=>"confirm"));
        endif;
    }
}