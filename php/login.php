// login.php

session_start();
require 'conexion.php'; // Asegúrate de que tu archivo de conexión esté incluido

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar la consulta
    $stmt = $conexion->prepare("SELECT nombre, password FROM red_social WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nombre, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['nombre'] = $nombre; // Guardar el nombre en la sesión
            header("Location: muro.php"); // Redirigir al muro
            exit();
        } else {
            echo "Correo o contraseña incorrectos.";
        }
    } else {
        echo "Correo o contraseña incorrectos.";
    }
    
    $stmt->close();
}
