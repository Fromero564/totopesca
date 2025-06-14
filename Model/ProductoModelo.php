<?php
require_once 'Conexion.php';

class ProductoModelo
{
    private $con;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->con = $conexion->getConexion();
    }
    public function borrarProducto($id)
    {
        $stmt = $this->con->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function obtenerProductos()
    {
        $sql = "SELECT * FROM productos";
        $result = $this->con->query($sql);
        $productos = [];

        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        return $productos;
    }

    public function insertarProducto($nombre, $descripcion, $nombreArchivo)
    {
        $stmt = $this->con->prepare("INSERT INTO productos (nombre, descripcion, imagen) VALUES (?, ?, ?)");
        if (!$stmt) {

            error_log("Error preparando la consulta: " . $this->con->error);
            return false;
        }

        $stmt->bind_param("sss", $nombre, $descripcion, $nombreArchivo);
        $resultado = $stmt->execute();
        if (!$resultado) {

            error_log("Error ejecutando la consulta: " . $stmt->error);
        }
        $stmt->close();
        return $resultado;
    }
    public function actualizarProducto($id, $nombre, $descripcion, $imagen = null)
    {
        if ($imagen) {
            $stmt = $this->con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nombre, $descripcion, $imagen, $id);
        } else {
            $stmt = $this->con->prepare("UPDATE productos SET nombre = ?, descripcion = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nombre, $descripcion, $id);
        }
        return $stmt->execute();
    }
}
