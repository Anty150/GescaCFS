<?php
session_start();

if(!isset($_SESSION['valid'])){
    header("Location:login.php");
}else{
    unset($_SESSION["permission"]);
    unset($_SESSION["username"]);
    unset($_SESSION["valid"]);
    unset($_SESSION["registered"]);
    unset($_SESSION["loginFailed"]);
}
?>
<script>
    window.onload = function() {
        window.location.href = "login.php";
    }
</script>
