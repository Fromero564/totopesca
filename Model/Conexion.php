<?php
class Conexion {
    protected $con;

    public function __construct() {
        $this->con = new mysqli('localhost', 'root', '', 'totopesca_db');
        if ($this->con->connect_error) {
            die("Error de conexión: " . $this->con->connect_error);
        }
    }

    public function getConexion() {
        return $this->con;
    }
}