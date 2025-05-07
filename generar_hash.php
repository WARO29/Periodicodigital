<?php
// Generar hash para la contraseña "admin123"
$password = "admin123";
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Contraseña original: " . $password . "<br>";
echo "Hash generado: " . $hash . "<br>";
echo "Para actualizar el usuario admin en la base de datos, ejecuta:<br>";
echo "UPDATE usuarios SET contraseña = '" . $hash . "' WHERE usuario = 'admin';";
?> 