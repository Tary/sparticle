<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Account.php
 *
 *	@version        0.1.0b
 *	@date           2012-05-18 21:58:08 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/** 
 * Laika_Account class.
 * 
 *	@package        Laika
 *	@subpackage     module
 *	@category       model
 *
 *  @extends        Laika_Abstract_Singleton_Model
 */
class Laika_Account extends Laika_Abstract_Singleton_Model{

//-------------------------------------------------------------------
//	VARIABLES
//-------------------------------------------------------------------

    protected static $instance;
    protected        $model;
    protected        $table;

    protected        $id;
    protected        $user;
    protected        $token;
    protected        $confirmed;
    protected        $deactivated;
    protected        $created;
    protected        $updated;
    
//-------------------------------------------------------------------
//	METHODS
//-------------------------------------------------------------------

    public static function create($username){
        
        $account = self::init();        
        $user = Laika_User::find('username',$username);              
     
        $account->user($user->id);
        $account->token(md5($user->salt().SESSION_TOKEN));
        $account->confirmed(false);
        $account->deactivated(false);
        $account->created(date("Y-m-d")); /**@todo Create database date wrapper in the Time class*/
        
        return $account;
    }    
}