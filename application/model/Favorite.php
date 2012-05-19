<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Favorite.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     model
 *	@category       model
 *	@date           2012-05-18 21:36:52 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Favorite class.
 * 
 * @extends Laika_Abstract_Singleton_Model
 */
class Sparticle_Favorite extends Laika_Abstract_Singleton_Model{

//-------------------------------------------------------------------
//	PROPERTIES
//-------------------------------------------------------------------

    protected static $instance;
    protected        $model;
    protected        $table;
	
	protected		 $id;
    protected        $item;
    protected        $user;
    protected        $type;

    protected        $created;
    protected        $updated;

//-------------------------------------------------------------------
//	METHODS
//-------------------------------------------------------------------

    public static function mark($item,$type="media"){
        
        if(!Laika_Access::is_logged_in()) return array('login'=>false);
        
        $favorite = self::init();
        $favorite->user = Laika_User::active()->id;
        $favorite->item = $item;
        $favorite->type = $type;        
        
        if($favorite->is_favorite($favorite->user,$item,$type))
            return array('favorited'=>false,'login'=>true);
        
        Laika_Database::add($favorite);
        return array('favorited'=>true,'login'=>true);  
    }

    public static function undo($object){
        
        if(!Laika_Access::is_logged_in()) 
            return array('login'=>false);
        
        parent::delete($object);
        return array('unfavorited'=>true,'login'=>true);
    }
    
    public function is_favorite($user,$item,$type){
        $result = Laika_Database::query("SELECT item FROM favorites WHERE user = $user AND item = $item",'SINGLE');
        if(!isset($result) || empty($result))
            return false;
        return true;
    }
        
}