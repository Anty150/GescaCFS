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
                        $isHidden = false;
                    }else{
                        echo "<p>Not logged in</p>";
                        $isHidden = true;
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

            <hr>

            <?php if (!$isHidden): ?>
                <a href="delete.php"><input type="button" value="Delete Templates"></a>
                <a href="deleteDocuments.php"><input type="button" value="Delete Documents"></a>
                <hr>

                <p>Account manager:</p>
                <a href="deleteAccount.php"><input type="button" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');"></a>

            <?php endif; ?>

        </main>
    </div>
</body>
</html>