<?php
/**
* ACore v.5.1.0
*
* Simple framework php
*
* @author Brian Salazar [Avenidanet]
* @link http://www.avenidanet.com
* @copyright Brian Salazar 2006-2013
* @license http://mit-license.org
* 
*/

function __autoload($className) {
	require_once('core/class' . $className . '.php');
}

class acore{
	
	private $controllers = array();
	private $path = "";
	private $config;

	public function __construct($level = 0){
		if (!session_id()) {
	      session_start();
	    }
		include_once("settings.php");
		$this->setLevel($level);
		$this->config = Settings::Init();
		if($this->config->debug){
			error_reporting(-1);
		}else{
			error_reporting(0);
		}
	}
	
	private function setLevel($level){
		for($i=0; $i < $level; $i++){
			$this->path .= "../";
		}
	}	
	
	private function addModule($nameModule){
		$controller = $this->path.$nameModule.'/'.$nameModule."Controller.php";
		$model = $this->path.$nameModule.'/'.$nameModule."Model.php";
		$view = $this->path.$nameModule.'/'.$nameModule."View.php";
		$file_config = $this->path.$nameModule.'/config.php';
		
		if(file_exists($controller) && file_exists($model) && file_exists($view)){
			include_once($controller);
			include_once($model);
			include_once($view);

			if(file_exists($file_config)){
				include_once($file_config);
			}
			
			$classController = $nameModule . "Controller";
			$this->controllers[$nameModule] = new $classController;

			return $this->controllers[$nameModule];
		}else{
			echo "ACORE(core): MODULE ".$nameModule." NOT COMPLETE =( ";
			return FALSE;
		}
	}		

    public function __get($name) {
		if (!array_key_exists($name, $this->controllers)) {
            return $this->addModule($name);
        }else{
			return $this->controllers[$name];
        }
    }

    /*
     * ERROR
     */
	public function __call($name,$params){
		echo "ACORE(core): METHOD ".$name." NOT FOUND =( ";
	}
}