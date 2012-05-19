<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Favorite_Controller.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     control
 *	@category       control
 *	@date           2012-05-18 21:27:35 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Favorite_Controller class.
 * 
 * @extends Laika_Abstract_Page_Controller
 */
class Sparticle_Favorite_Controller extends Laika_Abstract_Page_Controller {

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
	
	public function default_action(){ $this->display(array("page"=>" ")); }
	
    /**
     * favorite function.
     * 
     * @access public
     * @return void
     */
    public function favorite(){
        $id = $this->parameters['id'];
        $success = Sparticle_Favorite::mark($id);
        echo json_encode($success);
    }
    
    /**
     * unfavorite function.
     * 
     * @access public
     * @return void
     */
    public function unfavorite(){        
        $id = $this->parameters['id'];        
        $success = Sparticle_Favorite::undo(Sparticle_Favorite::find('item',$id));
        echo json_encode($success);
    }  
}