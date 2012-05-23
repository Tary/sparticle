<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Media.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     model
 *	@category       model
 *	@date           2012-05-18 21:36:20 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Media class.
 * 
 * @extends Laika_Abstract_Model
 */
class Sparticle_Media extends Laika_Abstract_Model{

//-------------------------------------------------------------------
//	PROPERTIES
//-------------------------------------------------------------------

    protected        $model;
    protected        $table;
	
	protected		 $id;
	protected        $user;
	protected        $name;
	protected        $path;
	protected        $type;
	protected        $privacy;
	protected        $access_group;
    protected        $description;
 
    protected        $created;
    protected        $updated; 
    
//-------------------------------------------------------------------
//	METHODS
//-------------------------------------------------------------------


    public function get_filename(){
        $path = $this->path;
        return array_pop(explode("/",$path));
    }
    
}