<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Content_Controller.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     control
 *	@category       control
 *	@date           2012-05-18 21:27:08 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Content_Controller class.
 * 
 * @extends Laika_Abstract_Page_Controller
 */
class Sparticle_Content_Controller extends Laika_Abstract_Page_Controller {

//-------------------------------------------------------------------
//	PROPERTIES
//-------------------------------------------------------------------

    protected static $instance;
    protected        $parameters;
    
    public    static $access_level = 'PUBLIC';
    public    static $access_group = 'USER';
    public    static $caching      = TRUE;
    
//-------------------------------------------------------------------
//	METHODS
//-------------------------------------------------------------------
	
	public function default_action(){ $this->show(); }
	
    public function __call($name,$arg){
        $user = Laika_User::find('username',$name);
        $id = $user->id();
        
        //$media = HTTP_ROOT."/media/".$name."/".$this->parameters['media'];        
        //$media = Sparticle_Media::find('path',$media);
        
        if(isset( $id ))
            $this->display(array("user"=>$id,"media"=>$media));
        else
            $this->display(array("alert"=>"User not found","alert_type"=>"warning"));        
    }

    public function show(){
        
        $media = Sparticle_Media::find('id',$this->parameters['id']);
        $user  = Laika_User::find('id',$media->user);
        
        if(isset($this->parameters['id']) && !empty($this->parameters['id'])):
            $this->display(array("page"=>"content","media"=>$media,"user"=>$user));
        else:
            $media->path = IMG_DIRECTORY."/error.png";
            $media->name = "Missing Content";
            $user->username = "nobody";
            $this->display(array("alert"=>"Content not found.","alert_type"=>"warning","media"=>$media,"user"=>$user));
        endif;
    }

    public function action_handler($action,$parameters){    
        $ignore = get_class_methods(get_parent_class(get_parent_class($this)));
        $ignore[] = 'action_handler';        
        !empty($parameters) ? $this->parameters = $parameters : $this->parameters = NULL;
        if($action == 'default')
            $this->default_action();
        else if($action == 'action_handler' | in_array($action,$ignore))
            $this->default_action();
        else
            $this->$action();    
    }
    
       
}