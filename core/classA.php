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

//TOOLS

class A{
	
	public static function script($data,$load=''){
		$CDN = array(	'jquery'=>'<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>',
						'angular'=>'<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular.min.js"></script>',
						'swfObject'=>'<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>');
		$jss = explode(',',$data);
		foreach ($jss as $js){
			echo $CDN[$js];
		}
		if($load != ''){
			$jss = self::files($load);
			foreach ($jss as $js){
				echo '<script src="'.$js.'"></script>';
			}
		}
	}
	
	public static function ng_params(){
		return json_decode(file_get_contents('php://input'));
	}
		
	public static function log($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	
	public static function f_log($data){
		$css = "<style>#ac_debug{-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;-moz-box-shadow: 10px 10px 5px #888;-webkit-box-shadow: 10px 10px 5px #888;box-shadow: 10px 10px 5px #888; position:absolute; padding: 10px; top: 10px; left:10px; border: 1px solid #333; color: #666; background: #eee}</style>";
		echo $css."<div id='ac_debug'><pre>";
		print_r($data);
		echo "</pre></div>";
	}
	
	public static function getUrl($url,$type=NULL,$paramsPOST = array(),$paramsGET = array()){
	
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		if(!empty($paramsPOST)){
			$fields_string = http_build_query($paramsPOST);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		}
		if(!empty($paramsGET)){
			$fields_string = http_build_query($paramsGET);
			$url .= "?".$fields_string;
		}
		curl_setopt($ch, CURLOPT_URL, $url);
	
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
	
		$result['output'] = $output;
		$result['info'] = $info;
	
		if($type == "XML"){
			$result['parse'] = new SimpleXMLElement($output);
		}elseif ($type == "JSON") {
			$result['parse'] = json_decode($output);
		}else{
			$result['parse'] = $output;
		}
		return $result;
	}

	public static function validate($string,$type='text'){
		$patterns = array(	'text'=>'/^[a-z\d_ .áéíóúñ]{1,255}$/i',
							'number'=>'/^[0-9]{1,20}$/i',
							'name'=>'/^[a-z\d_ .áéíóúñ]{4,60}$/i',
							'email'=>'/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',
							'id'=>'/^\d{1,2}[-]\d{4}[-]\d{4}$/',
							'phone'=>'#^\d{4}[\s\.-]?\d{4}$#');
		if (trim($string) != "") {
			if (preg_match($patterns[$type], $string)) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public static function files($path){ 
		if (is_dir($path)) { 
			if ($dh = opendir($path)) { 
				$files = array();
				while (($file = readdir($dh)) !== false) { 
					if (!is_dir($path . $file)){
						$files[] = $path.$file;
					}
				} 
				closedir($dh);
				return $files;
			} 
		}
	}
	/*
	 * ERROR
	 */    
	public function __call($name,$params){
		echo "ACORE(Class ACore Main): FUNCTION ".$name." NOT FOUND =( ";
	}	
}