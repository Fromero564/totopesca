<?php
session_start();
session_destroy();
header("Location: ../View/login.php?msg=Sesión%20cerrada%20correctamente");
exit();
?>
