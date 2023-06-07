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
    <title>Login</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="form">
        <form action="loginScript.php" method="post">
            <p>
                <span><label for="username">Username</label></span>
                <span><input type="text" id="username" name="username" required></span>
            </p>

            <p>
                <span><label for="password">Password</label></span>
                <span><input type="password" id="password" name="password" required></span>
            </p>

            <p>
                <span><input type="submit" value="Login" id="login" name="login"></span>
            </p>
            <p class="form_footer">
                Don't have an account?
                <input type="button" onclick="location.href='register.php'" value="Register">
            </p>
    </div>
</body>
</html>