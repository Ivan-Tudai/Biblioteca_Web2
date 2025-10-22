<?php

class usuariomodel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=biblioteca_db;charset=utf8', 'root', '');
    }

    public function obtenerUsuarioPorNombre($nombreUsuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE nombre = ?');
        $query->execute([$nombreUsuario]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}