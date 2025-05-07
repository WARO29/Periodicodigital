<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión
require_once 'conexion.php';

// Variable para controlar errores
$error = "";
$debug = ""; // Variable para debugging

// Procesar formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar datos de entrada
    if(isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = limpiarDatos($_POST['usuario'], $conexion);
        $password = $_POST['password']; // No limpiamos la contraseña para verificación

        // Validar que los campos no estén vacíos
        if(empty($usuario) || empty($password)) {
            $error = "Todos los campos son obligatorios";
        } else {
            // Buscar usuario en la base de datos
            $sql = "SELECT Id_usuario, nombre_completo, usuario, contraseña FROM usuarios WHERE usuario = ?";
            
            // Para debug
            $debug .= "SQL: " . $sql . "<br>";
            
            // Preparar la consulta
            if($stmt = mysqli_prepare($conexion, $sql)) {
                // Enlazar parámetros
                mysqli_stmt_bind_param($stmt, "s", $usuario);
                
                // Ejecutar la consulta
                if(mysqli_stmt_execute($stmt)) {
                    // Almacenar resultado
                    mysqli_stmt_store_result($stmt);
                    
                    // Verificar si el usuario existe
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        // Enlazar variables de resultado
                        mysqli_stmt_bind_result($stmt, $id, $nombre_completo, $usuario_db, $password_hash);
                        
                        if(mysqli_stmt_fetch($stmt)) {
                            // Debug info
                            $debug .= "Usuario encontrado: " . $usuario_db . "<br>";
                            
                            // Verificar contraseña - aquí usamos password_verify si la contraseña está hasheada
                            if(password_verify($password, $password_hash) || $password == $password_hash) {
                                // Contraseña correcta, iniciar sesión
                                $_SESSION['loggedin'] = true;
                                $_SESSION['id'] = $id;
                                $_SESSION['usuario'] = $usuario_db;
                                $_SESSION['nombre'] = $nombre_completo;
                                
                                // Redirigir a página principal
                                header("Location: home.php");
                                exit;
                            } else {
                                // Contraseña incorrecta
                                $error = "La contraseña ingresada no es válida";
                                $debug .= "Contraseña incorrecta<br>";
                            }
                        }
                    } else {
                        // El usuario no existe
                        $error = "El usuario ingresado no existe";
                        $debug .= "Usuario no encontrado<br>";
                    }
                } else {
                    $error = "Error al procesar la solicitud: " . mysqli_error($conexion);
                    $debug .= "Error en ejecución: " . mysqli_error($conexion) . "<br>";
                }
                
                // Cerrar sentencia
                mysqli_stmt_close($stmt);
            } else {
                $error = "Error al preparar la consulta: " . mysqli_error($conexion);
                $debug .= "Error en preparación: " . mysqli_error($conexion) . "<br>";
            }
        }
    }
}

// Si el usuario ya está logueado, redirigir a home.php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Cosafista Digital - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo">El <span>Cosafista</span></a>
                <div class="date"><?php echo date("d/m/Y"); ?></div>
            </div>
        </div>
    </header>
    
    <main>
        <div class="container">
            <div class="login-container">
                <h1 class="login-title">Iniciar Sesión</h1>
                
                <?php if(!empty($error)): ?>
                <div class="error-alert">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
                
                <div class="register-link">
                    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
                    <p><a href="recuperar-password.php">¿Olvidaste tu contraseña?</a></p>
                </div>
                
                <?php if(!empty($_POST) && isset($_POST['usuario'])): ?>
                <!-- Solo muestra la información de depuración cuando desarrollas -->
                <div class="debug-info" style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 10px; font-size: 12px; color: #666;">
                    <p>Información para depuración (quitar esto en producción):</p>
                    <p>Usuario ingresado: <?php echo htmlspecialchars($_POST['usuario']); ?></p>
                    <p><?php echo $debug; ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>&copy; <?php echo date("Y"); ?> El Cosafista Digital. Todos los derechos reservados.</p>
                <p>Un periódico comprometido con la verdad y la información de calidad.</p>
            </div>
        </div>
    </footer>
</body>
</html> 