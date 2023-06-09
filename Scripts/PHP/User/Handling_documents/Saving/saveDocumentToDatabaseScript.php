<?php
session_start();
if(!isset($_SESSION['valid'])){
    header("Location:/GescaCFS/Pages/PHP/Other/Login/login.php");
    exit();
}else{
    date_default_timezone_set('Europe/Madrid');

//Geting date to create unique file name
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

// Database connection parameters
        $host = 'localhost';
        $dbname = 'gescatest';
        $username = 'root';
        $password = '';

// Create a new database connection
        $conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
        if (!$conn) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }

        $userName = $_SESSION['username'];
        $userID = null;

//Get the user ID
        $stmt = $conn->prepare("SELECT ID FROM users WHERE `User_Name` = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $userID = $row['ID'];
        }
        $stmt->close();

        $documentName .= '_' .$date.'/'.$month.'/'.$year.'_'.$hour.'-'.$min.'-'.$sec;

// Prepare the SQL statement to insert the document details into the database
        $sql = "INSERT INTO fills (name, content, time_created, User_ID) VALUES (?, ?, CURRENT_TIMESTAMP, ?)";

// Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

// Bind the parameters
        mysqli_stmt_bind_param($stmt, 'sss', $documentName, $documentContent, $userID);

// Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo 'Document saved successfully.';
        } else {
            echo 'Failed to save the document.';
        }

// Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}





