<?php
session_start();
define('BASE_URL', '/TotoPesca'); // En local. En producción usá ''
require_once(__DIR__ . '/../Model/ProductoModelo.php');
$modelo = new ProductoModelo();

$porPagina = 12;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $porPagina;

$productos = $modelo->obtenerProductosPaginados($inicio, $porPagina);
$totalProductos = $modelo->contarProductos();
$totalPaginas = ceil($totalProductos / $porPagina);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Toto Pesca - Tienda online especializada en artículos de pesca. Explora nuestra amplia selección de productos, navega fácilmente con paginación, agrega al carrito y realiza pedidos vía WhatsApp." />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fontawesome -->
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Favicon -->
  <link rel="icon" href="<?= BASE_URL ?>/Public/photos/logo.png" type="image/png" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
        crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
          crossorigin="anonymous"></script>

  <!-- Normalize + Estilos -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/Public/styles/normalize.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/Public/styles/style.css" />

  <title>Toto Pesca</title>
</head>
<body>
  <!-- WhatsApp flotante -->
  <a href="https://wa.me/543364010550"
     class="whatsapp-float"
     target="_blank"
     rel="noopener noreferrer"
     aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>

  <section class="contenedor">
    <div class="encabezado-contenedor">
      <div class="logo-titulo-contenedor">
        <img src="<?= BASE_URL ?>/Public/photos/logo.png" alt="logo toto pesca" class="logo-estilo" />
        <h1>TOTO PESCA</h1>
      </div>
      <div class="iconos-contenedor">
        <i class="fa-brands fa-square-facebook"></i>
        <a href="https://www.instagram.com/toto.pesca.ok" style="color:black" target="_blank" rel="noopener noreferrer">
          <i class="fa-brands fa-square-instagram"></i>
        </a>
        <i class="fa-brands fa-square-x-twitter"></i>
      </div>
    </div>

    <?php if (isset($_SESSION['usuario'])): ?>
      <i><a href="<?= BASE_URL ?>/dashboard" class="btn-dashboard">Ir al Dashboard</a></i>
    <?php endif; ?>

    <nav class="navbar-contenedor">
      <button class="hamburger" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </button>
      <ul>
        <li><a href="<?= BASE_URL ?>/home">HOME</a></li>
        <li><a href="#marcas">MARCAS</a></li>
        <li><a href="#shop">TIENDA</a></li>
        <li><a href="#info-contacto">CONTACTO</a></li>
        <li class="cart-li">
          <a href="javascript:void(0);" class="cart-toggle">
            <i class="fa-solid fa-cart-shopping"></i><span class="cart-count">0</span>
          </a>
          <div class="dropdown-cart" style="display: none;">
            <ul class="cart-items-list"></ul>
            <button class="btn btn-sm btn-success w-100 mt-2 enviar-whatsapp">Enviar pedido</button>
          </div>
        </li>
      </ul>
    </nav>

    <!-- Carrusel de imágenes -->
    <section class="carrousel-contenedor">
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?= BASE_URL ?>/Public/photos/carrousel/carrousel1.jpg" class="d-block w-100" alt="carrousel 1"/>
          </div>
          <div class="carousel-item">
            <img src="<?= BASE_URL ?>/Public/photos/carrousel/carrousel2.jpg" class="d-block w-100" alt="carrousel 2"/>
          </div>
          <div class="carousel-item">
            <img src="<?= BASE_URL ?>/Public/photos/carrousel/carrousel3.jpg" class="d-block w-100" alt="carrousel 3"/>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span><span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span><span class="visually-hidden">Siguiente</span>
        </button>
      </div>
    </section>

    <!-- Marcas -->
    <div class="carousel-container" id="marcas">
      <div class="carousel-track">
        <?php foreach (['Shimano','penn','abugarcia','sumax','maruri','Ottoni','mustad','marine'] as $marca): ?>
          <img src="<?= BASE_URL ?>/Public/photos/marcas/<?= $marca ?>.<?= (in_array($marca,['abugarcia','maruri'])?'jpg':'png') ?>" alt="<?= $marca ?>" class="logo-marcas" />
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Búsqueda -->
  <div class="busqueda-contenedor">
    <form onsubmit="return false;">
      <input type="text" id="busqueda" placeholder="Buscar productos..." />
      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
  </div>

  <!-- Productos con paginación -->
  <section class="cards-section" id="shop">
    <?php foreach ($productos as $producto): ?>
      <div class="card producto-card" data-id="<?= htmlspecialchars($producto['id']) ?>"
           data-nombre="<?= htmlspecialchars($producto['nombre']) ?>">
        <img src="<?= BASE_URL ?>/Public/photos/<?= htmlspecialchars($producto['imagen']) ?>"
             alt="<?= htmlspecialchars($producto['nombre']) ?>" />
        <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
        <p><?= htmlspecialchars($producto['descripcion']) ?></p>
        <div class="buttons">
          <button class="btn whatsapp"
                  onclick="window.open('https://wa.me/543364010550?text=Hola,%20estoy%20interesado%20en%20<?= urlencode($producto['nombre']) ?>','_blank')">
            <i class="fab fa-whatsapp"></i> WhatsApp
          </button>
          <button class="btn cart">Agregar al carrito</button>
        </div>
      </div>
    <?php endforeach; ?>
  </section>

  <!-- Paginación -->
  <div class="pagination">
    <?php if ($pagina > 1): ?>
      <a href="?pagina=<?= $pagina - 1 ?>">&laquo; Anterior</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <a href="?pagina=<?= $i ?>" class="<?= $i == $pagina ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($pagina < $totalPaginas): ?>
      <a href="?pagina=<?= $pagina + 1 ?>">Siguiente &raquo;</a>
    <?php endif; ?>
  </div>

  <!-- Footer -->
  <footer class="footer" id="info-contacto">
    <div class="footer-column">
      <h3>Contacto</h3>
      <p>📍 Dirección: San Nicolás de los Arroyos, Buenos Aires, Argentina.</p>
      <p>📞 Teléfono: +54 336 4010550</p>
      <p>✉️ Email: contacto@totopesca.com.ar</p>
    </div>
    <div class="footer-column">
      <h3>Seguinos</h3
      ><div class="social-icons">
        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/toto.pesca.ok" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/543364010550" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
  // Menú hamburguesa
  document.getElementById('menu-toggle').addEventListener('click', () => {
    document.querySelector('.navbar-contenedor ul').classList.toggle('active');
  });

  // Carrito
  const cartToggle = document.querySelector('.cart-toggle');
  const dropdownCart = document.querySelector('.dropdown-cart');
  const cartCount = document.querySelector('.cart-count');
  const cartItemsList = document.querySelector('.cart-items-list');
  let cart = [];

  // Abrir/cerrar carrito
  cartToggle.addEventListener('click', () => {
    dropdownCart.style.display = dropdownCart.style.display === 'block' ? 'none' : 'block';
  });

  // Agregar al carrito
  document.querySelectorAll('.producto-card .cart').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.producto-card');
      const id = card.dataset.id;
      const nombre = card.dataset.nombre;

      const item = cart.find(p => p.id === id);
      if (item) {
        item.cantidad += 1;
      } else {
        cart.push({ id, nombre, cantidad: 1 });
      }

      actualizarCarrito();
    });
  });

  function actualizarCarrito() {
    cartCount.textContent = cart.reduce((acc, item) => acc + item.cantidad, 0);
    cartItemsList.innerHTML = '';

    cart.forEach(item => {
      const li = document.createElement('li');
      li.textContent = `${item.nombre} x${item.cantidad}`;

      const eliminar = document.createElement('button');
      eliminar.textContent = 'x';
      eliminar.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
      eliminar.addEventListener('click', () => {
        cart = cart.filter(p => p.id !== item.id);
        actualizarCarrito();
      });

      li.appendChild(eliminar);
      cartItemsList.appendChild(li);
    });
  }

  // Enviar pedido por WhatsApp
  document.querySelector('.enviar-whatsapp').addEventListener('click', () => {
    if (cart.length === 0) {
      alert('El carrito está vacío.');
      return;
    }

    let mensaje = 'Hola! Quiero hacer un pedido:%0A';
    cart.forEach(item => {
      mensaje += `- ${item.nombre} x${item.cantidad}%0A`;
    });

    const url = `https://wa.me/543364010550?text=${mensaje}`;
    window.open(url, '_blank');
  });

  // Búsqueda
  document.getElementById('busqueda').addEventListener('input', function () {
    const termino = this.value.toLowerCase();
    document.querySelectorAll('.producto-card').forEach(card => {
      const nombre = card.dataset.nombre.toLowerCase();
      card.style.display = nombre.includes(termino) ? 'block' : 'none';
    });
  });

  // Cerrar carrito al hacer clic fuera
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.cart-li')) {
      dropdownCart.style.display = 'none';
    }
  });
</script>

</body>
</html>
