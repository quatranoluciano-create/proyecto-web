<!-- Este php es para basicamente el panel de usuario asi puede manejar su cuenta :D -->
<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel</title>
</head>
<body>
    <h1>Panel de usuario</h1>
    <p>Bienvenido <?php echo $_SESSION["usuario"]; ?></p>
    <a href="logout.php">Cerrar sesion</a>
</body>
</html>