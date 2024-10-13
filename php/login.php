<?php
include 'conexion.php';

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
            
            echo "Iniaste sesion correctamente";
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
