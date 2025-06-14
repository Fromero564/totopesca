<?php
require_once '../Model/ProductoModelo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (!empty($_FILES['imagen']['name'])) {
        $archivoTmp = $_FILES['imagen']['tmp_name'];
        $nombreOriginal = $_FILES['imagen']['name'];
        $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);

        $nombreArchivoFinal = uniqid('producto_') . '.' . $extension;
        $rutaDestino = '../Public/photos/' . $nombreArchivoFinal;

        // Validación básica de imagen
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array(strtolower($extension), $extensionesPermitidas)) {
            if (move_uploaded_file($archivoTmp, $rutaDestino)) {
                $modelo = new ProductoModelo();
                $exito = $modelo->insertarProducto($nombre, $descripcion, $nombreArchivoFinal);

                if ($exito) {
                 header('Location: ../View/dashboard.php?mensaje=producto_agregado');

                    exit;
                } else {
                    echo "Error al guardar en la base de datos.";
                }
            } else {
                echo "Error al mover la imagen.";
            }
        } else {
            echo "Extensión de archivo no permitida.";
        }
    } else {
        echo "Debe subir una imagen.";
    }
}
?>
