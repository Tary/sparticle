<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Logout_Controller.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     control
 *	@category       control
 *	@date           2012-05-18 21:29:04 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Login_Controller class.
 * 
 * @extends Laika_Login_Controller
 */
class Sparticle_Logout_Controller extends Laika_Login_Controller{

    protected static $instance;
    protected        $parameters;
    public    static $access_level = 'PUBLIC';
    public    static $access_group = 'USER'; 
    public    static $caching      = TRUE;
    
    public function default_action(){ parent::terminate(); }
}