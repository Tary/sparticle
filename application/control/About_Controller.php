<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     About_Controller.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     control
 *	@category       control
 *	@date           2012-05-18 21:24:05 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_About_Controller class.
 * 
 * @extends Laika_Abstract_Page_Controller
 */
class Sparticle_About_Controller extends Laika_Abstract_Page_Controller{

    protected static $instance;
    protected        $parameters;
    public    static $access_level = 'PUBLIC';
    public    static $caching      = TRUE;
    
    
    public function default_action(){ $this->display(array("page"=>"about")); }    
}