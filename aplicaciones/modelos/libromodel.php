<?php

class libromodel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=biblioteca_db;charset=utf8', 'root', '');
    }

    public function obtenerTodosLibros() {
        $query = $this->db->prepare(
            'SELECT 
                libros.id, 
                libros.titulo,
                libros.autor_id,
                autor.nombre AS nombre_autor
             FROM libros
             JOIN autor ON libros.autor_id = autor.autor_id'
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtenerLibroPorId($id) {
        $query = $this->db->prepare(
            'SELECT 
                libros.id, 
                libros.titulo,
                libros.autor_id,
                autor.nombre AS nombre_autor
             FROM libros
             JOIN autor ON libros.autor_id = autor.autor_id
             WHERE libros.id = ?'
        );
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function obtenerLibrosPorAutor($idAutor) {
        $query = $this->db->prepare(
            'SELECT 
                libros.id, 
                libros.titulo,
                libros.autor_id,
                autor.nombre AS nombre_autor
             FROM libros
             JOIN autor ON libros.autor_id = autor.autor_id
             WHERE libros.autor_id = ?'
        );
        $query->execute([$idAutor]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertarLibro($titulo, $idAutor) {
        $query = $this->db->prepare('INSERT INTO libros (titulo, autor_id) VALUES (?, ?)');
        $query->execute([$titulo, $idAutor]);
    }

    public function eliminarLibroPorId($id) {
        $query = $this->db->prepare('DELETE FROM libros WHERE id = ?');
        $query->execute([$id]);
    }

    public function actualizarLibro($id, $titulo, $idAutor) {
        $query = $this->db->prepare('UPDATE libros SET titulo = ?, autor_id = ? WHERE id = ?');
        $query->execute([$titulo, $idAutor, $id]);
    }
}