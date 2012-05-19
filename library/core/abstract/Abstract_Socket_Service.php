<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Abstract_Socket_Service.php
 *
 *	@version        0.1.0b
 *	@date           2012-05-18 21:48:53 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/**
 * Abstract Laika_Abstract_Socket_Service class.
 *
 *	@package        Laika
 *	@subpackage     core
 *	@category       abstract
 *
 *  @abstract
 *  @extends        Laika_Singleton
 */
abstract class Laika_Abstract_Socket_Service extends Laika_Singleton{

    abstract function connect($ocket);
    abstract function disconnect();

}