<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postText = $_POST['postText'];
    $mediaInput = $_FILES['mediaInput'];
    $uploadDir = '../uploads/';
    $uploadFile = '';

    if ($mediaInput['error'] == UPLOAD_ERR_OK) {
        $uploadFile = $uploadDir . basename($mediaInput['name']);
        
        if (move_uploaded_file($mediaInput['tmp_name'], $uploadFile)) {
            $stmt = $conn->prepare("INSERT INTO publicaciones (texto, archivo) VALUES (?, ?)");
            $stmt->bind_param("ss", $postText, basename($uploadFile));
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al mover el archivo.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en la carga del archivo.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido.']);
}

$conn->close();
?>
