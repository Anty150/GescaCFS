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
            <div class="ignoreWidthTextBox" id="textBox">
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

                $query = "SELECT users.ID FROM users INNER JOIN names ON users.ID = names.`User ID` WHERE users.User_Name = '".$_SESSION["username"]."';";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    $userID = $row['ID'];
                }

                global $userID, $conn;
                $query = "SELECT Name FROM fills WHERE User_ID = '$userID'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $iter = 0;
                    while ($dataResult = $result->fetch_assoc()) {
                        $displayName = $dataResult['Name'];
                        echo '<a href="#" id="hyperlink'.$iter.'"><p><span>'.$displayName.'</span></p></a>';
                        $iter++;
                    }
                }
                $conn->close();
                ?>
                <script>
                    $(document).ready(function() {
                        $( 'p' ).on( "click", function() {
                            let name = $(this).find('span:first-child').text();;

                            $.ajax({
                                type: 'POST',
                                url: 'getTextToDownload.php',
                                data: {selectedName: name},
                                success: function (response){
                                    let responses = response.split('#');

                                    let content = responses[0];
                                    let date = responses[1];

                                    let docContent = content + date;
                                    let link = document.createElement('a');
                                    link.href = 'data:application/msword,' + encodeURIComponent(docContent);
                                    link.download = name + '.txt'; // Set the .doc file name as the second paragraph text
                                    link.style.display = 'none';
                                    document.body.appendChild(link);
                                    link.click();
                                    document.body.removeChild(link);

                                }
                            });
                    });
                    } );
                </script>

            </div>
        </div>
    </main>
</div>
</body>
</html>
