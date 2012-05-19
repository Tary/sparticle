<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Error_Page.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 22:00:23 -0400 (Fri, 18 May 2012)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/** 
 *  Laika_Error_Page class.
 *
 *  @package        Laika
 *  @subpackage     module
 *  @category       view
 *
 *  @extends        Laika_Abstract_Page
 */
class Laika_Error_Page extends Laika_Abstract_Page{

    protected static $instance;

    /**
     * add_component function.
     * 
     * @access public
     * @param string $component
     * @return string
     */
    public function add_component($component){
        $class_name = __CLASS__;
        $page_name  = str_replace(NAME_SPACE,"", $class_name,$count = 1); 
                
        if($component == "DEFAULT")
            $page_name = str_replace('_Page',"_Component",$page_name,$count = 1);             
        else           
            $page_name = str_replace('_Page','_'.ucfirst(strtolower($component)).'_Component',$page_name,$count = 1);
        return dirname(__FILE__).'/'.$page_name.'.php';        
    }
}