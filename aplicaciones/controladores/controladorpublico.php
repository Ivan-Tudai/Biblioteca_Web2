<?php

require_once 'aplicacion/modelos/libromodel.php';
require_once 'aplicacion/modelos/autormodel.php';

class controladorpublico {
    private $modeloLibro;
    private $modeloAutor;

    public function __construct() {
        $this->modeloLibro = new libromodel();
        $this->modeloAutor = new autormodel();
    }

    public function mostrarHome() {
        $libros = $this->modeloLibro->obtenerTodosLibros();
        require 'aplicacion/vistas/home.phtml';
    }

    public function mostrarDetalleLibro($id) {
        $libro = $this->modeloLibro->obtenerLibroPorId($id);
        if ($libro) {
            require 'aplicacion/vistas/detalle_libro.phtml';
        } else {
            echo "Error: Libro no encontrado";
        }
    }

    public function mostrarAutores() {
        $autores = $this->modeloAutor->obtenerTodosAutores();
        require 'aplicacion/vistas/lista_autores.phtml';
    }

    public function mostrarLibrosPorAutor($idAutor) {
        $libros = $this->modeloLibro->obtenerLibrosPorAutor($idAutor);
        require 'aplicacion/vistas/libros_por_autor.phtml';
    }
}