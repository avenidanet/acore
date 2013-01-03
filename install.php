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

function create_file($path_name,$content){
	$file= fopen($path_name, "w+");
	fwrite($file,$content);
	fclose($file);	
}

if(isset($_GET['module'])){

//Templates
$module = $_GET['module'];
	
$copyright = " // ACM (".$module.") created by ACore -".time()."
";
	
$config = '<?php'.$copyright
.'$config = Settings::Init();
$config->debug = FALSE;
$config->host = "localhost";
$config->user = "root";
$config->pass = "root";
$config->database = "database";
$config->fb_apikey = "";
$config->fb_secret = "";
$config->fb_url = "https://www.facebook.com";';
	
$controller = '<?php'.$copyright
.'class '.$module.'Controller extends AbstractController{
		
}';

$model = '<?php'.$copyright
.'class '.$module.'Model extends AbstractModel{
	
}';

$view = '<?php'.$copyright
.'class '.$module.'View extends AbstractView{
	
}';

$index_module = '<?php'.$copyright.'?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ACM ('.$module.') | ACore Simple framework php</title>
</head>
<body>	
</body>
</html>';

$init = '<?php'.$copyright.'
include "acore/acore.php";
$app = new acore;
?>
html:5>div#container';

$angular = '/**
* ACM ('.$module.') created by ACore -'.time().'
*/

/* '.$module.' | angularjs module */

angular.module("'.$module.'", []).
  	config(function($routeProvider,$locationProvider) {
	  	$routeProvider.
	    when("/OPTION_URL/:OPTION", {templateUrl: "TEMPLATE.HTML",   controller: NAME_CONTROLLER}).
	    otherwise({redirectTo: "/OPTION_URL"});
		$locationProvider.html5Mode(true);
	}).
  	run(function(){ //Init }).
	value("CONSTANT", 123).
  	factory("METHOD", function() {
		return function(text){
			return text; //Methods
	  	}
  	}).
	filter("NAME_FILTER", function(){
		return function() {
			return "FILTER"; //Format
		};
  	}).
  	directive("TAG",function(){
	  	return function(element){
			return element; //Custom tags ng
		}
  	});

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
}';

$css = '/**
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

/* CSS Module ".$module." */
";

$index_html = "";
	
	if(!file_exists('../'.$module)){

		//create directory
		mkdir('../'.$module);
		
		create_file('../'.$module.'/config.php', $config);
		create_file('../'.$module.'/'.$module.'Controller.php', $controller);
		create_file('../'.$module.'/'.$module.'Model.php', $model);
		create_file('../'.$module.'/'.$module.'View.php', $view);
		create_file('../'.$module.'/index.php', $index_module);
		
		$mensaje = "<h2>Module created!.</h2>";
		
		if(isset($_GET['delete'])){
			unlink('install.php');
		}else{
			$mensaje .= "<p><strog>Do not forget to delete this file when you create modules</strog></p>";
		}
		
		//create structure
		if(isset($_GET['structure']) && $_GET['structure'] != ''){
			$folders = explode(',',$_GET['structure']);
			foreach($folders as $folder){
				mkdir('../'.trim($folder));
				create_file('../'.trim($folder).'/index.html', $index_html);
			}
			create_file('../index.php', $init);
		}
		
		//create init file AngularJS
		if(isset($_GET['angular'])){
			mkdir('../js');
			create_file('../js/app.js', $angular);			
		}
		
		//create css reset
		if(isset($_GET['css'])){
			mkdir('../css');
			create_file('../css/'.$module.'.css', $css);
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