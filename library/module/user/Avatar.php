<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Avatar.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 22:02:27 -0400 (Fri, 18 May 2012)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 * Laika_Avatar class.
 * 
 *  @package        Laika
 *  @subpackage     module
 *  @category       util
 *
 *  @extends        Laika
 */
class Laika_Avatar extends Laika {

//-------------------------------------------------------------------
//  VARIABLES
//-------------------------------------------------------------------

    //protected static $url;

//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------

    /**
     * img function.
     * 
     * @access public
     * @static
     * @param string $email
     * @param int $size
     * @return string
     */
    public static function img($email,$size){
         return self::get_gravatar($email,$size);       
    }    

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 512 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar | retro ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public static function get_gravatar( $email, $s, $d = '', $r = 'g', $img = true, $atts = array() ) {
        
        $d = urlencode(Laika_Image::api_path('/images/missing.png', 'square', $s));
        
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        
        if ( $img ) {
            $url = '<img src="' . $url . '" class="avatar"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}