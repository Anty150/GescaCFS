<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location:/GescaCFS/Pages/PHP/Other/Login/login.php");
    exit();
} else {
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbName = "gescatest";

    function getParagraphValues($html) {
        $values = array();

        if (!empty($html)) {
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($html);
            libxml_use_internal_errors(false);

            $paragraphs = $doc->getElementsByTagName('p');

            foreach ($paragraphs as $paragraph) {
                $spanElements = $paragraph->getElementsByTagName('span');
                $textFieldName = $spanElements->item(0)->nodeValue;
                $comboType = $spanElements->item(1)->nodeValue;

                // Sanitize and validate field values
                $sanitizedTextFieldName = filter_var($textFieldName, FILTER_SANITIZE_STRING);
                $sanitizedComboType = filter_var($comboType, FILTER_SANITIZE_STRING);

                $values[] = array(
                    'textFieldName' => $sanitizedTextFieldName,
                    'comboType' => $sanitizedComboType
                );
            }
        }

        return $values;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli($host, $username, $password, $dbName);

        if ($conn->connect_error) {
            die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
        }

        $html = $_POST['textBoxContent'];
        $paragraphValues = getParagraphValues($html);
        $nameValue = $_POST["textName"];
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

        // Check if name already exists
        $stmt = $conn->prepare("SELECT `name` FROM `names` WHERE `name` = ? AND `User ID` = ?");
        $stmt->bind_param("si", $nameValue, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['isDuplicate'] = true;
        } else {
            // Adding new Name to names table
            $stmt = $conn->prepare("INSERT INTO `names` (`ID`, `Name`, `User ID`) VALUES (NULL, ?, ?)");
            $stmt->bind_param("si", $nameValue, $userID);
            if ($stmt->execute()) {
                echo "New record created successfully";
                $nameID = $stmt->insert_id;
                $stmt->close();

                foreach ($paragraphValues as $values) {
                    // Adding new Field names corresponding to the created name
                    $stmt = $conn->prepare("INSERT INTO `field names` (`ID`, `Field Name`, `Type`, `Name ID`, `User ID`) VALUES (NULL, ?, ?, ?, ?)");
                    $stmt->bind_param("ssii", $values['textFieldName'], $values['comboType'], $nameID, $userID);
                    if ($stmt->execute()) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    echo "textFieldName: " . $values['textFieldName'] . "<br>";
                    echo "comboType: " . $values['comboType'] . "<br>";
                    echo "<br>";
                    $stmt->close();
                }
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        $conn->close();
    }
}
?>
<body onload="history.go(-1);">
