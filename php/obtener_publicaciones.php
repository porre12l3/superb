<?php
include 'conexion.php';

$query = "SELECT * FROM publicaciones ORDER BY fecha_creacion DESC";
$result = $conn->query($query);
$posts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = [
            'text' => htmlspecialchars($row['texto']),
            'image' => htmlspecialchars($row['archivo']),
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($posts);
$conn->close();
?>
