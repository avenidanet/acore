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

abstract class AbstractController {
	
	protected $model = null;
	protected $view = null;
	protected $acore = null;
	
	public function __construct(){
		$this->acore = Settings::init();
		
		$nameController = str_replace("Controller","Model",get_class($this));
		$nameView = str_replace("Controller","View",get_class($this));
		
		$this->model = new $nameController;
		$this->view = new $nameView;
	}
	/*
	 * ERROR
	 */
	public function __call($name,$params){
		echo "ACORE(Class Controller): CONTROLLER ".$name." NOT FOUND =( ";
	}
}