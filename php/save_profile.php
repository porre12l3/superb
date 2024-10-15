<?php
session_start();
require 'conexion.php'; // Asegúrate de que 'conexion.php' está correctamente configurado

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $description = $_POST['description'];

    // Manejo de la imagen
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Verifica la extensión del archivo
        $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Ruta para guardar la imagen
            $uploadFileDir = '../uploads/';
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension; // Renombrar el archivo
            $dest_path = $uploadFileDir . $newFileName;

            // Mueve el archivo a la carpeta de destino
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Actualiza la base de datos con la nueva imagen y descripción
                $query = "UPDATE red_social SET descripcion = ?, foto_perfil = ? WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssi", $description, $newFileName, $user_id);

                if ($stmt->execute()) {
                    $response = ['success' => true];
                } else {
                    $response = ['success' => false, 'message' => 'Error al actualizar la base de datos.'];
                }
                $stmt->close();
            } else {
                $response = ['success' => false, 'message' => 'Error al mover el archivo.'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Tipo de archivo no permitido.'];
        }
    } else {
        // Si no hay archivo, solo se actualiza la descripción
        $query = "UPDATE red_social SET descripcion = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $description, $user_id);

        if ($stmt->execute()) {
            $response = ['success' => true]; // Éxito solo con la descripción
        } else {
            $response = ['success' => false, 'message' => 'Error al actualizar la base de datos.'];
        }
        $stmt->close();
    }
} else {
    $response = ['success' => false, 'message' => 'No se ha iniciado sesión.'];
}

header('Content-Type: application/json');
echo json_encode($response);
