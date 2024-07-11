<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "registro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Verificar que se hayan enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    // $fechaNacimiento = $conn->real_escape_string($_POST['fechaNacimiento']);
    $pais = $conn->real_escape_string($_POST['pais']);

    // Hash de la contraseña para almacenamiento seguro
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Consulta para insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, email, password, pais) 
            VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $nombre, $apellido, $email, $hashedPassword, $pais);

        if ($stmt->execute()) {
            // Registro exitoso
            header("Location: iniciosesion.html");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
