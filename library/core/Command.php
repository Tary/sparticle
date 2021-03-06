<?php
/**
 *  LAIKA FRAMEWORK Release Notes:
 *
 *  @filesource     Command.php
 *
 *  @version        0.1.0b
 *  @date           2010-01-18 22:21:21 -0500 (Mon, 18 Jan 2010)
 *
 *  @author         Leonard M. Witzel <witzel@post.harvard.edu>
 *  @copyright      Copyright (c) 2010 Harvard University <{@link http://lab.dce.harvard.edu}>
 *
 */
/**
 *  Laika_Command class.
 * 
 *  Framework level class for wrapping the initiatial request 
 *  into a command that can be passed to the application layer
 *
 *  @package        Laika
 *  @subpackage     core
 *  @category       control
 *
 *  @extends        Laika
 */
class Laika_Command extends Laika{

//-------------------------------------------------------------------
//  VARIABLES
//-------------------------------------------------------------------

    private $class_name  = NULL;
    private $method      = NULL;
    private $params      = NULL;
    

//-------------------------------------------------------------------
//  CONSTRUCTOR
//-------------------------------------------------------------------     
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     *
     * @todo maybe this function could be made a lot stricter
     */
    public function __construct(){
        func_num_args() == 3 ? $args = func_get_args() : 
          $this->setError( 'Invalid parameter construct' );
        
        isset($args[0]) && !empty($args[0]) ? $this->class_name  = $args[0] : 
          $this->setError( 'Invalid argument at parameter[0]' );
        isset($args[1]) && !empty($args[1]) ? $this->method      = $args[1] : 
          $this->setError( 'Invalid argument at parameter[1]' );
        isset($args[2]) && !empty($args[2]) ? $this->params      = $args[2] : 
          //$this->setError( 'Invalid argument at parameter[2]' );
          $this->params = NULL;  
    }    

//-------------------------------------------------------------------
//  METHODS
//-------------------------------------------------------------------    
    /**
     * validate_command function.
     * 
     * @access public
     * @return void
     */
    public function validate_command(){    
      //$class = NAME_SPACE.ucfirst(strtolower(( $this->class_name )));
      $class = $this->get_class_name();
      method_exists($class, strtolower($this->method)) ? $exists = true : $exists = false;
      return $exists;
    }
    
    /**
     * get_class_name function.
     * 
     * @access public
     * @return void
     */
    public function get_class_name(){ 
        $class_name = Laika_Data::format_class_name($this->class_name);
        return NAME_SPACE.$class_name; 
    }
    
    /**
     * get_method_name function.
     * 
     * @access public
     * @return void
     */
    public function get_method_name(){ return strtolower($this->method); }
    /**
     * get_parameters function.
     * 
     * @access public
     * @return void
     */
    public function get_parameters(){ return $this->params; }      
    
    /**
     * setError function.
     * 
     * @access public
     * @param mixed $error
     * @return void
     */
    public function setError( $error ){
        throw new Laika_Exception('INVALID_COMMAND:['.$error.']',901);
                
        //Event::init()->reportError(new Laika_Error($error) );
        
        //Event::init()->type('ERROR')->level('FATAL',$error);        
        //throw new Exception('Command Fault');
    }
}