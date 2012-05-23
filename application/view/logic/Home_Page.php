<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Home_Page.php
 *
 *	@version        0.1.0b
 *	@package        Sparticle
 *	@subpackage     view
 *	@category       view
 *	@date           2012-05-18 21:40:51 -0400 (Fri, 18 May 2012)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 * Sparticle_Home_Page class.
 * 
 * @extends Laika_Abstract_Page
 */
class Sparticle_Home_Page extends Laika_Abstract_Page{

	protected static $instance;
    protected $user;
    protected $title;
    protected $path;

    
    
    public function content(){
        if(Laika_Access::is_logged_in())
            self::render('home_hidden');
    }

    public function config(){        
        $result = Laika_Database::query("SELECT path FROM medias WHERE privacy = true ORDER BY RAND() LIMIT 1","SINGLE");
        self::init()->path = $result['path'];
    }

    public function get_feature(){
        $path = self::init()->path;
        echo Laika_Image::api_path( $path, 'auto', 500 );   
    }
    
    public function get_reflection(){
        $path = self::init()->path;
        echo Laika_Image::api_path( $path, 'reflection', 500 );
    }
    
    public function get_latest($object,$size,$percent){
        //echo '<img src="'.Laika_Image::api_path( $path, 'reflection+', $size.'x'.$percent ).'" />';
        self::img( Laika_Image::api_path($object->path,'reflection+','150x25x50'),
            array('class'=>'reflection', 'title'=>$object->name) );         
    }
    
    public function get_permalink($path){
/*
        $path = explode("/",$path);
        $media = array_pop($path);
        $user = array_pop($path);
        array_pop($path);
        echo implode("/",$path)."/content/".$user."?media=".$media;
*/      
        $media = Sparticle_Media::find('path',$path);
        echo self::init()->path_to('/content?id='.$media->id);
    }
        
    public function get_title(){
        $path = self::init()->path;
        self::init()->title = Sparticle_Media::find('path',$path)->name;
        return self::init()->title;
    }
    
    public function get_user(){
        $path = self::init()->path;
        self::init()->user = Laika_User::find('id',Sparticle_Media::find('path',$path)->user);
        return self::init()->user;
    }
    
    public function get_id(){
        $path = self::init()->path;
        return Sparticle_Media::find('path',$path)->id;
    }
    
    public function get_fav(){
        $path  = self::init()->path;
        $media = Sparticle_Media::find('path',$path);
        if(Laika_Access::is_logged_in())
            $fav = Sparticle_Favorite::is_favorite( Laika_User::active()->id, $media->id, $media->type );
        else $fav = false;
        if($fav)
            return "&#78;";
        return "&#79;";        
    }
    
    public function fullscreen(){
        $path = self::init()->path;
        echo Laika_Image::api_path( $path, 'constrain', '800x600' ); 
    }
    
    public function next_set($limit){
        $_SESSION['pagination'] = $_SESSION['pagination']+1;
        self::paginate('Sparticle_Media',$limit,array(0),'latest',array('DESC'=>'created'));
    }
}