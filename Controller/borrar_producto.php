<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../View/login.php?msg=Por%20favor%20inicie%20sesión");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../View/Dashboard.php?msg=ID%20no%20válido");
    exit();
}

require_once '../Model/ProductoModelo.php';
$modelo = new ProductoModelo();

$id = intval($_GET['id']);

$borrado = $modelo->borrarProducto($id);

if ($borrado) {
    header("Location: ../View/Dashboard.php?msg=Producto%20borrado%20correctamente");
} else {
    header("Location: ../View/Dashboard.php?msg=Error%20al%20borrar%20el%20producto");
}
exit();
?>
