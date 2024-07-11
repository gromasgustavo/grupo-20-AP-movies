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

// Función para mostrar todos los usuarios
function mostrarUsuarios($conn) {
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-striped'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Fecha de Nacimiento</th><th>País</th><th>Acciones</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
           // echo "<td>" . (isset($row["fechaNacimiento"]) ? $row["fechaNacimiento"] : '') . "</td>";
            echo "<td>" . $row["pais"] . "</td>";
            echo "<td>
                    <a href='crud_users.php?edit=" . $row["id"] . "'>Editar</a> |
                    <a href='crud_users.php?delete=" . $row["id"] . "'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron usuarios.";
    }
}

// Función para eliminar un usuario
function eliminarUsuario($conn, $id) {
    $sql = "DELETE FROM usuarios WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error eliminando usuario: " . $conn->error;
    }
}

// Función para obtener datos de un usuario
function obtenerUsuario($conn, $id) {
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Función para actualizar un usuario
//se quito de la lista: $fechaNacimiento,
function actualizarUsuario($conn, $id, $nombre, $apellido, $email, $password, $pais) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', email='$email', password='$hashed_password', pais='$pais' WHERE id=$id";
//se quito de la lista: fechaNacimiento='$fechaNacimiento',
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error actualizando usuario: " . $conn->error;
    }
}

// Lógica para manejar las solicitudes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $pais = $_POST['pais'];
//se quito de la lista: $fechaNacimiento = $_POST['fechaNacimiento'];
        actualizarUsuario($conn, $id, $nombre, $apellido, $email, $password, $pais);
    }
} else {
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        eliminarUsuario($conn, $id);
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $usuario = obtenerUsuario($conn, $id);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header, .footer {
            background-color: #f0f0f0; /* Fondo gris claro */
        }
        .header .navbar-brand {
            color: #333;
        }
        .mt-5 {
            padding: 10px;
        }
        .header .navbar-nav .nav-link {
            color: #333;
        }
        h1.mt-5 {
            background-color: #fff3cd; /* Fondo amarillo claro */
        }
        h2.mt-5 {
            background-color: #ffe5b4; /* Fondo naranja claro */
        }
        .footer {
            background-color: #f8f9fa; /* Fondo gris claro */
            padding: 20px 0;
        }
        .footer .navegacion .row {
            justify-content: center;
        }
        .footer .navegacion .navbar-brand {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<header class="header">
    <nav class="navegacion navbar navbar-expand-lg navbar-light">
        <a class="anclaLogo navbar-brand" href="./AP-movies.html">🍕 AP-Movies</a>
    </nav>
</header>

<div class="container">
    <h1 class="mt-5">Gestión de Usuarios</h1>

    <!-- Formulario para editar usuario -->
    <?php if (isset($usuario)): ?>
        <h2>Editar Usuario</h2>
        <form action="crud_users.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $usuario['apellido']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo isset($usuario['fechaNacimiento']) ? $usuario['fechaNacimiento'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="pais">País</label>
                <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $usuario['pais']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
        </form>
    <?php endif; ?>

    <h2 class="mt-5">Lista de Usuarios</h2>
    <?php mostrarUsuarios($conn); ?>
</div>

<footer class="footer">
    <nav class="navegacion container">
        <div class="row text-center">
            <div class="col-sm-3">
                <a class="anclaLogo navbar-brand linkNav" href="./AP-movies.html">🍕 AP-Movies</a>
            </div>
            <div class="col-sm-3">
                <a class="linkNav administradorPeliculas" href="./registrarse.html">registro de usuarios <i class="fa fa-gear"></i></a>
            </div>
            <div class="col-sm-3">
                <a class="linkNav administradorPeliculas" href="./iniciosesion.html">inicio de sesión <i class="fa fa-gear"></i></a>
            </div>
        </div>
    </nav>
</footer>

<!-- Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
