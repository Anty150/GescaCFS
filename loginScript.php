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

    $result = $conn->query("SELECT `ID` FROM `users` WHERE `User_Name` = '$loginUsername';");
    if($result->num_rows == 0) {
        $_SESSION['loginFailed'] = true;
    } else {
        $query = "SELECT `Password` FROM `users` WHERE `User_Name` = '$loginUsername';";
        $result = $conn->query($query);
        $dbPasswordHashed = "";
        while($row = $result->fetch_assoc())
        {
            $dbPasswordHashed = $row['Password'];
        }
        if(password_verify($loginPassword, $dbPasswordHashed)){
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $loginUsername;
            echo "Logged";
        }
        else{
            $_SESSION['loginFailed'] = true;
        }
    }

    $conn->close();

?>

<script>
    window.onload = function() {
        window.location.href = "index.php";
    }
</script>