<?php
session_start();
require_once '../Model/ProductoModelo.php';
$modelo = new ProductoModelo();
$productos = $modelo->obtenerProductos();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Fontawesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../Public/styles/normalize.css">
  <link rel="stylesheet" href="../Public/styles//style.css">
  <title>Toto Pesca</title>

</head>

<body>

  <a href="https://wa.me/?text=Hola!%20Gracias%20por%20contactarnos,%20¿En%20qué%20podemos%20ayudarte?!" class="whatsapp-float" target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
  </a>

  <section class="contenedor">
    <div class="encabezado-contenedor">
      <div class="logo-titulo-contenedor">
        <img src="../Public/photos/logo.png" alt="logo toto pesca" class="logo-estilo">
        <h1>TOTO PESCA</h1>
      </div>

      <div class="iconos-contenedor">
        <i class="fa-brands fa-square-facebook"></i>
        <i class="fa-brands fa-square-instagram"></i>
        <i class="fa-brands fa-square-x-twitter"></i>

      </div>


    </div>

    <?php if (isset($_SESSION['usuario'])): ?>
      <i><a href="dashboard.php" class="btn-dashboard">Ir al Dashboard</a></i>
    <?php endif; ?>


    <nav class="navbar-contenedor">
      <button class="hamburger" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </button>
      <ul>
        <li><a href="">HOME</a></li>
        <li><a href="">MARCAS</a></li>
        <li><a href="">TIENDA</a></li>
        <li><a href="">CONTACTO</a></li>
        <li><a href=""> <i class="fa-solid fa-cart-shopping"></i></a></li>
      </ul>
    </nav>

    <section class="carrousel-contenedor">
      <div id="carouselExampleAutoplaying" class="carousel slide" style="width: 80%; max-width: 900px; " data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../Public/photos/carrousel/carrousel1.jpg" class="d-block w-100" alt="toto pesca carrousel">
          </div>
          <div class="carousel-item">
            <img src="../Public/photos/carrousel/carrousel2.jpg" class="d-block w-100" alt="toto pesca carrousel">
          </div>
          <div class="carousel-item">
            <img src="../Public/photos/carrousel/carrousel3.jpg" class="d-block w-100" alt="toto pesca carrousel">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <div class="carousel-container">
      <div class="carousel-track">
        <img src="../Public/photos/marcas/Shimano.png" alt="logo shimano" class="logo-marcas">
        <img src="../Public/photos/marcas/penn.png" alt="logo penn" class="logo-marcas">
        <img src="../Public/photos/marcas/abugarcia.jpg" alt="logo abu garcia" class="logo-marcas">
        <img src="../Public/photos/marcas/sumax.png" alt="logo sumax" class="logo-marcas">
        <img src="../Public/photos/marcas/maruri.jpg" alt="logo maruri" class="logo-marcas">
        <img src="../Public/photos/marcas/Ottoni.png" alt="logo ottoni" class="logo-marcas">
        <img src="../Public/photos/marcas/mustad.png" alt="logo mustad" class="logo-marcas">
        <img src="../Public/photos/marcas/marine.jpg" alt="logo marine" class="logo-marcas">


        <!-- Duplicamos para que se vea continuo -->
        <img src="../Public/photos/marcas/Shimano.png" alt="logo shimano" class="logo-marcas">
        <img src="../Public/photos/marcas/penn.png" alt="logo penn" class="logo-marcas">
        <img src="../Public/photos/marcas/abugarcia.jpg" alt="logo abu garcia" class="logo-marcas">
        <img src="../Public/photos/marcas/sumax.png" alt="logo sumax" class="logo-marcas">
        <img src="../Public/photos/marcas/maruri.jpg" alt="logo maruri" class="logo-marcas">
        <img src="../Public/photos/marcas/Ottoni.png" alt="logo ottoni" class="logo-marcas">
        <img src="../Public/photos/marcas/mustad.png" alt="logo mustad" class="logo-marcas">
        <img src="../Public/photos/marcas/marine.jpg" alt="logo marine" class="logo-marcas">
      </div>
    </div>

  </section>
  <div class="busqueda-contenedor">
    <form action="javascript:void(0);">
      <input type="text" id="busqueda" placeholder="Buscar productos..." />
      <button type="submit"><i class="fa-brands fa-sistrix"></i></button>
    </form>
  </div>
  <section class="cards-section">
    <?php foreach ($productos as $producto): ?>
      <div class="card producto-card">
        <img src="../Public/photos/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
        <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
        <p><?= htmlspecialchars($producto['descripcion']) ?></p>
        <div class="buttons">
          <a href="https://wa.me/549XXXXXXXXXX?text=Hola,%20estoy%20interesado%20en%20<?= urlencode($producto['nombre']) ?>" target="_blank" class="btn whatsapp">WhatsApp</a>
          <button class="btn cart">Agregar al carrito</button>
        </div>
      </div>
    <?php endforeach; ?>



  </section>
  <footer class="footer">
    <div class="footer-column">
      <h3>Contacto</h3>
      <p>📍 Dirección: Av Savio 123, San Nicolas de los Arroyos</p>
      <p>📞 Teléfono: (011) 1234-5678</p>
      <p>✉️ Email: contacto@totopesca.com.ar</p>
    </div>

    <div class="footer-column">
      <h3>Seguinos</h3>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/549XXXXXXXXXX" target="_blank"><i class="fab fa-whatsapp"></i></a>

      </div>
    </div>
  </footer>
 <script>
  // Menú hamburguesa
  const toggleButton = document.getElementById('menu-toggle');
  const menu = document.querySelector('.navbar-contenedor ul');

  toggleButton.addEventListener('click', () => {
    menu.classList.toggle('show');
  });

  // Filtro de búsqueda
  window.addEventListener('DOMContentLoaded', () => {
    const inputBusqueda = document.getElementById('busqueda');
    const tarjetas = document.querySelectorAll('.producto-card');

    inputBusqueda.addEventListener('input', function () {
      const termino = inputBusqueda.value.toLowerCase();

      tarjetas.forEach(card => {
        const nombre = card.querySelector('h3').textContent.toLowerCase();
        const descripcion = card.querySelector('p').textContent.toLowerCase();

        const coincide = nombre.includes(termino) || descripcion.includes(termino);
        card.style.display = coincide ? 'block' : 'none';
      });
    });
  });
</script>


</body>

</html>