<!doctype html>
<?php
session_start();
if(!isset($_SESSION['valid'])){
    header("Location:login.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="wrapper">
    <aside>
        <ul>
            <?php
            if(isset($_SESSION['valid'])){
                echo "<p>Welcome ".$_SESSION["username"]."</p>";
            }else{
                echo "<p>Not logged in</p>";
            }
            ?>
            <li><a href="index.php">Main Page</a></li>
            <li><a href="create.php">Create</a></li>
            <li><a href="fill.php">Fill</a></li>
            <li><a href="see.php">See</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>
    <main>
        <div class="form">
            <form action="" method="POST">
                <p>
                    <span><label for="textFillName">Fill Name</label></span>
                    <span><input type="text" name="textFillName" id="textFillName"></span>
                </p>
                <div id="selectedItem"></div>
                <p>
                    <span><label for="comboSelect">Select</label></span>
                    <span>
                        <select name="comboSelect" id="comboSelect">
                            <option value="None">None</option>
                            <?php
                            global $conn;

                            $hostName = "localhost";
                            $userName = "root";
                            $password = "";
                            $databaseName = "gescatest";
                            $userID = "NULL";

                            $conn = new mysqli($hostName, $userName, $password, $databaseName);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $query = "SELECT users.ID FROM users INNER JOIN names ON users.ID = names.`User ID` WHERE users.User_Name = '".$_SESSION["username"]."';";                            $result = $conn->query($query);
                            $result = $conn->query($query);
                            while ($row = $result->fetch_assoc()) {
                                $userID = $row['ID'];
                                echo $userID;
                            }

                            $query ="SELECT Name FROM `names` WHERE `User ID` = '$userID'
";

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
                            $conn->close();
                            ?>
                        </select>
                    </span>
                </p>

                <div class="textBox" id="textBox"></div>
                <input type="submit" name="submitSubmit" id="submitSubmit">
            </form>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#comboSelect').on('change', function() {
            let selectedItem = $(this).val();
            $("#comboSelect option[value='None']").remove(); //Unsure if trying to delete nonexistent element affects something

            $.ajax({
                type: 'POST',
                url: 'getSelectedItemFromFill.php',
                data: { selectedItem: selectedItem },
                success: function(response) {
                    let spanElements = ''; // Initialize spanElements as an empty string

                    let responses = response.split('#');
                    let fieldNames = responses[0];
                    let names = responses[1];

                    let fieldNamesArray = fieldNames.split('|');
                    let typeArray = names.split('|');

                    for (let i = 0; i < fieldNamesArray.length; i++) {
                        let inputId = 'input' + i;
                        spanElements += '<p><span>' + fieldNamesArray[i];
                        spanElements += '</span><span><input type="' + typeArray[i] + '" id="' + inputId + '"></span></p>';
                    }

                    $('#textBox').html(spanElements);

                    // Event handler for export button
                    $('#submitSubmit').on('click', function() {
                        let documentName = $('#textFillName').val(); // Get the text of the second paragraph
                        if(documentName === ""){
                            documentName = "Unnamed document";
                        }
                        let inputs = $('input[type!="button"], textarea'); // Select all input and textarea elements

                        let docContent = '';
                        inputs.each(function() {
                            let value = "";
                            let label = $(this).closest('p').find('span:first-child').text();
                            if($(this).is(':checkbox')){
                                if($(this).is(":checked")){
                                    value = "True";
                                }else{
                                    value = "False";
                                }
                            }else{
                                value = $(this).val();
                            }

                            if(label !== ""){
                                docContent += label + ': ' + value + '\n';
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            url: 'saveDocumentToDatabase.php',
                            data: {
                                documentName: documentName,
                                documentContent: docContent
                            },
                            success: function(response){
                                alert('Document saved to database.');
                            },
                            error: function(xhr, status, error) {
                                alert('An error occurred while saving the document: ' + error);
                            }
                        });
                    });
                }
            });

        });
    });
</script>
</body>
</html>
