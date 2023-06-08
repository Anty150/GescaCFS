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
    <title>Main Page</title>
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
                    echo "<li><a href="."newLogout.php".">Logout</a></li>";
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
            if(isset($_SESSION['registerBadPassword'])){
                if($_SESSION['registerBadPassword']){
                    echo "<p>The password must be at least 8 characters long</p>";
                    $_SESSION['registerBadPassword'] = false;
                }
            }
            if(isset($_SESSION['registerBadUsername'])){
                if($_SESSION['registerBadUsername']){
                    echo "<p>Username taken or none was provided</p>";
                    $_SESSION['registerBadUsername'] = false;
                }
            }
            ?>
            <?php if ($isHidden): ?>
                <p class="manager">Login and register</p>
                <a href="login.php"><input type="button" value="Login"></a>
                <a href="register.php"><input type="button" value="Register"></a>
            <?php endif; ?>

            <?php if (!$isHidden): ?>
                <p class="manager">File manager</p>

                <a href="delete.php"><input type="button" value="Delete Templates"></a>
                <a href="deleteDocuments.php"><input type="button" value="Delete Documents"></a>
                <hr>
                <p class="manager">Account manager</p>
                <a href="deleteAccount.php"><input type="button" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');"></a>
                <?php if ($_SESSION['permission'] == 'admin'): ?>
                    <hr>
                    <p class="manager">Admin panel</p>
                    <a href="adminViewTemplates.php"><input type="button" value="Admin View Templates"></a>
                    <a href="adminViewDocuments.php"><input type="button" value="Admin View Documents"></a>
                <?php endif; ?>
            <?php endif;?>

        </main>
    </div>
</body>
</html>