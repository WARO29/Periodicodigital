<?php
// Incluir archivo de conexión
require_once 'conexion.php';

// Contraseña y generación de hash
$password = "admin123";
$hash = password_hash($password, PASSWORD_DEFAULT);

// Consulta SQL para actualizar la contraseña
$sql = "UPDATE usuarios SET contraseña = ? WHERE usuario = 'admin'";

// Preparar la consulta
if($stmt = mysqli_prepare($conexion, $sql)) {
    // Enlazar parámetros
    mysqli_stmt_bind_param($stmt, "s", $hash);
    
    // Ejecutar la consulta
    if(mysqli_stmt_execute($stmt)) {
        echo "¡Contraseña actualizada correctamente!<br>";
        echo "Usuario: admin<br>";
        echo "Contraseña: " . $password . "<br>";
        echo "Hash guardado: " . $hash . "<br>";
        echo "<a href='index.php'>Ir a iniciar sesión</a>";
    } else {
        echo "Error al actualizar la contraseña: " . mysqli_error($conexion);
    }
    
    // Cerrar sentencia
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conexion);
}

// Cerrar conexión
mysqli_close($conexion);
?> 