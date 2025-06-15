<?php
require_once '../Model/ProductoModelo.php';
$modelo = new ProductoModelo();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID no válido');
}

$id = (int) $_GET['id'];
$producto = $modelo->obtenerProductoPorId($id);

if (!$producto) {
    die('Producto no encontrado');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
    <link rel="stylesheet" href="../Public/styles/editarProducto.css">
</head>

<body>

    <h2 class="edit-product__title">Editar producto</h2>
    <form action="../Controller/actualizar_producto.php" method="POST" enctype="multipart/form-data" class="edit-product__form">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">

        <label for="nombre" class="edit-product__label">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required class="edit-product__input">

        <label for="descripcion" class="edit-product__label">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required class="edit-product__textarea"><?= htmlspecialchars($producto['descripcion']) ?></textarea>

        <p class="edit-product__current-image-label">Imagen actual:</p>
        <img src="../Public/photos/<?= htmlspecialchars($producto['imagen']) ?>" width="100" alt="Imagen actual" class="edit-product__current-image">

        <label for="imagen" class="edit-product__label">Cambiar imagen (opcional):</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" class="edit-product__file-input">

     <button type="submit" class="edit-product__button">Guardar cambios</button>
<button type="button" class="edit-product__cancel-button" onclick="window.location.href='dashboard.php'">Cancelar</button>
    </form>

</body>

</html>
