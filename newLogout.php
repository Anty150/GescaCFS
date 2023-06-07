<?php
session_start();

if(!isset($_SESSION['valid'])){
    header("Location:login.php");
    exit();
}else{
    unset($_SESSION["permission"]);
    unset($_SESSION["username"]);
    unset($_SESSION["valid"]);
    unset($_SESSION["registered"]);
    unset($_SESSION["loginFailed"]);
    unset($_SESSION["registerBadUsername"]);
    unset($_SESSION["registerBadPassword"]);
    session_destroy();
}
?>
<script>
    window.onload = function() {
        window.location.href = "login.php";
    }
</script>
