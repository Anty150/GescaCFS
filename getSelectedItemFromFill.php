<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedItem = $_POST['selectedItem'];

    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "gescatest";
    $conn = new mysqli($hostName, $userName, $password, $databaseName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $userName = $_SESSION['username'];
    $userID = "NULL";

    $sql = "SELECT ID FROM users WHERE `User_Name` = '$userName';";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $userID = $row['ID'];
    }

    $queryFieldNameTB = "SELECT `field name` FROM `field names` JOIN names ON `field names`.`Name ID` = names.ID WHERE names.Name = '$selectedItem' AND `field names`.`User ID` = '$userID';";
    $result = $conn->query($queryFieldNameTB);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fieldNames[] = $row['field name'];
        }
        $response1 = implode('|', $fieldNames);
    }
    else {
        $response1 = "No field names found.";
    }

    $queryTypesTB = "SELECT `type` FROM `field names` JOIN names ON `field names`.`Name ID` = names.ID WHERE names.Name = '$selectedItem' AND `field names`.`User ID` = '$userID';";
    $resultAllNames = $conn->query($queryTypesTB);

    if ($resultAllNames->num_rows > 0) {
        $names = array();
        while ($row = $resultAllNames->fetch_assoc()) {
            $names[] = $row['type'];
        }
        $response2 = implode('|', $names);
    } else {
        $response2 = "No names found.";
    }

    $conn->close();

    echo $response1 . "#" . $response2;
}
?>