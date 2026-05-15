<!-- Este php es para basicamente cerrar la sesion de usuario :D -->
<?php
session_start();

session_destroy();

header("Location: index.php");
exit;
?>