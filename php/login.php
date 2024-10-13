<?php
include 'conexion.php'; // Incluye la conexión a la base de datos
session_start(); // Inicia la sesión del usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM `red social` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['contraseña'])) {
            // Guarda información del usuario en la sesión
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['nombre_de_usuario'];
            $_SESSION['email'] = $row['email'];
            
            // Redirige al muro
            header("Location: ../muro.html");
            exit();
        } else {
            echo "<script>alert('Correo o contraseña inválida'); window.location.href='../login.html';</script>";
        }
    } else {
        echo "<script>alert('Correo o contraseña inválida'); window.location.href='../login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

