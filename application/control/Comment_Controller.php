<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Comment_Controller.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     control
 *	@category       control
 *	@date           2012-05-18 21:26:33 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Comment_Controller class.
 * 
 * @extends Laika_Abstract_Page_Controller
 */
class Sparticle_Comment_Controller extends Laika_Abstract_Page_Controller {

//-------------------------------------------------------------------
//	PROPERTIES
//-------------------------------------------------------------------

    protected static $instance;
    protected        $parameters;
    public    static $access_level = 'PUBLIC';
    public    static $access_group = 'USER';
    public    static $caching      = FALSE;
    
//-------------------------------------------------------------------
//	METHODS
//-------------------------------------------------------------------
	
	public function default_action(){ $this->pagination(); }
	
	public function add(){
	   $comment = new Sparticle_Comment();
	   $user = Laika_User::load($_REQUEST['user']);
	   
	   $comment->user = $_REQUEST['user'];
	   $comment->parent_type = $_REQUEST['parent_type'];
	   $comment->parent_id   = $_REQUEST['parent_id'];
	   $comment->comment     = $_REQUEST['comment'];
	   $comment->user_link   = '<a href="'.HTTP_ROOT.'/user/'.$user->username.'" >'.$user->username.'</a>';
	   
	      
	   Sparticle_Comment::add($comment);
	   
	   $json = array('new_comment'=>$comment->comment,'user_link'=>$comment->user_link);
	   echo json_encode($json);
	}
	
	public function delete(){
	   Sparticle_Comment::delete(Sparticle_Comment::load($_POST['id']));
	}
	
	public function pagination(){
	   $page = $this->parameters['p'];
	   $json = array('page'=>$page);
	   echo json_encode($json);
	}
}
