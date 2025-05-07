<?php
/**
 * Archivo de conexión a la base de datos
 * Base de datos: periodico
 * Tabla principal: usuario
 */

// Parámetros de conexión a la base de datos
$servidor = "localhost";
$usuario = "root";        // Cambiar por tu usuario de base de datos
$password = "";           // Cambiar por tu contraseña
$basedatos = "periodico";

// Crear conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $basedatos);

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres
mysqli_set_charset($conexion, "utf8");

// Función para limpiar datos de entrada
function limpiarDatos($datos, $conexion) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    $datos = mysqli_real_escape_string($conexion, $datos);
    return $datos;
}
?> 