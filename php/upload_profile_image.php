<?php
session_start();
include 'conexion.php';

if (isset($_SESSION['user_id']) && isset($_FILES['file'])) {
    $user_id = $_SESSION['user_id'];
    $uploadDir = '../uploads/'; // Asegúrate de que esta ruta sea correcta
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        // Actualiza la base de datos con la nueva imagen
        $stmt = $conn->prepare("UPDATE red_social SET foto_perfil = ? WHERE id = ?");
        $stmt->bind_param("si", basename($_FILES['file']['name']), $user_id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al mover el archivo.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
}

$conn->close();
?>
