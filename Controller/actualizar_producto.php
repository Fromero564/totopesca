<?php
require_once '../Model/ProductoModelo.php';

$modelo = new ProductoModelo();

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$imagen = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreImagen = basename($_FILES['imagen']['name']);
    $rutaDestino = "../Public/photos/" . $nombreImagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
    $imagen = $nombreImagen;
}

$resultado = $modelo->actualizarProducto($id, $nombre, $descripcion, $imagen);

if ($resultado) {
    header("Location: ../View/dashboard.php?msg=Producto%20actualizado");
} else {
    echo "Error al actualizar el producto.";
}
