<?php
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

    $result = $conn->query("SELECT `ID` FROM `users` WHERE `User Name` = '$loginUsername';");
    if($result->num_rows == 0) {
        //Username does not exist
    } else {
        $query = "SELECT `Password` FROM `users` WHERE `User Name` = '$loginUsername';";
        $result = $conn->query($query);
        $dbPasswordHashed = "";
        while($row = $result->fetch_assoc())
        {
            $dbPasswordHashed = $row['Password'];
        }
        if(password_verify($loginPassword, $dbPasswordHashed)){
            echo "Logged";
        }
        else{
            echo "Password Bad";
        }
    }

    $conn->close();

?>
<body onload="history.go(-1);">
