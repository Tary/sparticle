<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Active_Session.php
 *
 *	@version        0.1.0b
 *	@date           2012-05-18 22:04:52 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/**
 *  Laika_Active_Session class.
 *
 *  Records active sessions
 * 
 *	@package        Laika
 *	@subpackage     module
 *	@category       model
 *
 *  @extends        Laika_Abstract_Singleton_Model
 */
class Laika_Active_Session extends Laika_Abstract_Singleton_Model{

//-------------------------------------------------------------------
//	PROPERTIES
//-------------------------------------------------------------------

    protected static $instance;
    protected        $session;
    protected        $user_id;

    protected        $created;
    protected        $updated;

//-------------------------------------------------------------------
//	METHODS
//-------------------------------------------------------------------

    /**
     * find_user function.
     * 
     * Looks up the user associated with a session id.
     *
     * @access public
     * @static
     * @param mixed $session
     * @return void
     */
    public static function find_user($session){
        $result = Laika_Database::select_where('user_id','active_sessions',"session = '$session'");
        return $result['user_id'];
    }    
    
    /**
     * register function.
     *
     * Registers a session in the database.
     * 
     * @access public
     * @static
     * @param mixed $id
     * @return void
     */
    public static function register($id){
        $session = $_SESSION['LOGIN_TOKEN'];
        $statement = "INSERT INTO active_sessions (session,user_id,created) VALUES ('$session',$id,NULL)";
        $result = Laika_Database::query($statement,'INSERT');    
    }
    
    /**
     * unregister function.
     * 
     * Unregisters a session from the database. 
     * The session can be a current or a previous session.
     *
     * @access public
     * @static
     * @param mixed $id
     * @param mixed $current
     * @return void
     */
    public static function unregister($id,$current){
        if($current)
            $session = $_SESSION['LOGIN_TOKEN'];
        else if(isset($_SESSION['PREVIOUS_TOKEN']))
            $session = $_SESSION['PREVIOUS_TOKEN'];
        if(isset($session)){
            $statement = "DELETE FROM active_sessions WHERE session = '$session' AND user_id = $id";
            Laika_Database::query($statement,'DELETE');
        }                
    }
}