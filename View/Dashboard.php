<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../View/login.php?msg=Por%20favor%20inicie%20sesión");
    exit();
}

require_once '../Model/ProductoModelo.php';
$modelo = new ProductoModelo();
$productos = $modelo->obtenerProductos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard-Toto Pesca</title>
  <link rel="stylesheet" href="../Public/styles/dashboard.css" />
</head>
<body>

  <nav class="navbar">
    <div class="navbar__left">
      <span class="navbar__user">Hola, <?= htmlspecialchars($_SESSION['usuario']) ?></span>
    </div>
    <div class="navbar__right">
      <a href="../index.php" class="navbar__link">Inicio</a>
      <a href="../Controller/logout.php" class="navbar__link navbar__logout">Cerrar sesión</a>
    </div>
  </nav>

  <main class="main-container">

    <section class="form-section">
      <h2 class="form-section__title">Cargar nuevo producto</h2>
      <form class="form-container" action="../Controller/guardar_producto.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre" class="form-group__label">Nombre del producto</label>
          <input type="text" id="nombre" name="nombre" class="form-group__input" required />
        </div>

        <div class="form-group">
          <label for="descripcion" class="form-group__label">Descripción</label>
          <textarea id="descripcion" name="descripcion" class="form-group__textarea" rows="3" required></textarea>
        </div>

        <div class="form-group">
          <label for="imagen" class="form-group__label">Imagen (JPG, PNG)</label>
          <input type="file" id="imagen" name="imagen" class="form-group__file" accept="image/*" required />
        </div>

        <button type="submit" class="form-container__button">Guardar producto</button>
      </form>
    </section>

    <section class="table-section">
      <h2 class="table-section__title">Productos cargados</h2>
      <table class="product-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productos as $producto): ?>
          <tr>
            <td><?= htmlspecialchars($producto['id']) ?></td>
            <td>
              <img 
                src="../Public/photos/<?= htmlspecialchars($producto['imagen']) ?>" 
                alt="<?= htmlspecialchars($producto['nombre']) ?>" 
                class="product-table__image"
              />
            </td>
            <td><?= htmlspecialchars($producto['nombre']) ?></td>
            <td><?= htmlspecialchars($producto['descripcion']) ?></td>
            <td class="product-table__actions">
              <a href="editar_producto.php?id=<?= $producto['id'] ?>" class="btn btn-edit">Editar</a>
              <a href="../Controller/borrar_producto.php?id=<?= $producto['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Seguro que quieres borrar este producto?');">Borrar</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>

  </main>

</body>
</html>
