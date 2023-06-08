<!doctype html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="/GescaCFS/Styles/styles.css">
</head>
<body>
<div class="form">
    <form action="/GescaCFS/Scripts/PHP/Other/Register/registerScript.php" method="post">
        <p>
        <span><label for="username">Username</label></span>
        <span><input type="text" id="username" name="username" required></span>
        </p>

        <p>
        <span><label for="password">Password</label></span>
        <span><input type="password" id="password" name="password" required></span>
        </p>
        <!--
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        -->
        <p>
        <span><input type="submit" value="Register" id="register" name="register"></span>
        </p>

        <p class="form_footer">
            Have an account?
            <input type="button" onclick="location.href='\\GescaCFS\\Pages\\PHP\\Other\\Login\\login.php'" value="Login">
        </p>
    </form>
</div>
</body>
</html>