<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    global $conn;

    $selectedName = $_POST['selectedName'];
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "gescatest";

    $userID = "NULL";

    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT users.ID FROM users INNER JOIN names ON users.ID = names.`User ID` WHERE users.User_Name = '".$_SESSION["username"]."';";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $userID = $row['ID'];
    }
    global $userID, $conn;
    $query = "SELECT Content, Time_Created FROM fills WHERE User_ID = '$userID' AND Name = '$selectedName'";
    $result = $conn->query($query);
    $response1 = '';
    $response2 = '';

    if ($result->num_rows > 0) {
        while ($dataResult = $result->fetch_assoc()) {
            $response1 = $dataResult['Content'];
            $response2 = $dataResult['Time_Created'];
        }
    }
    echo $response1 . "#" . $response2;

    /*downloadFile($selectedName);
    function downloadFile($selectedName){
        global $userID, $conn;
        $query = "SELECT Content, Time_Created FROM fills WHERE User_ID = '$userID' AND Name = '$selectedName'";
        $result = $conn->query($query);
        $response1 = '';
        $response2 = '';

        if ($result->num_rows > 0) {
            while ($dataResult = $result->fetch_assoc()) {
                $response1 = $dataResult['Content'];
                $response2 = $dataResult['Time_Created'];
            }
        }
        echo $response1 . "#" . $response2;
    }*/
    $conn->close();

}
?>
