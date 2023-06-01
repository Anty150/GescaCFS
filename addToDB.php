<?php
$host= "localhost";
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
            $values[] = array(
                'textFieldName' => $textFieldName,
                'comboType' => $comboType
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

    foreach ($paragraphValues as $values) {
        $sql = "INSERT INTO `field names` (`ID`, `Field Name`, `Type`, `Name ID`, `User ID`) VALUES (NULL, '$values[textFieldName]', '$values[comboType]', '1', '1')";
        echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        echo "textFieldName: " . $values['textFieldName'] . "<br>";
        echo "comboType: " . $values['comboType'] . "<br>";
        echo "<br>";
    }
    $conn->close();
}
?>
<body onload="history.go(-1);">
