<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Encryption.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 22:08:04 -0400 (Fri, 18 May 2012)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/** 
 * Laika_Encryption class.
 *
 *  @package        Laika
 *  @subpackage     util
 *  @category       data
 * 
 *  @extends        Laika
 */
class Laika_Encryption extends Laika{
    
    
//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------    

    public static function encrypt($key,$string){
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
    }
    
    public static function decrypt($key,$encrpted){
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }
    
}