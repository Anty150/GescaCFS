<?php
    session_start();

    $host= "localhost";
    $username = "root";
    $password = "";
    $dbName = "gescatest";
    $conn = new mysqli($host, $username, $password, $dbName);

    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }

    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT `ID`, `Password`, `Permission` FROM `users` WHERE `User_Name` = ?");
    $stmt->bind_param("s", $loginUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $_SESSION['loginFailed'] = true;
    } else {
        $row = $result->fetch_assoc();
        $dbPasswordHashed = $row['Password'];
        $permission = $row['Permission'];

        if (password_verify($loginPassword, $dbPasswordHashed)) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $loginUsername;
            $_SESSION['permission'] = $permission;

            echo "Conectado";
        } else {
            $_SESSION['loginFailed'] = true;
        }
    }

    $stmt->close();
    $conn->close();
?>

<script>
    window.onload = function() {
        window.location.href = "\\GescaCFS\\Pages\\PHP\\Other\\Main\\mainPage.php";
    }
</script>