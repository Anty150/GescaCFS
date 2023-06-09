<?php
    session_start();

    $passwordMinimumCharacters = 8;

    $host= "localhost";
    $username = "root";
    $password = "";
    $dbName = "gescatest";

    $conn = new mysqli($host, $username, $password, $dbName);

    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }

    $registerUsername = $_POST['username'];
    $registerPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT `ID` FROM `users` WHERE `User_Name` = ?");
    $stmt->bind_param("s", $registerUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        if (strlen($registerPassword) < 8) {
            $_SESSION['registerBadPassword'] = true;
        } else {
            $hashedPassword = hashPassword($registerPassword);
            $stmt = $conn->prepare("INSERT INTO `users` (`ID`, `User_Name`, `Password`) VALUES (NULL, ?, ?)");
            $stmt->bind_param("ss", $registerUsername, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['registered'] = true;
                echo "Nuevo registro creado con éxito";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    } else {
        $_SESSION['registerBadUsername'] = true;
    }

    $stmt->close();
    $conn->close();

    function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
?>
<script>
    window.onload = function() {
        window.location.href = "\\GescaCFS\\Pages\\PHP\\Other\\Main\\mainPage.php";
    }
</script>
