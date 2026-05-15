<?php
session_start();
include "conexion.php";
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare(
        "INSERT INTO Usuarios (email, contrasena, rol_id, fecha_registro)
         VALUES (?, ?, 1, NOW())"
    );
    $query->bind_param("ss", $email, $passwordHash);
    if($query->execute())
    {
        $mensaje = "Usuario registrado";
    }
    else
    {
        $mensaje = "Error al registrar usuario";
    }
    $query->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
    <p><?php echo $mensaje; ?></p>
</body>
</html>