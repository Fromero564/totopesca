<?php
define('BASE_URL', '/TotoPesca'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login / Registro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Public/styles/login.css" />
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['msg'])): ?>
            <p class="mensaje"><?php echo htmlspecialchars($_GET['msg']); ?></p>
        <?php endif; ?>

        <div class="form-box">
            <h2>Iniciar Sesión</h2>
            <form action="<?= BASE_URL ?>/Controller/UsuarioControlador.php" method="POST" class="form">
                <input type="hidden" name="accion" value="login" />
                <label for="login-usuario">Usuario</label>
                <input id="login-usuario" type="text" name="usuario" required minlength="3" maxlength="50" placeholder="Ingresa tu usuario" />
                
                <label for="login-password">Contraseña</label>
                <input id="login-password" type="password" name="password" required minlength="6" placeholder="Ingresa tu contraseña" />
                
                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>
        </div>

        <div class="form-box">
            <h2>Registrarse</h2>
            <form action="<?= BASE_URL ?>/Controller/UsuarioControlador.php" method="POST" class="form">
                <input type="hidden" name="accion" value="registro" />
                <label for="reg-usuario">Usuario</label>
                <input id="reg-usuario" type="text" name="usuario" required minlength="3" maxlength="50" placeholder="Elige un usuario" />
                
                <label for="reg-password">Contraseña</label>
                <input id="reg-password" type="password" name="password" required minlength="6" placeholder="Crea una contraseña" />
                
                <button type="submit" class="btn btn-secondary">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>
