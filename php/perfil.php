<?php
session_start();
require 'conexion.php'; // Asegúrate de que 'conexion.php' está correctamente configurado

// Verifica si la sesión tiene el user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Consulta para obtener los datos del usuario
    $query = "SELECT nombre, email, descripcion, foto_perfil FROM red_social WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        // Error en la preparación de la consulta
        $response = [
            'success' => false,
            'message' => 'Error en la consulta SQL.'
        ];
    } else {
        $stmt->bind_param("i", $user_id); // Se asume que el ID es un entero
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Datos del usuario encontrados
            $user_data = $result->fetch_assoc();
            $response = [
                'success' => true,
                'username' => $user_data['nombre'],
                'email' => $user_data['email'],
                'description' => $user_data['descripcion'], // Asegúrate que el campo sea correcto
                'foto_perfil' => $user_data['foto_perfil']
            ];
        } else {
            // Usuario no encontrado
            $response = [
                'success' => false,
                'message' => 'Usuario no encontrado en la base de datos.'
            ];
        }
    }

    $stmt->close();
} else {
    // El user_id no está en la sesión
    $response = [
        'success' => false,
        'message' => 'No se ha iniciado sesión. User ID no disponible.'
    ];
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
