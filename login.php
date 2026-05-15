<?php
session_start();
include "conexion.php";
$mensaje = "";
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = $conn->prepare(
        "SELECT id_usuario, email, contrasena
         FROM usuarios
         WHERE email = ?"
    );
    $query->bind_param("s", $email);
    $query->execute();
    $resultado = $query->get_result();
    if($resultado->num_rows > 0)
    {
        $usuario = $resultado->fetch_assoc();
        if(password_verify($password, $usuario["contrasena"]))
        {
            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["usuario"] = $usuario["email"];
            header("Location: panel.php");
            exit;
        }
        else
        {
            $mensaje = "Contraseña incorrecta";
        }
    }
    else
    {
        $mensaje = "Usuario no encontrado";
    }
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TecnoLink — Iniciar Sesión</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <div class="card">
   <img src="imgs/logo2.2.jfif" alt="TecnoLink" class="logo">
      <form id="loginForm" method="POST">
        <div class="campo">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Tu email" required>
          <span class="error" id="errorEmail"></span>
        </div>
        <div class="campo">
          <label for="password">Contraseña</label>
          <input type="password" id="password" placeholder="Tu contraseña" required>
          <span class="error" id="errorPassword"></span>
        </div>
        <button type="submit">Iniciar Sesión</button>
        <p class="registro">¿No tenés cuenta? <a href="registro.php">Registrate</a></p>
      </form>
    </div>
  </div>
  <script src="login.js"></script>
</body>
</html>