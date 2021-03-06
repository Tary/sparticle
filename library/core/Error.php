<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Error.php
 *
 *  @version        0.1.0b
 *  @date           2011-05-21 03:14:48 -0400 (Sat, 21 May 2011)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2011  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 *  Laika_Error class.
 *  
 *  The Error class.
 *
 *  @package        Laika
 *  @subpackage     core
 *  @category       error
 * 
 *  @extends        Laika_Singleton
 */
class Laika_Error extends Laika_Singleton{

//-------------------------------------------------------------------
//  VARIABLES
//-------------------------------------------------------------------

    protected static $instance;

//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------
    public function error_handler($code, $message, $file, $line ){
        throw new ErrorException($message, $code, 0, $file, $line);
    }
}
