<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Comment.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     model
 *	@category       model
 *	@date           2012-05-18 21:09:42 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Comment class.
 * 
 * @extends Laika_Abstract_Model
 */
class Sparticle_Comment extends Laika_Abstract_Model{

//-------------------------------------------------------------------
//	PROPERTIES
//-------------------------------------------------------------------

    protected        $model;
    protected        $table;
	
	protected		 $id;
	protected        $user;
	protected        $parent_type;
	protected        $parent_id;
	protected        $comment;
    protected        $created;
    protected        $updated;

//-------------------------------------------------------------------
//	METHODS
//-------------------------------------------------------------------

    public function is_owner(){
        if(Laika_Access::is_logged_in())
            if($this->user == Laika_User::active()->id)
                return true;
        return false;
    }

}