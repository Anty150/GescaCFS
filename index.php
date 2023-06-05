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
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="wrapper">
        <aside>
            <ul>
                <?php
                    if(isset($_SESSION['valid'])){
                        echo "<p>Welcome ".$_SESSION["username"]."</p>";
                    }else{
                        echo "<p>Not logged in</p>";
                    }
                ?>
                <li><a href="index.php">Main Page</a></li>
                <li><a href="create.php">Create</a></li>
                <li><a href="fill.php">Fill</a></li>
                <li><a href="see.php">See</a></li>
                <?php
                if(isset($_SESSION['valid'])){
                    echo "<li><a href="."logout.php".">Logout</a></li>";
                }
                ?>
            </ul>
        </aside>
        <main>
            <?php
            if(isset($_SESSION['registered'])){
                if($_SESSION['registered']){
                    echo "<p>Succesfuly registered you can now log in</p>";
                    $_SESSION['registered'] = false;
                }
            }
            if(isset($_SESSION['loginFailed'])){
                if($_SESSION['loginFailed']){
                    echo "<p>Username or password is incorrect</p>";
                    $_SESSION['loginFailed'] = false;
                }
            }
            ?>
            <a href="login.php"><input type="button" value="Login"></a>
            <a href="register.php"><input type="button" value="Register"></a>
        </main>
    </div>
</body>
</html>