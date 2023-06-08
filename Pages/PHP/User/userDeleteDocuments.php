<!doctype html>
<?php
session_start();

if(!isset($_SESSION['valid'])){
    header("Location:/GescaCFS/Scripts/PHP/Other/Login/login.php");
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Document</title>
    <link rel="stylesheet" href="/GescaCFS/Styles/styles.css">
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
        <?php
        if(isset($_SESSION['isDuplicate'])){
            if ($_SESSION['isDuplicate']){
                echo "<p>Name already exists!</p>";
                $_SESSION['isDuplicate'] = false;
            }
        }
        ?>
        <div class="form">
            <p><h3>Created documents</h3></p>
            <form action="/GescaCFS/Scripts/PHP/User/Handling_documents/Deleting/deleteDocumentsScript.php" method="POST">
                <input type="hidden" name="textBoxContent" value="" id="textBoxContent">
                <div class="textBox" id="textBox">
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

                    $query = "SELECT Name FROM fills WHERE User_ID = '$userID'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        $counter = 0;
                        while ($dataResult = $result->fetch_assoc()) {
                            $rowResult = $dataResult['Name'];
                            ?>
                            <?php
                            if (!empty($courseName) && $courseName == $rowResult) {
                                ?>
                                <p id="p<?php echo $counter; ?>" onclick="operationsOnRows(id)"><?php echo $rowResult; ?></p>
                                <?php
                                continue;
                            } ?>
                            <p id="p<?php echo $counter; ?>" onclick="operationsOnRows(id)"><?php echo $rowResult; ?></p>
                            <?php
                            $counter++;
                        }
                    }
                    $conn->close();
                    ?>
                </div>
                <p>
                    <span><input type="button" name="buttonRemove" id="buttonRemove" value="Delete"></span>
                </p>
                <p>
                    <span><input type="button" name="buttonRemoveAll" id="buttonRemoveAll" value="Remove All" onclick="removeAll()"></span>
                </p>
            </form>
        </div>
    </main>
</div>
<script>
    let clickHandler
    let previousClickHandler;
    let previousId = "p0";
    let isSelected = false;

    function removeAll(){
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "\\GescaCFS\\Scripts\\PHP\\User\\Handling_documents\\Deleting\\deleteDocumentsScriptAll.php", true);

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };

        xhr.send("Name=" + encodeURIComponent(name));
        document.getElementById("textBox").innerHTML = "";

        isSelected = false;
        previousId = "p0";
    }
    function operationsOnRows(id) {
        isSelected = true;
        buttonRemove.removeEventListener("click", previousClickHandler, false);
        clickHandler = function() {
            if(isSelected){
                const rowToRemove = document.getElementById(id);

                rowToRemove.remove();
                isSelected = false;

                // Wywołaj funkcję do usunięcia rekordu z bazy danych
                deleteFromDatabase(rowToRemove.innerText);
            }
        };
        buttonRemove.addEventListener("click", clickHandler, false);
        previousClickHandler = clickHandler;

        p_previousId = document.getElementById(previousId);
        if (p_previousId !== null) {
            p_previousId.style.backgroundColor = "#f2f2f2";
        }
        previousId = id;

        let p_currentId = document.getElementById(id);
        if (p_currentId !== null) {
            p_currentId.style.backgroundColor = "#45a049";
        }
    }

    function deleteFromDatabase(name) {
        // Tworzymy nowy obiekt XMLHTTPRequest
        let xhr = new XMLHttpRequest();

        // Ustawiamy metodę i adres URL skryptu usuwającego
        xhr.open("POST", "\\GescaCFS\\Scripts\\PHP\\User\\Handling_documents\\Deleting\\deleteDocumentsScript.php", true);

        // Ustawiamy nagłówek żądania, aby wysłać dane w formacie URL-encoded
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Definiujemy funkcję zwrotną, która zostanie wywołana po otrzymaniu odpowiedzi od serwera
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Wyświetlamy odpowiedź serwera w konsoli
                console.log(xhr.responseText);
            }
        };

        // Wysyłamy żądanie POST z nazwą do usunięcia jako parametrem
        xhr.send("Name=" + encodeURIComponent(name));
    }
</script>

</body>
</html>
