
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login / Registro</title>
    <style>
        label, input, button {
            display: block;
            margin: 8px 0;
        }
        .mensaje {
            color: red;
        }
    </style>
</head>
<body>
    <?php if (isset($_GET['msg'])): ?>
        <p class="mensaje"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <h2>Iniciar Sesión</h2>
    <form action="../Controller/UsuarioControlador.php" method="POST">
        <input type="hidden" name="accion" value="login" />
        <label>Usuario:</label>
        <input type="text" name="usuario" required minlength="3" maxlength="50" />
        <label>Contraseña:</label>
        <input type="password" name="password" required minlength="6" />
        <button type="submit">Iniciar Sesión</button>
    </form>

    <hr />

    <h2>Registrarse</h2>
    <form action="../Controller/UsuarioControlador.php" method="POST">
        <input type="hidden" name="accion" value="registro" />
        <label>Usuario:</label>
        <input type="text" name="usuario" required minlength="3" maxlength="50" />
        <label>Contraseña:</label>
        <input type="password" name="password" required minlength="6" />
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
