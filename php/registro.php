<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_de_usuario = $_POST['nombre_de_usuario'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Este correo electrónico ya está registrado.');</script>";
    } else {
        $sql = "INSERT INTO usuarios (nombre_de_usuario, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre_de_usuario, $email, $password);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Registrado con éxito');
                    window.location.href = '../login.html';  // Ajuste de la ruta a login.html
                  </script>";
        } else {
            echo "<script>alert('Error al registrar. Intenta de nuevo.');</script>";
        }
    }
}
?>
