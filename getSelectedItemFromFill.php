<?php
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

    $queryFieldNameTB = "SELECT `field name` FROM `field names` JOIN names ON `field names`.`Name ID` = names.ID WHERE names.Name = '$selectedItem'";
    echo  $queryFieldNameTB;
    $result = $conn->query($queryFieldNameTB);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fieldName = $row['field name'];
            echo $fieldName;
        }
    } else {
        echo "No field name found.";
    }

    $conn->close();
}
?>
