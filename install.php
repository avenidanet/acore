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

if(isset($_GET['module'])){

	//name module
	$module = $_GET['module'];
	
	if(!file_exists('../'.$module)){
		$copyright = " // ACM (".$module.") created by ACore -".time()."
";
		//create directory
		mkdir('../'.$module);
		
		//create config
		$f_config = fopen('../'.$module.'/config.php', "w+");
fwrite($f_config,'<?php'.$copyright
.'$config = Settings::Init();
$config->debug = FALSE;
$config->host = "localhost";
$config->user = "root";
$config->pass = "root";
$config->database = "database";
$config->fb_apikey = "";
$config->fb_secret = "";
$config->fb_url = "https://www.facebook.com";');
		fclose($f_config);
		
		//create controller
		$f_controller = fopen('../'.$module.'/'.$module.'Controller.php', "w+");
fwrite($f_controller,'<?php'.$copyright
.'class '.$module.'Controller extends AbstractController{
	
}');
		fclose($f_controller);
		
		//create model
		$f_model = fopen('../'.$module.'/'.$module.'Model.php', "w+");
fwrite($f_model,'<?php'.$copyright
.'class '.$module.'Model extends AbstractModel{
	
}');
		fclose($f_model);
		
		//create view
$f_view = fopen('../'.$module.'/'.$module.'View.php', "w+");
fwrite($f_view,'<?php'.$copyright
.'class '.$module.'View extends AbstractView{
	
}');
		fclose($f_view);
		
		//create index
		$index = fopen('../'.$module.'/index.php', "w+");
fwrite($index,'<?php'.$copyright.'?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ACM ('.$module.') | ACore Simple framework php</title>
</head>
<body>	
</body>
</html>');
		fclose($index);
		
		echo "<h2>Module created!.</h2>
		<p><strog>Do not forget to delete this file when you create modules</strog></p>
		<p>Add <strong>&delete=0</strong> at the end of the url to delete the file.</p>";
		
		if(isset($_GET['delete'])){
			unlink('install.php');
		}	
	}else{
		echo "<h2>Module already exists.</h2>";
	}

}else{
	echo "<h2>Module not created.</h2>";
}