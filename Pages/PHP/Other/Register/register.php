<!doctype html>
<?php
    session_start();
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="/GescaCFS/Styles/styles.css">
</head>
<body>
<div class="form">
    <form action="/GescaCFS/Scripts/PHP/Other/Register/registerScript.php" method="post">
        <p>
        <span><label for="username">Usuario</label></span>
        <span><input type="text" id="username" name="username" required></span>
        </p>

        <p>
        <span><label for="password">Contraseña</label></span>
        <span><input type="password" id="password" name="password" required></span>
        </p>
        <p>
        <span><input type="submit" value="Registro" id="register" name="register"></span>
        </p>

        <p class="form_footer">
            ¿Tiene una cuenta?
            <input type="button" onclick="location.href='\\GescaCFS\\Pages\\PHP\\Other\\Login\\login.php'" value="Iniciar sesión">
        </p>
    </form>
</div>
</body>
</html>