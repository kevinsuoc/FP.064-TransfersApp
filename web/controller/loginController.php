<?php

/*
	Controlador que se encarga de iniciar/cerrar sesión.
	Se encarga de llamar a las vistas de inicio de sesión y registro.
	Se encarga de validar los registros e inicios de sesion a través de las clases modelo.
*/
$loginController = new LoginController($request);

switch($request){
	case 'logout': $loginController->logout(); break;
	case 'login': $loginController->login(); break;
	case 'registrarse': $loginController->mostrarFormularioRegistro(); break;
	case 'intentoRegistro': $loginController->enviarSolicitudRegistro(); break;
}

class LoginController {
	public function __construct() {
	}

	/*
		Se intenta crear un Viajero, un tipo de usuario.
		Si la validación del modelo es correcta, redirigimos al login.
		Si no, volvemos a mostrar el formulario con un mensaje de error.
	 */
	public function enviarSolicitudRegistro(){
		$data = [];
		$data['nombre'] = $_POST['nombreViajero'];
		$data['apellido1'] = $_POST['apellido1Viajero'];
		$data['apellido2'] = $_POST['apellido2Viajero'];
		$data['direccion'] = $_POST['direccionViajero'];
		$data['codigoPostal'] = $_POST['codigoPostal'];
		$data['ciudad'] = $_POST['ciudadViajero'];
		$data['pais'] = $_POST['paisViajero'];
		$data['email'] = $_POST['emailViajero'];
		$data['password'] = $_POST['passwordViajero'];
		
		try {
			$viajero = new Viajero($data);
			$viajero->save();
			$this->mostrarFormularioLogin("Usuario registrado correctamente");
		} catch (PublicException $e){
			$this->mostrarFormularioRegistro("Error: ".$e->getMessage());
		}
	}

	/*
		Se intenta crear una Session.
		Si se crea correctamente se redirecciona a la pagina principal.
		Si hay un error de login (Error de validacion/formato) se vuelve a mostrar el formulario.
		Si hay un error de bases de datos, se muestra la pagina de error (Error mas grave).
	*/
	public function login(){
		try {
			$_SESSION['userSession'] = new Session($_POST['username'], $_POST['password']);
			header("Location: /"); exit();
		} catch (LoginException $e){
			$this->mostrarFormularioLogin("Error: ".$e->getMessage());
		} catch (DatabaseException $e){
			$this->mostrarPaginaError("Error con la base de datos: ".$e->getMessage());
		}
	}

	/* Remover la Session  y volver al formulario de login */
	public function logout(){
		unset($_SESSION['userSession']);
		$this->mostrarFormularioLogin("Usuario desconectado");
	}

	/* Metodos para mostrar vistas con mensajes de error/informacion*/
	public function mostrarFormularioRegistro($registrarError = null){
		require __DIR__.'/../view/forms/registrar.php';
	}

	public function mostrarFormularioLogin($loginMessage = null){
		require __DIR__.'/../view/login.php';
	}

	public function mostrarPaginaError($error){
		require __DIR__.'/../view/error.php';
	}
}
