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

    $result = $conn->query("SELECT `ID` FROM `users` WHERE `User_Name` = '$registerUsername';");
    if($result->num_rows == 0) {
        if(strlen($registerPassword) < 8){
            //Password is bad
        }
        else{
            $hashedPassword = hashPassword($registerPassword);
            $sql = "INSERT INTO `users` (`ID`, `User_Name`, `Password`) VALUES (NULL, '$registerUsername', '$hashedPassword')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['registered'] = true;
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        // do other stuff...
    }
    $conn->close();

    function hashPassword($password){

        password_hash($password, PASSWORD_DEFAULT);
        return password_hash($password, PASSWORD_DEFAULT);
    }
?>
<script>
    window.onload = function() {
        window.location.href = "index.php";
    }
</script>
