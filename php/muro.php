<?php
session_start(); 

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

include 'conexion.php';

$result = $conn->query("SELECT texto, archivo FROM publicaciones ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {
    $texto = htmlspecialchars($row['texto']);
    $archivo = htmlspecialchars($row['archivo']);
    
    echo '<div class="post">';
    echo '<p>' . $texto . '</p>';
    
    if (!empty($archivo)) {
        echo '<img src="uploads/' . urlencode($archivo) . '" alt="Publicación de imagen" />';
        echo '<p>Ruta de la imagen: uploads/' . $archivo . '</p>';
    }
    
    echo '</div>';
}

$conn->close();
?>
