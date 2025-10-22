<?php

require_once 'aplicacion/modelos/usuariomodel.php';

class controladorauth {

    private $modeloUsuario;

    public function __construct() {
        $this->modeloUsuario = new usuariomodel();
    }

    public function mostrarLogin() {
        require 'aplicacion/vistas/login.phtml';
    }

    public function autenticar() {
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $usuarioDB = $this->modeloUsuario->obtenerUsuarioPorNombre($usuario);

        if ($usuarioDB && $contraseña == $usuarioDB->contraseña) {
            session_start();
            $_SESSION['ID_USUARIO'] = $usuarioDB->id;
            $_SESSION['NOMBRE_USUARIO'] = $usuarioDB->nombre;
            header('Location: ' . BASE_URL . 'admin/libros');
        } else {
            $error = "Usuario o contraseña incorrectos.";
            require 'aplicacion/vistas/login.phtml';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
    }
}