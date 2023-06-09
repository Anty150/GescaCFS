<?php
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: /GescaCFS/Scripts/PHP/Other/Login/loginScript.php");
    exit();
}else{
    date_default_timezone_set('Europe/Madrid');

    $info = getdate();
    $date = $info['mday'];
    $month = $info['mon'];
    $year = $info['year'];
    $hour = $info['hours'];
    $min = $info['minutes'];
    $sec = $info['seconds'];

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Retrieve the document name and content from the client-side
        $documentName = $_POST['documentName'];
        $documentContent = $_POST['documentContent'];

        $host = 'localhost';
        $dbname = 'gescatest';
        $username = 'root';
        $password = '';
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (!$conn) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

        $userName = $_SESSION['username'];
        $userID = null;

        $stmt = $conn->prepare("SELECT ID FROM users WHERE `User_Name` = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $userID = $row['ID'];
        }
        $stmt->close();

        $documentName .= '_' .$date.'/'.$month.'/'.$year.'_'.$hour.'-'.$min.'-'.$sec;

        $sql = "INSERT INTO fills (name, content, time_created, User_ID) VALUES (?, ?, CURRENT_TIMESTAMP, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $documentName, $documentContent, $userID);

        if (mysqli_stmt_execute($stmt)) {
            echo 'Documento guardado correctamente.';
        } else {
            echo 'No se ha podido guardar el documento.';
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}





