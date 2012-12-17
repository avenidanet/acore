<?php
/**
* ACore v.5.0.0
*
* Simple framework php
*
* @author Brian Salazar [Avenidanet]
* @link http://www.avenidanet.com
* @copyright Brian Salazar 2006-2013
* @license http://mit-license.org
* 
*/

class Settings{
    
	private $vars = array();
    private static $instance = null;

    private function __construct(){
    }

    public static function init()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
 		return self::$instance;
    }
 
    public function __get($name) {
		if(isset($this->vars[$name])){
    		return $this->vars[$name];
		} else {
			echo "Variable no definida";
		}
    }
    
    public function __set($name, $value) {
    	$this->vars[$name] = $value;
    }
}