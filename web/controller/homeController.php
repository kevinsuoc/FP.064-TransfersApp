<?php

/*
	Controlador que se encarga de redireccionar a la pagina principal.
	En caso de existir una sesion, esta es la pagina de login.
	En caso de ser un usuario, la pagina principal sera la correspondiente.
	En otro caso, se da un error.

	Esto podría ser una simple funcion, pero se usa una clase
	para mantener la consistencia de diseño con otros controladores.
*/

require_once __DIR__.'/../model/TipoReserva.php';

$homeController = new HomeController();
$homeController->mostrarHomepage();

class HomeController {
	public function __construct() {
	}

	/*
		Los tipos de reserva son utilizados por las vistas para mostrar
		a los usuarios las opciones adecuadas.
	*/
	public function mostrarHomepage() {
		if (!isset($_SESSION['userSession'])){
			require __DIR__.'/../view/login.php';
		}
		else if ($_SESSION['userSession']->getSessionType() === sessionType::admin){
			$this->mostrarAdminHomepage(TipoReserva::getTiposReserva());
		}
		else if ($_SESSION['userSession']->getSessionType() === sessionType::regular){
			$this->mostrarRegularHomepage(TipoReserva::getTiposReserva());
		}
		else {
			unset($_SESSION['userSession']);
			$this->mostrarErrorPage("Tipo de usuario desconocido");
		}
	}

	private function mostrarError($error){
		require __DIR__.'/../view/error.php';
	}

	private function mostrarAdminHomepage($tiposReserva){
		require __DIR__.'/../view/homepage/admin.php';
	}

	private function mostrarRegularHomepage($tiposReserva){
		require __DIR__.'/../view/homepage/regular.php';
	}
}
