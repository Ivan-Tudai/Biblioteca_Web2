<?php

require_once 'aplicacion/modelos/libromodel.php';
require_once 'aplicacion/modelos/autormodel.php';

class controladoradmin {
    private $modeloLibro;
    private $modeloAutor;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['ID_USUARIO'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
        $this->modeloLibro = new libromodel();
        $this->modeloAutor = new autormodel();
    }

    public function mostrarPanelLibros() {
        $libros = $this->modeloLibro->obtenerTodosLibros();
        $autores = $this->modeloAutor->obtenerTodosAutores();
        require 'aplicacion/vistas/admin_libros.phtml';
    }

    public function agregarLibro() {
        $this->modeloLibro->insertarLibro($_POST['titulo'], $_POST['autor_id']);
        header('Location: ' . BASE_URL . 'admin/libros');
    }

    public function eliminarLibro($id) {
        $this->modeloLibro->eliminarLibroPorId($id);
        header('Location: ' . BASE_URL . 'admin/libros');
    }

    public function mostrarFormularioEditar($id) {
        $libro = $this->modeloLibro->obtenerLibroPorId($id);
        $autores = $this->modeloAutor->obtenerTodosAutores();
        if ($libro) {
            require 'aplicacion/vistas/form_editar_libros.phtml';
        } else {
            header('Location: ' . BASE_URL . 'admin/libros');
        }
    }

    public function actualizarLibro($id) {
        $this->modeloLibro->actualizarLibro($id, $_POST['titulo'], $_POST['autor_id']);
        header('Location: ' . BASE_URL . 'admin/libros');
    }

    public function mostrarPanelAutores() {
        $autores = $this->modeloAutor->obtenerTodosAutores();
        require 'aplicacion/vistas/admin_autores.phtml';
    }

    public function agregarAutor() {
        $this->modeloAutor->insertarAutor($_POST['nombre'], $_POST['nacimiento']);
        header('Location: ' . BASE_URL . 'admin/autores');
    }

    public function eliminarAutor($id) {
        $this->modeloAutor->eliminarAutorPorId($id);
        header('Location: ' . BASE_URL . 'admin/autores');
    }

    public function mostrarFormularioEditarAutor($id) {
        $autor = $this->modeloAutor->obtenerAutorPorId($id);
        if ($autor) {
            require 'aplicacion/vistas/form_editar_autor.phtml';
        } else {
            header('Location: ' . BASE_URL . 'admin/autores');
        }
    }

    public function actualizarAutor($id) {
        $nombre = $_POST['nombre'];
        $nacimiento = $_POST['nacimiento'];
        $this->modeloAutor->actualizarAutor($id, $nombre, $nacimiento);
        header('Location: ' . BASE_URL . 'admin/autores');
    }
}