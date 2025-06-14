<?php
require_once 'Conexion.php';

class UsuarioModelo {
    private $con;

    public function __construct() {
        $conexion = new Conexion();
        $this->con = $conexion->getConexion();
    }

  
    public function verificarCredenciales($usuario, $password) {
        $stmt = $this->con->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuarioEncontrado = $resultado->fetch_assoc();

            if (password_verify($password, $usuarioEncontrado['password'])) {
                return $usuarioEncontrado; 
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    }

   
    public function registrarUsuario($usuario, $password) {
      
        $stmt = $this->con->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return false; 
        }

        // Hashea la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Inserta el nuevo usuario
        $stmt = $this->con->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $passwordHash);
        $ejecutado = $stmt->execute();

        return $ejecutado; 
    }
}
