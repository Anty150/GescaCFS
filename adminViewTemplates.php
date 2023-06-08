<!doctype html>
<?php
session_start();

if(!isset($_SESSION['valid'])){
    header("Location:login.php");
}
if ($_SESSION['permission'] != 'admin') {
    header("Location:index.php");
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
            <h3>Users Templates</h3>
            <div class="ignoreWidthTextBox" id="textBox">
                <?php
                $hostName = "localhost";
                $userName = "root";
                $password = "";
                $databaseName = "gescatest";

                $conn = new mysqli($hostName, $userName, $password, $databaseName);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT * FROM `names`";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $iter = 0;
                    while ($dataResult = $result->fetch_assoc()) {
                        $displayName = $dataResult['Name'];
                        echo '<a href="#paragraphDisplayText" id="hyperlink'.$iter.'" data-id="'.$dataResult['ID'].'" data-user="'.$dataResult['User ID'].'"><p><span>'.$displayName.'</span></p></a>';
                        $iter++;
                    }
                }

                $conn->close();
                ?>
                <script>
                    $(document).ready(function() {
                        $('a').on('click', function() {
                            if (!$(this).hasClass('selected')) {
                                let id = $(this).data('id');
                                let name = $(this).find('span:first-child').text();
                                let userId = $(this).data('user');

                                $.ajax({
                                    type: 'POST',
                                    url: 'adminViewTemplatesScript.php',
                                    data: {selectedID: id},
                                    success: function(response) {
                                        document.getElementById('paragraphDisplayText').innerHTML = '<pre>' + response + '</pre>';

                                        $('#deleteButton').remove(); // Remove existing button if any
                                        $('#paragraphDisplayText').append('<input type="button" id="deleteButton" value="Delete">');

                                        $('#deleteButton').on('click', function () {
                                            $.ajax({
                                                type: 'POST',
                                                url: 'adminDeleteTemplates.php',
                                                data: {Name: name, UserID: userId},
                                                success: function (response) {
                                                    console.log(response);
                                                    location.reload();
                                                },
                                                error: function (xhr, status, error) {
                                                    alert("Error: " + error);
                                                }
                                            });
                                        });
                                    }
                                });
                            } else {
                                return 0;
                            }
                        });
                    });
                </script>

            </div>
            <h3>Templates Preview</h3>
            <div class="ignoreWidthTextBox" id="textPreview">
                <p id="paragraphDisplayText"></p>
            </div>
        </div>
    </main>
</div>
</body>
</html>
