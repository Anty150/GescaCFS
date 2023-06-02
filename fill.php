<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="wrapper">
    <aside>
        <ul>
            <li><a href="create.php">Create</a></li>
            <li><a href="fill.php">Fill</a></li>
            <li><a href="see.php">See</a></li>
        </ul>
    </aside>
    <main>
        <div class="form">
            <form action="fill.php" method="POST">
                <p>
                    <span><label for="textName">Fill Name</label></span>
                    <span><input type="text" name="textFillName" id="textFillName"></span>
                </p>

                <p>
                    <span><label for="comboSelect">Select</label></span>
                    <span><select name="comboSelect" id="comboSelect" onchange="handleSelectChange()">

                            <script>
                                function handleSelectChange() {
                                    let selectedOption = document.getElementById("comboSelect").value;
                                    let paragraph = document.createElement("p");

                                    paragraph.innerHTML = selectedOption;
                                    paragraph.setAttribute("id", "1");
                                    paragraph.style.display = "none";
                                    document.body.appendChild(paragraph);

// ChatGPT
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "fill.php", true);//nie moze byc ten sam plik
                                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            var response = xhr.responseText;
                                            console.log("Wartość odczytana przez skrypt PHP: " + response);
                                        } else {
                                            console.log("Wystąpił błąd podczas wywoływania skryptu PHP.");
                                        }
                                    };
                                    xhr.send("value=" + encodeURIComponent(paragraph.innerHTML));
                                }
                            </script>
                            <?php
                            $value = $_POST['value'];
                            echo $value;
                            ?>
// ChatGPT
                            <?php
                        $hostName = "localhost";
                        $userName = "root";
                        $password = "";
                        $databaseName = "gescatest";
                        $query ="SELECT Name FROM `names`";

                        $conn = new mysqli($hostName, $userName, $password, $databaseName);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $result = $conn->query($query);
                        if($result->num_rows> 0){
                            while($optionData=$result->fetch_assoc()){
                                $option =$optionData['Name'];
                                ?>
                                <?php
                                if(!empty($courseName) && $courseName== $option){
                                    ?>
                                    <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                                    <?php
                                    continue;
                                }?>
                                <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                                <?php
                            }
                        }

                        ?>
                    </select>
                </p>

                <div class="textBox" id="textBox">
                    <?php

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['mySelect'])) {
                            $selectedOption = $_POST['comboSelect'];
                            echo "Wybrana opcja: " . $selectedOption;
                        }
                    }
                    //$queryFieldNameTB = "SELECT `field name` FROM `field names` JOIN names ON `field names`.`Name ID` = names.ID WHERE names.Name = $Name";
                    //$resultFieldNameTB = $conn->query($queryFieldNameTB);

                    $conn->close();
                    ?>
                </div>
                <input type="submit" name="submitSubmit" id="submitSubmit">
            </form>
        </div>
    </main>
</div>
</body>
</html>