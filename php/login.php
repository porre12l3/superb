<?php
session_start();
session_unset();  // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión
session_start();  // Inicia una nueva sesión
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM red_social WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['contraseña'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];

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

