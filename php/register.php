<?php

    $nameError_message = "";
    $emailError_message= "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['nombre'];
        $email = $_POST['email'];
        $password = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

        $json_data = file_get_contents('../json/users.json');
        $users = json_decode($json_data, true) ?? [];



        echo $nameError_message;
        $exists = false;
        foreach($users as $user) {
            if ($user["username"] == $username) {
                $exists = true;
                $nameError_message = "El nombre de usuario ya existe";

            }

            if ($user["email"] == $email) {
                $exists = true;
                $emailError_message = "El email ya está registrado";
            }
        }

        if (!$exists) {
            $newUser = [
                'username' => $username,
                'password' => $password,
                'email' => $email
                ];
                $users[] = $newUser;
               
                file_put_contents('../json/users.json', json_encode($users,
                JSON_PRETTY_PRINT));
                header("Location: ../html/usuarioRegistrado.html");
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Radio Taxonera</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="intro-animation">
        <img src="../media/util/logo.png" alt="Logo Radio Taxonera" height="350px" width="auto" class="logo">
        <h1>Registrate en Radio Taxonera</h1>
        <form action="./register.php" method="post">
            <input type="text" placeholder="Nombre de usuario" name="nombre" required>
            <?php echo $nameError_message?>
            <input type="email" placeholder="Correo Electrónico" name="email" required>
            <?php echo $emailError_message?>
            <input type="password" placeholder="Contraseña" name="contrasena" required>
            <button type="submit" class="btn">Registrarse</button>
        </form><br>
        <p>¿Ya tienes cuenta? <a style = 'text-decoration: none; color: orange;' href='./login.php'>Inicia sesión</a></p>
    </div>
</body>
</html>