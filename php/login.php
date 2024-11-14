<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            echo "<script>
                    alert('Inicio de sesión exitoso');
                    window.location.href = '../inicio.html';  // Redirección a la página de inicio
                  </script>";
        } else {
            echo "<script>alert('Contraseña incorrecta. Intenta de nuevo.');</script>";
        }
    } else {
        echo "<script>alert('El correo electrónico no está registrado.');</script>";
    }
}
?>
