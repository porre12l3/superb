<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $edad = $_POST['edad'];

    $stmt = $conn->prepare("INSERT INTO `red_social` (nombre, apellido, email, contraseña, edad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nombre, $apellido, $email, $password, $edad);

    if ($stmt->execute()) {
        header("Location: ../registro.html?registro_exitoso=true");
        exit();
    } else {
        echo "Error en el registro";
    }

    $stmt->close();
    $conn->close();
}