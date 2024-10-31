<?php

if (isset($_GET['request'])){
	$request = $_GET['request'];
}
else {
	$request = 'homepage';
}

switch($request){
	case 'homepage': require __DIR__.'/../controller/homeController.php'; break;
	case 'login': require __DIR__.'/../controller/loginController.php'; break;
}
