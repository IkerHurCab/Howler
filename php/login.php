<?php
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["nombre"];
    $password = $_POST["contrasena"];
    $email = $_POST["email"];

    $json_users = file_get_contents("../json/users.json");
    $array_users = json_decode($json_users, true);

    $exists = false;

    foreach($array_users as $user) {
        if (($user["username"] == $username || $user["email"] == $email) && password_verify($password, $user["password"])) {
            $exists = true;
            break;
        }
    }

    if ($exists) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        
        header("Location: main.php");
    } else {
        $error_message = "Nombre de usuario, o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Radio Taxonera</title>
    <link rel="icon" href="../media/logo.png">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="intro-animation">
        <img src="../media/util/logo.png" alt="Logo Radio Taxonera" height="350px" width="auto" class="logo">
        <h1>Iniciar sesión</h1>
        <form action="./login.php" method="post">
            <input type="text" placeholder="Nombre de usuario" name="nombre" required>
            <input type="password" placeholder="Contraseña" name="contrasena" required>
            <button type="submit" class="btn">Acceder</button><br>
            <?php echo $error_message?>
        </form><br>
        <p>¿No tienes cuenta? <a style = 'text-decoration: none; color: orange;' href='./register.php'>Regístrate</a></p>
    </div>
</body>
</html>
