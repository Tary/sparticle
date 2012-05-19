<?php
/**
 *	LAIKA FRAMEWORK Release Notes:
 *
 *	@filesource     Interface_DB_Driver.php
 *
 *	@version        0.1.0b
 *	@date           2012-05-18 21:18:58 -0400 (Fri, 18 May 2011)
 *
 *	@author         Leonard M. Witzel <witzel@post.harvard.edu>
 *	@copyright      Copyright (c) 2012  Laika Soft <{@link http://oafbot.com}>
 *
 */
/** 
 *  Laika_Interface_DB_Driver interface.
 *
 *	@package        Laika
 *	@subpackage     core
 *	@category       interface
 *
 *  @interface
 */
interface Laika_Interface_DB_Driver{


    public static function connect();
    public static function disconnect();
    
    public function select_by($id,$table);
    public function select_all($table);
    public function select_where($subject,$table,$condition);
    public function query($statement,$return);
        
    public function update($table, $record, $data, $condition);
    public function insert($table,$columns,$values);
    public function create($table,$params);
    public function add($object);
    public function show($table);
    public function delete($table,$id);
    //public function drop($table);
    //public function get_num_rows();
    //public function get_error();
    //public function free_result();
}