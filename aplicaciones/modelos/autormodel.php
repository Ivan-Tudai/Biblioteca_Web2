<?php

class autormodel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=biblioteca_db;charset=utf8', 'root', '');
    }

    public function obtenerTodosAutores() {
        $query = $this->db->prepare('SELECT * FROM autor');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertarAutor($nombre, $nacimiento) {
        $query = $this->db->prepare('INSERT INTO autor (nombre, nacimiento) VALUES (?, ?)');
        $query->execute([$nombre, empty($nacimiento) ? null : $nacimiento]);
    }

    public function eliminarAutorPorId($id) {
        $query = $this->db->prepare('DELETE FROM autor WHERE autor_id = ?');
        $query->execute([$id]);
    }

    public function obtenerAutorPorId($id) {
        $query = $this->db->prepare('SELECT * FROM autor WHERE autor_id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function actualizarAutor($id, $nombre, $nacimiento) {
        $query = $this->db->prepare('UPDATE autor SET nombre = ?, nacimiento = ? WHERE autor_id = ?');
        $query->execute([$nombre, empty($nacimiento) ? null : $nacimiento, $id]);
    }
}