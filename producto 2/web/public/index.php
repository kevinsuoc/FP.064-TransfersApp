
    <?php

	global $pageTitle;
	// Necesario para que la sesion no se destruya por tener tipos de datos desconocidos
	require_once __DIR__.'/../util/Session.php';

	// Cargamos la sesion para el resto de los controladores
	session_start();

		/*
		Punto de entrada de la aplicacion.
		Recibe una solicitud con un parametro 'request'.
		A partir de este se selecciona un controlador.
		Si no existe, se redirige a la pagina inicial.
	
		Variables relevantes:
		
		$_REQUEST['request']. - A través de un post/get se redirige a algun controlador.
	*/
	
	// Si no hay solicitud vamos a la homepage
	$request = $_REQUEST['request'] ?? 'homepage';
	
	include __DIR__ . '/../view/head.php';
    include __DIR__ . '/../view/header.php';


	try {
		// De acuerdo al parametro request, seleccionamos el controlador adecuado.
		switch($request){
			case 'registrarse': // Para registrar un viajero
			case 'login': // Para iniciar sesion
			case 'intentoRegistro': // Para registrar un viajero
			case 'actualizarPassword': // Para cambiar la password
			case 'actualizarViajero': // Para editar el perfil
			case 'logout': require __DIR__.'/../controller/loginController.php'; break;
			case 'reservar': // Para reservar
			case 'actualizarReserva':  // Para editar la reserva
			case 'eliminarReserva': // Para eliminar una reserva
			case 'reserva': require __DIR__.'/../controller/reservaController.php'; break;
			case 'panelReservas':
			case 'panelVehiculos':
			case 'panelDestinos':
			case 'filtroReservas':
			case 'filtroTrayectos':
			case 'eliminarZona':
			case 'eliminarHotel':
			case 'eliminarVehiculo':
			case 'eliminarReservaAdmin':
			case 'agregarZona':
			case 'agregarHotel':
			case 'agregarVehiculo':
			case 'actualizarZona':
			case 'actualizarHotel':
			case 'actualizarVehiculo':
			case 'actualizarReservaAdmin':
			case 'mostrarCalendario': require __DIR__.'/../controller/adminController.php'; break;
			case 'homepage': // Para la pagina principal
			default: require __DIR__.'/../controller/homeController.php';
		}
	} catch (PrivateException $e){
		$error = "Error con la base de datos: ".$e->getMessage();
		require __DIR__.'/../view/error.php';
	}
	
    ?>
</body>
</html>
