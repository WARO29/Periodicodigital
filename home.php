<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Incluir archivo de conexión
require_once 'conexion.php';

// Función para formatear fecha
function formatearFecha($fecha) {
    $timestamp = strtotime($fecha);
    return date('d/m/Y H:i', $timestamp);
}

// Datos estáticos para representación
$categorias_estaticas = [
    ['id_categoria' => 1, 'nombre' => 'Política'],
    ['id_categoria' => 2, 'nombre' => 'Economía'],
    ['id_categoria' => 3, 'nombre' => 'Deportes'],
    ['id_categoria' => 4, 'nombre' => 'Cultura'],
    ['id_categoria' => 5, 'nombre' => 'Tecnología']
];

$noticias_destacadas = [
    [
        'id_noticia' => 1,
        'titulo' => 'El banco central mantiene las tasas de interés sin cambios',
        'subtitulo' => 'La decisión se tomó tras analizar los últimos indicadores económicos y la inflación',
        'contenido' => 'Contenido completo de la noticia sobre el banco central...',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-2 day')),
        'imagen_destacada' => 'img/economia.jpg',
        'categoria' => 'Economía',
        'autor' => 'Juan Pérez'
    ],
    [
        'id_noticia' => 2,
        'titulo' => 'El equipo local consigue importante victoria en el campeonato',
        'subtitulo' => 'Con este resultado, el equipo asciende posiciones en la tabla de clasificación',
        'contenido' => 'Contenido completo de la noticia deportiva...',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-1 day')),
        'imagen_destacada' => 'img/deportes.jpg',
        'categoria' => 'Deportes',
        'autor' => 'Ana García'
    ],
    [
        'id_noticia' => 3,
        'titulo' => 'Festival internacional de cine anuncia su programación',
        'subtitulo' => 'El evento contará con la participación de reconocidos directores y actores',
        'contenido' => 'Contenido completo sobre el festival de cine...',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-3 day')),
        'imagen_destacada' => 'img/cultura.jpg',
        'categoria' => 'Cultura',
        'autor' => 'Carlos Martínez'
    ],
    [
        'id_noticia' => 4,
        'titulo' => 'Descubren nueva especie de coral en aguas profundas',
        'subtitulo' => 'Los científicos destacan su importancia para el ecosistema marino',
        'contenido' => 'Contenido completo sobre el descubrimiento...',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-4 day')),
        'imagen_destacada' => 'img/ciencia.jpg',
        'categoria' => 'Ciencia',
        'autor' => 'Marta López'
    ],
    [
        'id_noticia' => 5,
        'titulo' => 'Nueva ley de protección ambiental entra en vigor',
        'subtitulo' => 'Las empresas tendrán un plazo de 6 meses para adaptarse',
        'contenido' => 'Contenido completo sobre la nueva legislación...',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-5 day')),
        'imagen_destacada' => 'img/politica.jpg',
        'categoria' => 'Política',
        'autor' => 'Roberto Sánchez'
    ]
];

$ultimas_noticias = [
    [
        'id_noticia' => 6,
        'titulo' => 'Aumenta el precio del dólar por tercer día consecutivo',
        'subtitulo' => 'Analistas prevén que continuará al alza en los próximos días',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-1 day -2 hours')),
        'imagen_destacada' => 'img/economia2.jpg',
        'categoria' => 'Economía'
    ],
    [
        'id_noticia' => 7,
        'titulo' => 'Empresarios piden reducir impuestos para impulsar la inversión',
        'subtitulo' => 'Proponen un paquete de medidas económicas al gobierno',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-1 day -5 hours')),
        'imagen_destacada' => 'img/economia3.jpg',
        'categoria' => 'Economía'
    ],
    [
        'id_noticia' => 8,
        'titulo' => 'El sector turístico muestra signos de recuperación',
        'subtitulo' => 'Los hoteles reportan un aumento en las reservas para la temporada alta',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-2 day -3 hours')),
        'imagen_destacada' => 'img/turismo.jpg',
        'categoria' => 'Economía'
    ],
    [
        'id_noticia' => 9,
        'titulo' => 'Anuncian inversiones en infraestructura deportiva',
        'subtitulo' => 'El complejo incluirá nuevas instalaciones para múltiples disciplinas',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-2 day -7 hours')),
        'imagen_destacada' => 'img/deportes2.jpg',
        'categoria' => 'Deportes'
    ],
    [
        'id_noticia' => 10,
        'titulo' => 'El nadador olímpico bate récord nacional',
        'subtitulo' => 'Superó la marca que se mantenía desde hace 15 años',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-3 day -2 hours')),
        'imagen_destacada' => 'img/deportes3.jpg',
        'categoria' => 'Deportes'
    ]
];

