<!doctype html>
<?php
session_start();

if(!isset($_SESSION['valid'])){
    header("Location:/GescaCFS/Scripts/PHP/Other/Login/login.php");
}
if ($_SESSION['permission'] != 'admin') {
    header("Location:/GescaCFS/Pages/PHP/Other/Main/mainPage.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/GescaCFS/Styles/styles.css">
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
            <li><a href="/GescaCFS/Pages/PHP/Other/Main/mainPage.php">Main Page</a></li>
            <li><a href="/GescaCFS/Pages/PHP/User/userCreate.php">Create</a></li>
            <li><a href="/GescaCFS/Pages/PHP/User/userFill.php">Fill</a></li>
            <li><a href="/GescaCFS/Pages/PHP/User/userSee.php">See</a></li>
            <li><a href="/GescaCFS/Scripts/PHP/Other/Logout/newLogoutScript.php">Logout</a></li>
        </ul>
    </aside>
    <main>
        <div class="form">
            <h3>Users Templates</h3>
            <div class="textBox" id="textBox">
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

                        $userQuery = "SELECT User_Name FROM users WHERE ID = ?";
                        $userStmt = $conn->prepare($userQuery);
                        $userStmt->bind_param("i", $dataResult['User ID']);
                        $userStmt->execute();
                        $userResult = $userStmt->get_result();
                        $username = '';
                        if ($userResult->num_rows > 0) {
                            $userData = $userResult->fetch_assoc();
                            $username = $userData['User_Name'];
                        }

                        echo '<a href="#paragraphDisplayText" id="hyperlink'.$iter.'" data-id="'.$dataResult['ID'].'" data-user="'.$dataResult['User ID'].'"><p><span>'.$displayName.'</span></a><span>'.$username.'</span></p>';
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
                                    url: '\\GescaCFS\\Scripts\\PHP\\Admin\\Handling_template\\adminViewTemplatesScript.php',
                                    data: {selectedID: id},
                                    success: function(response) {
                                        document.getElementById('paragraphDisplayText').innerHTML = '<pre>' + response + '</pre>';

                                        $('#deleteButton').remove(); // Remove existing button if any
                                        $('#paragraphDisplayText').append('<input type="button" id="deleteButton" value="Delete">');

                                        $('#deleteButton').on('click', function () {
                                            $.ajax({
                                                type: 'POST',
                                                url: '\\GescaCFS\\Scripts\\PHP\\Admin\\Handling_template\\adminDeleteTemplatesScript.php',
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