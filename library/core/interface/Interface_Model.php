<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Interface_Model.php
 *
 *  @version        0.1.0b
 *  @date           2012-05-18 21:20:17 -0400 (Fri, 18 May 2011)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/** 
 *  Laika_Interface_Model interface.
 *
 *  @package        Laika
 *  @subpackage     core
 *  @category       interface
 *
 *  @interface
 */
interface Laika_Interface_Model{

    public function dset($property,$value);
    public function dget($property);
    
    public static function load($id);
    public static function find($param,$value);
    
    public static function map_to_string($ignore_id);
    public static function get_map();
    
    public static function add();
    public static function delete($object);
    
    public static function count();
    public static function first();
    public static function last();
    
    public static function offset();
    public static function find_with_offset($params,$offset,$limit);
    public static function paginate();
    
    public static function collection($array);
    public static function accessible();

}