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
		
		$mensaje = "<h2>Module created!.</h2>
		<p><strog>Do not forget to delete this file when you create modules</strog></p>";
		
		if(isset($_GET['delete'])){
			unlink('install.php');
		}
		
		//create structure
		if(isset($_GET['structure']) && $_GET['structure'] != ''){
			$folders = explode(',',$_GET['structure']);
			foreach($folders as $folder){
				mkdir('../'.trim($folder));
			}
			$init = fopen('../index.php', "w+");
			fwrite($init, '<?php'.$copyright.'
include "acore/acore.php";
$app = new acore;
?>
html:5>div#container');
			fclose($init);
		}
		
		//create init file AngularJS
		if(isset($_GET['angular'])){
			mkdir('../js');
			$angular = fopen('../js/app.js', "w+");
			fwrite($angular,'/**
* ACM ('.$module.') created by ACore -'.time().'
*/

/* Main module */		
		
angular.module("'.$module.'", []).
  config(["$routeProvider", function($routeProvider) {
  $routeProvider.
      when("/OPTION_URL/:OPTION", {templateUrl: "TEMPLATE.HTML",   controller: NAME_CONTROLLER}).
      otherwise({redirectTo: "/OPTION_URL"});
}]);

/* Controllers */
		
function NAME_CONTROLLER($scope, $routeParams, $location, $http){
	$scope.ATTRIBUTE = $routeParams.OPTION;
	$scope.METHOD = function(){
		 $location.path("/OPTION_URL");
	}
	$http.post("FILE_MODEL.PHP",{PARAMS: "VALUE"}).
	success(function(data) {
		$scope.ATTRIBUTE = data;
	}).
	error(function() {
		console.log("error");
	})			
}');
			fclose($angular);			
		}
		
		//create init file AngularJS
		if(isset($_GET['css'])){
			mkdir('../css');
			$css = fopen('../css/'.$module.'.css', "w+");
			fwrite($css,'/**
* ACM ('.$module.') created by ACore -'.time()."
*/
/* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
*/
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
		
/* CSS Module ".$module." */");
			fclose($css);
		}		
		
	}else{
		$mensaje = "<h2>Module already exists.</h2>";
	}

}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ACM (install) | ACore Simple framework php</title>
	<style>
	* {margin: 0; padding: 0}
	body {font-family: Arial; font-size: 12px}
	#container {width: 300px; margin: 0 auto}
	fieldset {padding: 10px}
	legend {padding: 5px}
	label, input {display: block; padding: 5px 0}
	div {padding: 10px 0}
	</style>	
</head>
<body>
	<div id="container">
		<h1>Install module | ACore</h1>

		<div class="module">
			<form action="install.php" method="get">
				<fieldset>
					<legend>Basic</legend>
					<label for="module">Module name ('main' recommended)</label>
					<input type="text" name="module" value="main"/>
					<label for="structure">Write base structure. Folders (css, js, imgs)</label>
					<input type="text" name="structure" value="css,js,imgs"/>
					<label for="delete"><strong>Delete this file after installation.</strong></label>
					<input type="checkbox" name="delete" checked="checked"/>
				</fieldset>
				<fieldset>
					<legend>Other options</legend>
					<label for="demo">Create demo files. (Not available)</label>
					<input type="checkbox" name="demo"/>
					<label for="angular">Create files for AngularJS.</label>
					<input type="checkbox" name="angular"/>
					<label for="css">Create reset css.</label>
					<input type="checkbox" name="css"/>
				</fieldset>
				<div>
				<input type="submit" value="Create module"/>
				</div>
			</form>
		</div>
		
		<div class="mensaje">
			<?php echo $mensaje?>
		</div>
	</div>
</body>
</html>