<?php
// muro.php

session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html"); // Redirigir al login si no ha iniciado sesión
    exit();
}

$nombre = $_SESSION['nombre']; // Obtener el nombre del usuario desde la sesión
<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php"); // Redirigir al login si no ha iniciado sesión
    exit();
}

$nombre = $_SESSION['nombre']; // Obtener el nombre del usuario desde la sesión

require 'conexion.php'; // Incluir el archivo de conexión a la base de datos

// Obtener las publicaciones del usuario
$stmt = $conexion->prepare("SELECT titulo, contenido FROM publicaciones WHERE usuario = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$resultado = $stmt->get_result();

// Convertir los resultados en un array
$publicaciones = [];
while ($fila = $resultado->fetch_assoc()) {
    $publicaciones[] = $fila;
}

$stmt->close();
?>

<!-- Ahora redirige al muro HTML y pasa los datos -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muro - Superb</title>
    <link rel="stylesheet" href="css/muro.css">
</head>
<body>
    <div class="header-ribbon">
        <div class="image-buttons">
            <a href="muro.php"><img src="img/icono_de_casa.png" class="header-btn" alt="Icono 1"></a> 
            <a href="mensajeria.php"><img src="img/icono_de_mensaje.png" class="header-btn" alt="Icono 2"></a>
            <a href="perfil.php"><img src="img/icono_de_perfil.png" class="header-btn" alt="Icono 3"></a>
        </div>
    </div>

    <div class="wall-container">
        <div class="menu">
            <h3>Menú</h3>
            <a href="noticias.php"><button>Noticias</button></a>
            <a href="consejos.php"><button>Consejos</button></a>
            <button>Deportes</button>
            <button>Destacados</button>
        </div>

        <div class="main-wall">
            <div class="post-container">
                <!-- Mostrar publicaciones del usuario -->
                <?php if (count($publicaciones) > 0): ?>
                    <?php foreach ($publicaciones as $publicacion): ?>
                        <div class="post">
                            <h4><?php echo htmlspecialchars($publicacion['titulo']); ?></h4>
                            <p><?php echo htmlspecialchars($publicacion['contenido']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay publicaciones aún.</p>
                <?php endif; ?>
            </div>

            <div class="new-post">
                <textarea id="postText" placeholder="Escribe algo..." rows="3"></textarea>
                
                <label for="mediaInput">
                    <img src="img/icono_archivos.png" id="fileIcon" alt="Seleccionar archivo" class="file-icon">
                </label>
                
                <input type="file" id="mediaInput" accept="image/*,video/*" style="display:none;" />
                
                <button class="publish" onclick="publishPost()">Publicar</button>
            </div>
        </div>
    </div>
    
    <script src="js/muro.js"></script>
</body>
</html>
