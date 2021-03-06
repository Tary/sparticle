<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Event.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 21:51:33 -0400 (Fri, 18 May 2012)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 *  Laika_Event class.
 *  
 *  The fraework event class.
 *
 *  @package        Laika
 *  @subpackage     core
 *  @category       events
 * 
 *  @extends        Laika_Singleton
 */
class Laika_Event extends Laika_Singleton{

//-------------------------------------------------------------------
//  PROPERTIES
//-------------------------------------------------------------------

    protected static $instance;

//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------

    public static function dispatch($event,$param){               
        self::log(func_get_args());
        Laika_Event_Handler::init()->handle($event,$param);    
    }
    
    public static function log($trace){
        $trace[] = date("D M j G:i:s T Y");
        $trace[] = microtime();
        //FirePHP::getInstance(true)->log($trace, 'Trace');
    }
}