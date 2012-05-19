<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Content_Page.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     view
 *	@category       view
 *	@date           2012-05-18 21:40:11 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Content_Page class.
 * 
 * @extends Laika_Abstract_Page
 */
class Sparticle_Content_Page extends Laika_Abstract_Page{

	protected static $instance;


    public function fullscreen(){
        $media = self::init()->media;        
        echo Laika_Image::api_path( $media->path, 'constrain', '800x600' ); 
    }

}