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

class Template{
	
	private $templates = array();
	
    public function __call($name,$params) {
		if (array_key_exists($name, $this->templates)) {
           return $this->getTemplate($name,$params[0]); 
        }else{
		   echo "No template!!";		
        }
    }
    
    public function __set($name,$value) {
		$this->templates[$name] = $value; 
    }
    
    private function getTemplate($name_template,$data){
    	if(isset($this->templates[$name_template])){
    		$template_origin = $this->templates[$name_template];
    	}else{
    		$template_origin = $name_template;
    	}
    	$fields = array();
    	$values = array();
    	foreach ($data as $field => $value ){
    		$fields[] = ":".$field;
    		if(is_array($value)){
    			foreach ($value[1] as $v){
    				$nuevos .= $this->getTemplate($value[0], $v);
    			} 
    			$values[] = $nuevos;
    		}else{
    			$values[] = $value;
    		}
    	}
    	$output  = str_replace($fields, $values, $template_origin);
    	return $output;
    }
}