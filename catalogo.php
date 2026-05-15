<?php
session_start();
include "conexion.php";
$sql = "
SELECT
    afiliados.id_afiliado,
    afiliados.nombre_completo,
    afiliados.matricula_profesional,
    afiliados.estado_validacion,
    afiliados.zona_cobertura,
    categorias_servicios.nombre AS categoria
FROM afiliados
INNER JOIN afiliado_categoria ON afiliados.id_afiliado = afiliado_categoria.id_afiliado
INNER JOIN categorias_servicios ON afiliado_categoria.id_categoria = categorias_servicios.id_categoria
ORDER BY afiliados.nombre_completo ASC
";

$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Catalogo</title>
</head>
<body>
    <h1>Catalogo</h1>
    <a href="index.php">Inicio</a>
    <hr>
    <?php if ($resultado && $resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <h2>
                <?php echo $fila["nombre_completo"]; ?>
            </h2>
            <p>
                Categoria:
                <?php echo $fila["categoria"]; ?>
            </p>
            <p>
                Matricula:
                <?php echo $fila["matricula_profesional"]; ?>
            </p>
            <p>
                Zona:
                <?php echo $fila["zona_cobertura"]; ?>
            </p>

            <p>
                Estado:
                <?php echo $fila["estado_validacion"]; ?>
            </p>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay catalogo XD.</p>
    <?php endif; ?>
</body>

</html>