$noticias_populares = [
    [
        'id_noticia' => 11,
        'titulo' => 'Los 10 mejores destinos turísticos para este verano',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-5 day')),
        'imagen_destacada' => 'img/turismo2.jpg',
        'categoria' => 'Turismo'
    ],
    [
        'id_noticia' => 12,
        'titulo' => 'Receta: El postre tradicional que está conquistando las redes',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-6 day')),
        'imagen_destacada' => 'img/gastronomia.jpg',
        'categoria' => 'Gastronomía'
    ],
    [
        'id_noticia' => 13,
        'titulo' => 'Las tendencias de moda para esta temporada',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-7 day')),
        'imagen_destacada' => 'img/moda.jpg',
        'categoria' => 'Moda'
    ],
    [
        'id_noticia' => 14,
        'titulo' => 'Entrevista exclusiva con el famoso director de cine',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-8 day')),
        'imagen_destacada' => 'img/entrevista.jpg',
        'categoria' => 'Cultura'
    ],
    [
        'id_noticia' => 15,
        'titulo' => '5 consejos para mejorar tu productividad trabajando desde casa',
        'fecha_publicacion' => date('Y-m-d H:i:s', strtotime('-9 day')),
        'imagen_destacada' => 'img/productividad.jpg',
        'categoria' => 'Tecnología'
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Cosafista Digital - Noticias de actualidad</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-top">
                <a href="home.php" class="logo">El <span>Cosafista</span></a>
                <div class="date-weather">
                    <div class="date"><?php echo date("l, d F Y"); ?></div>
                    <div class="weather"><i class="fas fa-sun"></i> 28°C</div>
                </div>
                <div class="user-actions">
                    <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                    <a href="perfil.php" class="btn-sm">Mi Perfil</a>
                    <a href="logout.php" class="btn-sm">Cerrar Sesión</a>
                </div>
            </div>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="home.php" class="active">Inicio</a></li>
                    <?php foreach($categorias_estaticas as $cat): ?>
                    <li><a href="categoria.php?id=<?php echo $cat['id_categoria']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></a></li>
                    <?php endforeach; ?>
                    <li><a href="opinion.php">Opinión</a></li>
                    <li><a href="multimedia.php">Multimedia</a></li>
                </ul>
                <div class="search-bar">
                    <form action="buscar.php" method="get">
                        <input type="text" name="q" placeholder="Buscar noticias...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    
    <main>
        <div class="container">
            <!-- Sección de noticias destacadas -->
            <section class="featured-news">
                <div class="main-story">
                    <?php $noticia_principal = $noticias_destacadas[0]; ?>
                    <article class="headline">
                        <div class="headline-img">
                            <img src="<?php echo htmlspecialchars($noticia_principal['imagen_destacada']); ?>" alt="<?php echo htmlspecialchars($noticia_principal['titulo']); ?>">
                            <span class="category"><?php echo htmlspecialchars($noticia_principal['categoria']); ?></span>
                        </div>
                        <div class="headline-content">
                            <h2><a href="noticia.php?id=<?php echo $noticia_principal['id_noticia']; ?>"><?php echo htmlspecialchars($noticia_principal['titulo']); ?></a></h2>
                            <p class="subtitle"><?php echo htmlspecialchars($noticia_principal['subtitulo']); ?></p>
                            <div class="meta">
                                <span class="author">Por <?php echo htmlspecialchars($noticia_principal['autor']); ?></span>
                                <span class="date"><?php echo formatearFecha($noticia_principal['fecha_publicacion']); ?></span>
                            </div>
                        </div>
                    </article>
                </div>
                
                <div class="secondary-stories">
                    <?php 
                    // Mostrar noticias secundarias (excluir la principal)
                    for($i = 1; $i < 5 && $i < count($noticias_destacadas); $i++): 
                        $noticia = $noticias_destacadas[$i];
                    ?>
                    <article class="story">
                        <div class="story-img">
                            <img src="<?php echo htmlspecialchars($noticia['imagen_destacada']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
                            <span class="category"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                        </div>
                        <div class="story-content">
                            <h3><a href="noticia.php?id=<?php echo $noticia['id_noticia']; ?>"><?php echo htmlspecialchars($noticia['titulo']); ?></a></h3>
                            <div class="meta">
                                <span class="date"><?php echo formatearFecha($noticia['fecha_publicacion']); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endfor; ?>
                </div>
            </section>
            
            <!-- Sección principal con sidebar -->
            <div class="main-content">
                <!-- Columna principal de noticias -->
                <section class="news-column">
                    <h2 class="section-title">Últimas Noticias</h2>
                    
                    <?php foreach($ultimas_noticias as $noticia): ?>
                    <article class="news-card">
                        <div class="news-card-img">
                            <img src="<?php echo htmlspecialchars($noticia['imagen_destacada']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
                            <span class="category"><?php echo htmlspecialchars($noticia['categoria']); ?></span>
                        </div>
                        <div class="news-card-content">
                            <h3><a href="noticia.php?id=<?php echo $noticia['id_noticia']; ?>"><?php echo htmlspecialchars($noticia['titulo']); ?></a></h3>
                            <p><?php echo htmlspecialchars($noticia['subtitulo']); ?></p>
                            <div class="meta">
                                <span class="date"><?php echo formatearFecha($noticia['fecha_publicacion']); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                    
                    <div class="pagination">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="next">Siguiente &raquo;</a>
                    </div>
                </section>
                
                <!-- Sidebar con noticias populares y publicidad -->
                <aside class="sidebar">
                    <div class="widget popular-news">
                        <h3 class="widget-title">Más Leídas</h3>
                        <ul>
                            <?php foreach($noticias_populares as $popular): ?>
                            <li>
                                <div class="popular-img">
                                    <img src="<?php echo htmlspecialchars($popular['imagen_destacada']); ?>" alt="<?php echo htmlspecialchars($popular['titulo']); ?>">
                                </div>
                                <div class="popular-content">
                                    <h4><a href="noticia.php?id=<?php echo $popular['id_noticia']; ?>"><?php echo htmlspecialchars($popular['titulo']); ?></a></h4>
                                    <div class="meta">
                                        <span class="category"><?php echo htmlspecialchars($popular['categoria']); ?></span>
                                        <span class="date"><?php echo formatearFecha($popular['fecha_publicacion']); ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <div class="widget newsletter">
                        <h3 class="widget-title">Suscríbete</h3>
                        <p>Recibe nuestro boletín con las noticias más importantes del día.</p>
                        <form action="suscribir.php" method="post">
                            <input type="email" name="email" placeholder="Tu correo electrónico" required>
                            <button type="submit" class="btn">Suscribirse</button>
                        </form>
                    </div>
                    
                    <div class="widget advertisement">
                        <div class="ad-box">
                            <span class="ad-label">Publicidad</span>
                            <a href="#"><img src="img/publicidad.jpg" alt="Anuncio"></a>
                        </div>
                    </div>
                </aside>
            </div>
            
            <!-- Sección de categorías especiales -->
            <section class="category-blocks">
                <div class="category-block">
                    <h3 class="block-title"><a href="categoria.php?id=2">Economía</a></h3>
                    <div class="block-content">
                        <!-- Noticias estáticas de economía -->
                        <article class="block-featured">
                            <img src="img/economia.jpg" alt="Noticia de economía">
                            <h4><a href="#">El banco central mantiene las tasas de interés sin cambios</a></h4>
                            <p>La decisión se tomó tras analizar los últimos indicadores económicos y la inflación.</p>
                        </article>
                        <ul class="block-list">
                            <li><a href="#">Aumenta el precio del dólar por tercer día consecutivo</a></li>
                            <li><a href="#">Empresarios piden reducir impuestos para impulsar la inversión</a></li>
                            <li><a href="#">El sector turístico muestra signos de recuperación</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="category-block">
                    <h3 class="block-title"><a href="categoria.php?id=3">Deportes</a></h3>
                    <div class="block-content">
                        <!-- Noticias estáticas de deportes -->
                        <article class="block-featured">
                            <img src="img/deportes.jpg" alt="Noticia de deportes">
                            <h4><a href="#">El equipo local consigue importante victoria en el campeonato</a></h4>
                            <p>Con este resultado, el equipo asciende posiciones en la tabla de clasificación.</p>
                        </article>
                        <ul class="block-list">
                            <li><a href="#">Anuncian inversiones en infraestructura deportiva</a></li>
                            <li><a href="#">El nadador olímpico bate récord nacional</a></li>
                            <li><a href="#">Presentan calendario para el próximo torneo de fútbol</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="category-block">
                    <h3 class="block-title"><a href="categoria.php?id=4">Cultura</a></h3>
                    <div class="block-content">
                        <!-- Noticias estáticas de cultura -->
                        <article class="block-featured">
                            <img src="img/cultura.jpg" alt="Noticia de cultura">
                            <h4><a href="#">Festival internacional de cine anuncia su programación</a></h4>
                            <p>El evento contará con la participación de reconocidos directores y actores.</p>
                        </article>
                        <ul class="block-list">
                            <li><a href="#">Museo inaugura exposición de arte contemporáneo</a></li>
                            <li><a href="#">Escritor local gana prestigioso premio literario</a></li>
                            <li><a href="#">Anuncian conciertos gratuitos en el parque central</a></li>
                        </ul>
                    </div>
                </div>
            </section>
            
            <!-- Banner publicitario -->
            <div class="ad-banner">
                <span class="ad-label">Publicidad</span>
                <a href="#"><img src="img/banner.jpg" alt="Publicidad"></a>
            </div>
            
            <!-- Sección multimedia -->
            <section class="multimedia-section">
                <h2 class="section-title">Galería Multimedia</h2>
                
                <div class="multimedia-grid">
                    <div class="multimedia-item video">
                        <div class="multimedia-img">
                            <img src="img/video1.jpg" alt="Video">
                            <span class="play-icon"><i class="fas fa-play"></i></span>
                        </div>
                        <h4><a href="#">La evolución de la ciudad en los últimos 10 años</a></h4>
                    </div>
                    
                    <div class="multimedia-item photo">
                        <div class="multimedia-img">
                            <img src="img/galeria1.jpg" alt="Galería">
                            <span class="gallery-icon"><i class="fas fa-images"></i></span>
                        </div>
                        <h4><a href="#">Las mejores imágenes del festival cultural</a></h4>
                    </div>
                    
                    <div class="multimedia-item audio">
                        <div class="multimedia-img">
                            <img src="img/podcast1.jpg" alt="Podcast">
                            <span class="audio-icon"><i class="fas fa-microphone"></i></span>
                        </div>
                        <h4><a href="#">Podcast: Análisis de la situación económica actual</a></h4>
                    </div>
                    
                    <div class="multimedia-item video">
                        <div class="multimedia-img">
                            <img src="img/video2.jpg" alt="Video">
                            <span class="play-icon"><i class="fas fa-play"></i></span>
                        </div>
                        <h4><a href="#">Entrevista exclusiva con el nuevo alcalde</a></h4>
                    </div>
                </div>
            </section>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <div class="footer-widgets">
                <div class="widget about-widget">
                    <h3 class="widget-title">Sobre Nosotros</h3>
                    <p>El Cosafista Digital es un medio de comunicación comprometido con la verdad y la información de calidad, al servicio de la comunidad desde su fundación.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="widget links-widget">
                    <h3 class="widget-title">Enlaces Rápidos</h3>
                    <ul>
                        <li><a href="home.php">Inicio</a></li>
                        <li><a href="nosotros.php">Quiénes Somos</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                        <li><a href="terminos.php">Términos y Condiciones</a></li>
                        <li><a href="privacidad.php">Política de Privacidad</a></li>
                    </ul>
                </div>
                
                <div class="widget contact-widget">
                    <h3 class="widget-title">Contacto</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Calle Principal #123, Ciudad</li>
                        <li><i class="fas fa-phone"></i> +123 456 7890</li>
                        <li><i class="fas fa-envelope"></i> info@elcosafista.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> El Cosafista Digital. Todos los derechos reservados.</p>
                <p>Desarrollado por TuNombre</p>
            </div>
        </div>
    </footer>
    
    <script src="js/script.js"></script>
</body>
</html> 