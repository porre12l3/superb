<?php
include 'conexion.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT nombre_de_usuario, email FROM `red social` WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(array("error" => "Usuario no encontrado"));
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("error" => "Usuario no autenticado"));
}
?>
