<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Login_Controller.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 22:01:04 -0400 (Fri, 18 May 2012)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 *  Laika_Login_Controller class.
 * 
 *  Controller for the login module.
 *  
 *  @package        Laika
 *  @subpackage     module
 *  @category       control
 *
 *  @extends        Laika_Abstract_Page_Controller
 */
class Laika_Login_Controller extends Laika_Abstract_Page_Controller{

//-------------------------------------------------------------------
//  PROPERTIES
//-------------------------------------------------------------------

    protected static $instance;
    protected        $parameters;
    public    static $access_level = 'PUBLIC';
    public    static $access_group = 'USER'; 


//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------

    /**
     * display function.
     *
     * Same as the display method defined in Laika_Abstract_Page_Controller
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
     * default_action function.
     * 
     * Default action is to display the login page unless already logged in.
     *
     * @access public
     * @return void
     */
    public function default_action(){ 
        if($_SESSION['LOGIN_TOKEN']==SESSION_TOKEN):
            Laika_Active_User::init()->logged_in(true);
            $this->redirect();
        else:
            $this->display(array("page"=>"login"));
        endif;
    }
    
    /**
     * authenticate function.
     *
     * Checks login status and prompts for login or reroutes to requested page
     * 
     * @access public
     * @param mixed $user
     * @param mixed $pass
     * @return void
     */
    public function authenticate($user, $pass){                
        if($_SESSION['LOGIN_TOKEN']==SESSION_TOKEN)
            $this->redirect();
        else
            $this->verify_credentials($user, $pass);
    }
    
    /**
     * redirect function.
     * 
     * Redirect to the requested page.
     *
     * @access public
     * @return void
     */
    public function redirect(){        
        if( isset($_SESSION['REDIRECT']) )
            header("Location: ".$_SESSION['REDIRECT']);
        else 
            self::redirect_to(DEFAULT_LOGIN_REDIRECT);        
        $_SESSION['REDIRECT']=NULL;
    }
    
    /**
     * denied function.
     * 
     * Displays the login denied page.
     * Terminates the session.
     *
     * @access public
     * @return void
     */
    public function denied(){
        Laika_Controller::process(new Laika_Command('ACCESS','DESTROY_SESSION', NULL));        
        $this->display(array(
            "alert"       => "Access denied: Invalid username or password.", 
            "alert_type"  => "warning", 
            "page"        => "login"));
            
        Laika_Event::dispatch('ACCESS_DENIED',__FILE__);        
    }
    
    /**
     * terminate function.
     * 
     * Terminates the session.
     * Hibernates the user.
     * Sets the login status of the user to false.  
     * Destroys the session and unregisters the user from the Registry.  
     *  
     * @access public
     * @return void
     */
    public function terminate(){
        Laika_Active_User::sleep();
        Laika_Active_User::init()->logged_in(false);
        Laika_Controller::process(new Laika_Command('ACCESS','DESTROY_SESSION', NULL));        
        Laika_Registry::unregister("Active_User");        
        $this->display(array(
            "alert"       => "You logged out sucessfully.", 
            "alert_type"  => "success", 
            "page"        => "login"));
            
        Laika_Event::dispatch('LOG_OUT',__FILE__);
    }
    
    /**
     * verify_credentials function.
     *
     * If submitted password and database records match
     * Change the state of the Access object,
     * Load and register user in the Registry,
     * Set login status of the user to true,
     * Check if the user account is confirmed and activated
     *
     * @access public
     * @param mixed $user
     * @param mixed $pass
     * @return void
     */
    public function verify_credentials($user, $pass){
        
        $result = Laika_Database::select_where('id,password,salt','users',"username = '{$user}'");
        
        if( $result['password'] == md5($pass.$result['salt']) ):
            
            /* Change Access state */
            Laika_Controller::process(new Laika_Command('ACCESS','GRANT_ACCESS', NULL));
            
            /* Load and register user in the Registry */
            Laika_User::bind($result['id']);
            
            /* Set user status to logged in */
            Laika_User::active()->logged_in(true);
            
            /* Check if the user account is confirmed and activated */
            if( Laika_User::active()->valid_account() )
                $this->redirect();
            else
                self::redirect_to('/login/activation');
        else:            
            self::redirect_to('/login/denied');
        endif;
        
    }
    
    /**
     * activation function.
     * 
     * Displays the activation page.
     * Terminates the session.
     *
     * @access public
     * @return void
     */
    public function activation(){
        Laika_Controller::process(new Laika_Command('ACCESS','DESTROY_SESSION', NULL));
        $this->display(array("component"=>"activation"));
    }
}