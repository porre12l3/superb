<?php
session_start();
require 'conexion.php'; // Asegúrate de que este archivo esté bien configurado

// Verifica si el user_id está presente en la sesión
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Verifica si se envió la descripción
    if (isset($_POST['description'])) {
        $description = $_POST['description'];

        // Inicia la consulta para actualizar la descripción
        $query = "UPDATE red_social SET descripcion = ? WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            // Error en la preparación de la consulta
            $response = [
                'success' => false,
                'message' => 'Error en la consulta SQL al actualizar la descripción.'
            ];
        } else {
            $stmt->bind_param("si", $description, $user_id);
            $stmt->execute();

            // Verifica si la consulta fue exitosa
            if ($stmt->affected_rows > 0) {
                $response = [
                    'success' => true,
                    'message' => 'Descripción actualizada con éxito.'
                ];
            } else {
                // No se actualizó ninguna fila (posiblemente la descripción era la misma)
                $response = [
                    'success' => true,
                    'message' => 'La descripción no cambió.'
                ];
            }
        }
        $stmt->close();
    }

    // Verifica si se envió un archivo (nueva imagen de perfil)
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // Verifica si hubo errores en la carga del archivo
        if ($file['error'] === UPLOAD_ERR_OK) {
            $filename = basename($file['name']);
            $target_path = 'uploads/' . $filename;

            // Mueve el archivo al directorio de destino
            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                // Actualiza el campo de la imagen de perfil en la base de datos
                $query = "UPDATE red_social SET foto_perfil = ? WHERE id = ?";
                $stmt = $conn->prepare($query);

                if ($stmt === false) {
                    // Error en la preparación de la consulta
                    $response = [
                        'success' => false,
                        'message' => 'Error al actualizar la imagen de perfil en la base de datos.'
                    ];
                } else {
                    $stmt->bind_param("si", $filename, $user_id);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        $response['success'] = true;
                        $response['message'] .= ' Imagen de perfil actualizada con éxito.';
                    } else {
                        $response['success'] = true;
                        $response['message'] .= ' La imagen de perfil no se pudo actualizar.';
                    }
                }
                $stmt->close();
            } else {
                $response['success'] = false;
                $response['message'] = 'Error al subir el archivo de imagen.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Error en la carga del archivo: ' . $file['error'];
        }
    }
} else {
    // No se ha iniciado sesión
    $response = [
        'success' => false,
        'message' => 'No se ha iniciado sesión. User ID no disponible.'
    ];
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
