<?php
global $pageTitle;

require_once __DIR__.'/../util/Session.php';
session_start();
//include __DIR__ . '/../view/head.php';

/*
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransfersApp</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
*/
?>
    <?php
    //include __DIR__ . '/../view/header.php';

    if (isset($_REQUEST['request'])){
        $request = $_REQUEST['request'];
    } else {
        $request = 'homepage';
    }

    switch($request) {
        case 'registrarse':
        case 'login':
        case 'logout': 
            require __DIR__.'/../controller/loginController.php'; 
            break;
        case 'reservar':
        case 'reserva': 
            require __DIR__.'/../controller/reservaController.php'; 
            break;
        case 'homepage':
        default: 
            require __DIR__.'/../controller/homeController.php';
    }
?>

