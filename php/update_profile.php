<?php
session_start();
include 'conexion.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Obtener la descripción
    $descripcion = $_POST['descripcion'];

    // Manejo de la foto de perfil
    $foto_perfil = null;
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . basename($_FILES['foto_perfil']['name']);
        
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $uploadFile)) {
            $foto_perfil = basename($_FILES['foto_perfil']['name']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al mover el archivo.']);
            exit;
        }
    }

    // Actualizar la base de datos
    $stmt = $conn->prepare("UPDATE red_social SET descripcion = ?, foto_perfil = ? WHERE id = ?");
    $stmt->bind_param("ssi", $descripcion, $foto_perfil, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>
