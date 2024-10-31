<?php

if (isset($_REQUEST['request'])){
	$request = $_REQUEST['request'];
}
else {
	$request = 'homepage';
}

switch($request){
	case 'homepage': require __DIR__.'/../controller/homeController.php'; break;
	case 'login': require __DIR__.'/../controller/loginController.php'; break;
	case 'logout': require __DIR__.'/../controller/loginController.php'; break;
}
