<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Uploader.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 22:10:55 -0400 (Fri, 18 May 2012)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laikasoft <{@link http://oafbot.com}>
 *
 */
/**
 *  Laika_Uploader class.
 * 
 *  @package        Laika
 *  @subpackage     util
 *  @category       file
 *
 *  @extends        Laika_Singleton
 */
class Laika_Uploader extends Laika_Singleton {

//-------------------------------------------------------------------
//  PROPERTIES
//-------------------------------------------------------------------

    //const UPLOAD_PATH   = LAIKA_ROOT.'/tmp/uploads';
    //const MAX_FILE_SIZE = 1073741824; // 1048576KB, 1024M, 1G
    
    protected static $instance;
    
        
//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------

    /**
     * upload function.
     * 
     * @access public
     * @param mixed $F
     * @return string
     */
    public function upload($F){
        
        $target = Laika_ROOT.'/tmp/uploads/'.basename($F['name']); 
        $error  = 0; 
     
        if($F['size'] > MAX_FILE_SIZE) 
            $error = 720; 
      
        if($F['type'] == "text/php") 
            $error = 750; 
    
        if($error!=0)
            self::upload_error($error);
            //throw new Laika_Exception('UPLOAD_USER_ERROR',$error);
        
        elseif(move_uploaded_file($F['tmp_name'], $target))    
            return $target; 
        else self::upload_error($error);    
        //throw new Laika_Exception('UPLOAD_MOVE_ERROR',$error);
    }
    
    /**
     * upload_error function.
     * 
     * @access public
     * @static
     * @param mixed $error
     * @return void
     */
    public static function upload_error($error){
        Laika_Event::dispatch('UPLOAD_ERROR',$error);
    }
       
}