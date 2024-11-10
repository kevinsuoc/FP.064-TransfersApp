<?php

// Cargamos el modelo de Usuario para poder usarlo en este controlador
require_once __DIR__ . '/../model/Usuario.php';

// Definimos clase UsuarioController
// Maneja las acciones relacionadas con los usuarios; ver perfil, editar info, cambiar pass...
class UsuarioController {
    // Creamos una propiedad privada para almacenar el modelo de Usuario
    private $usuarioModel;

    // Constructor de la clase
    // Aquí inicializamos el modelo de Usuario, que nos permitirá interactuar con la base de datos.
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // Método para ver el perfil de un usuario; recibe ID y utiliza el modelo para obtener los datos
    // Luego carga la vista `perfil.php` para mostrar la información al usuario.
    public function verPerfil($userId) {
        $usuario = $this->usuarioModel->getUsuarioById($userId); // Obtenemos los datos del usuario
        require __DIR__ . '/../view/perfil.php'; // Cargamos la vista de perfil
    }

    // Método para editar el perfil del usuario; recibe ID y los nuevos datos para actualizar 
    // Usa el modelo para actualizar los datos en la base de datos y luego redirige al perfil.
    public function editarPerfil($userId, $data) {
        $this->usuarioModel->updateUsuario($userId, $data); // Actualizamos los datos en la base de datos
        header("Location: /perfil"); // Redirigimos al usuario a su perfil después de la edición
    }

    // Método para cambiar la contraseña del usuario
    // Recibe el ID del usuario y la nueva contraseña como parámetros.
    // Usa el modelo para actualizar la contraseña y luego redirige al perfil del usuario.
    public function cambiarContraseña($userId, $nuevaContraseña) {
        $this->usuarioModel->updatePassword($userId, $nuevaContraseña); // Actualizamos la contraseña en la base de datos
        header("Location: /perfil"); // Redirigimos al perfil después de cambiar la contraseña
    }
}
