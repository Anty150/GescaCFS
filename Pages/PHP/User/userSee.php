<!doctype html>
<?php
session_start();

if(!isset($_SESSION['valid'])){
    header("/GescaCFS/Scripts/PHP/Other/Login/loginScript.php");
    exit();
}
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver</title>
    <link rel="stylesheet" href="/GescaCFS/Styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="wrapper">
    <aside>
        <ul>
            <?php
            if(isset($_SESSION['valid'])){
                echo "<p>Bienvenido ".$_SESSION["username"]."</p>";
            }else{
                echo "<p>No conectado.</p>";
            }
            ?>
            <li><a href="/GescaCFS/Pages/PHP/Other/Main/mainPage.php">Página principal</a></li>
            <li><a href="/GescaCFS/Pages/PHP/User/userCreate.php">Crear</a></li>
            <li><a href="/GescaCFS/Pages/PHP/User/userFill.php">Rellenar</a></li>
            <li><a href="/GescaCFS/Pages/PHP/User/userSee.php">Ver</a></li>
            <li><a href="/GescaCFS/Scripts/PHP/Other/Logout/newLogoutScript.php">Cierre de sesión</a></li>
        </ul>
    </aside>
    <main>
        <div class="form">
            <h3>Your Documents</h3>
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

                $userID = null;

                $query = "SELECT users.ID FROM users INNER JOIN names ON users.ID = names.`User ID` WHERE users.User_Name = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $_SESSION["username"]);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $userID = $row['ID'];
                }

                $query = "SELECT Name FROM fills WHERE User_ID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $userID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $iter = 0;
                    while ($dataResult = $result->fetch_assoc()) {
                        $displayName = $dataResult['Name'];
                        echo '<a href="#paragraphDisplayText" id="hyperlink'.$iter.'"><p><span>'.$displayName.'</span></p></a>';
                        $iter++;
                    }
                }

                $conn->close();
                ?>
                <script>
                    $(document).ready(function() {
                        $( 'a' ).on( "click", function() {
                            if (!$(this).hasClass("selected")){
                                let name = $(this).find('span:first-child').text();

                                $.ajax({
                                    type: 'POST',
                                    url: '\\GescaCFS\\Scripts\\PHP\\User\\Handling_documents\\Getting\\getTextToDownloadScript.php',
                                    data: {selectedName: name},
                                    success: function (response){
                                        let responses = response.split('#');

                                        let content = responses[0];
                                        let date = responses[1];

                                        let docContent = content + date;
                                        document.getElementById("paragraphDisplayText").innerHTML = ("<pre>" + docContent + "</pre>");

                                        $('#downloadButton').remove();
                                        $('#paragraphDisplayText').append('<input type="button" id="downloadButton" value="Descargar">');

                                        $('#downloadButton').on('click', function() {
                                            let link = document.createElement('a');
                                            link.href = 'data:application/msword,' + encodeURIComponent(docContent);
                                            link.download = name + '.txt';
                                            link.style.display = 'none';
                                            document.body.appendChild(link);
                                            link.click();
                                            document.body.removeChild(link);
                                            });

                                        $('#deleteButton').remove();
                                        $('#paragraphDisplayText').append('<input type="button" id="deleteButton" value="Borrar">');

                                        $('#deleteButton').on('click', function () {
                                            $.ajax({
                                                type: 'POST',
                                                url: '\\GescaCFS\\Scripts\\PHP\\User\\Handling_documents\\Deleting\\deleteDocumentsScript.php',
                                                data: {Name: name},
                                                success: function (response) {
                                                    location.reload();
                                                },
                                                error: function (xhr, status, error) {
                                                    alert("Error: " + error);
                                                }
                                            });
                                        });
                                    }
                                });
                            }
                            else{
                                return 0;
                            }
                        });
                    });
                </script>
            </div>
            <h3>Vista previa del documento</h3>
            <div class="ignoreWidthTextBox" id="textPreview">
                <p id="paragraphDisplayText"></p>
            </div>
        </div>
    </main>
</div>
</body>
</html>
