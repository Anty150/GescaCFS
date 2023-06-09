<!doctype html>
<?php
    session_start();
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
    <link rel="stylesheet" href="/GescaCFS/Styles/styles.css">
</head>
<body>
    <div class="wrapper">
        <aside>
            <ul>
                <?php
                if(isset($_SESSION['valid'])){
                    echo "<p>Bienvenido ".$_SESSION["username"]."</p>";
                    $isHidden = false;
                }else{
                    echo "<p>No conectado.</p>";
                    $isHidden = true;
                }
                ?>
                <li><a href="/GescaCFS/Pages/PHP/Other/Main/mainPage.php">Página principal</a></li>
                <li><a href="/GescaCFS/Pages/PHP/User/userCreate.php">Crear</a></li>
                <li><a href="/GescaCFS/Pages/PHP/User/userFill.php">Rellenar</a></li>
                <li><a href="/GescaCFS/Pages/PHP/User/userSee.php">Ver</a></li>
                <?php
                if(isset($_SESSION['valid'])){
                    echo "<li><a href="."/GescaCFS/Scripts/PHP/Other/Logout/newLogoutScript.php".">Cierre de sesión</a></li>";
                }
                ?>
            </ul>
        </aside>
        <main>
            <?php
            if(isset($_SESSION['registered'])){
                if($_SESSION['registered']){
                    echo "<p>Nombre de usuario no disponible o no se proporcionó ninguno.</p>";
                    $_SESSION['registered'] = false;
                }
            }
            if(isset($_SESSION['loginFailed'])){
                if($_SESSION['loginFailed']){
                    echo "<p>El nombre de usuario o la contraseña son incorrectos.</p>";
                    $_SESSION['loginFailed'] = false;
                }
            }
            if(isset($_SESSION['registerBadPassword'])){
                if($_SESSION['registerBadPassword']){
                    echo "<p>La contraseña debe tener al menos 8 caracteres.</p>";
                    $_SESSION['registerBadPassword'] = false;
                }
            }
            if(isset($_SESSION['registerBadUsername'])){
                if($_SESSION['registerBadUsername']){
                    echo "<p>Se tomó el nombre de usuario o no se proporcionó ninguno.</p>";
                    $_SESSION['registerBadUsername'] = false;
                }
            }
            ?>
            <?php if ($isHidden): ?>
                <p class="manager">Inicio sesión y regístro</p>
                <a href="/GescaCFS/Pages/PHP/Other/Login/login.php"><input type="button" value="Iniciar sesión"></a>
                <a href="/GescaCFS/Pages/PHP/Other/Register/register.php"><input type="button" value="Registro"></a>
            <?php endif; ?>

            <?php if (!$isHidden): ?>
                <p class="manager">Gestor de archivos</p>
                <a href="/GescaCFS/Pages/PHP/User/userDeleteTemplates.php"><input type="button" value="Borrar plantillas"></a>
                <a href="/GescaCFS/Pages/PHP/User/userDeleteDocuments.php"><input type="button" value="Borrar documentos"></a>
                <hr>
                <p class="manager">Gestor de cuentas</p>
                <a href="/GescaCFS/Scripts/PHP/User/Handling_account/deleteAccountScript.php"><input type="button" value="Borrar cuenta" onclick="return confirm('¿Está seguro de que desea eliminar su cuenta? Esta acción no se puede deshacer.');"></a>
                <?php if ($_SESSION['permission'] == 'admin'): ?>
                    <hr>
                    <p class="manager">Panel de administración</p>
                    <a href="/GescaCFS/Pages/PHP/Admin/adminViewTemplates.php"><input type="button" value="Ver plantillas"></a>
                    <a href="/GescaCFS/Pages/PHP/Admin/adminViewDocuments.php"><input type="button" value="Ver documentos"></a>
                <?php endif; ?>
            <?php endif;?>
        </main>
    </div>
</body>
</html>