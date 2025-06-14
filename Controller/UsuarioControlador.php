<?php
session_start();
require_once '../Model/UsuarioModelo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = new UsuarioModelo();

    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);

        if ($accion === 'login') {
            $usuarioEncontrado = $modelo->verificarCredenciales($usuario, $password);

            if ($usuarioEncontrado) {
                $_SESSION['usuario'] = $usuarioEncontrado['usuario']; 
                header("Location: ../View/Dashboard.php"); 
                exit();
            } else {
                // Redirigir al login con mensaje de error
                header("Location: ../View/login.php?msg=Usuario%20o%20contraseña%20incorrectos");
                exit();
            }

        } elseif ($accion === 'registro') {
            $registrado = $modelo->registrarUsuario($usuario, $password);

            if ($registrado) {
                header("Location: ../View/login.php?msg=Usuario%20registrado%20correctamente.%20Ya%20podés%20iniciar%20sesión.");
                exit();
            } else {
                header("Location: ../View/login.php?msg=Error:%20el%20usuario%20ya%20existe%20o%20hubo%20un%20problema.");
                exit();
            }
        }
    }
}
