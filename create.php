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
    <script src="addToTextBox.js"></script>
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
            <?php
                if(isset($_SESSION['isDuplicate'])){
                    if ($_SESSION['isDuplicate']){
                        echo "<p>Name already exists!</p>";
                        $_SESSION['isDuplicate'] = false;
                    }
                }
            ?>
            <div class="form">
                <form action="addToDB.php" method="POST" onsubmit="return validateForm()">
                    <p>
                        <span><label for="textName">Name</label></span>
                        <span><input type="text" name="textName" id="textName"></span>
                    </p>

                    <p>
                        <span><label for="textFieldName">Field name</label></span>
                        <span><input type="text" name="textFieldName" id="textFieldName"></span>
                    </p>

                    <p>
                        <span><label for="comboType">Type</label></span>
                        <span><select name="comboType" id="comboType">
                            <option value="text">Text</option>
                            <option value="date">Date</option>
                            <option value="checkbox">Checkbox</option>
                        </select></span>
                    </p>

                    <p>
                        <input type="button" name="buttonAdd" id="buttonAdd" value="+" onclick="addToTextBox()">
                        <input type="button" name="buttonRemove" id="buttonRemove" value="-">
                    </p>

                    <input type="hidden" name="textBoxContent" value="" id="textBoxContent">
                    <div class="textBox" id="textBox">

                    </div>
                    <input type="submit" name="submitSubmit" id="submitSubmit">
                </form>
            </div>
        </main>
    </div>
    <script>
        function validateForm() {
            var name = document.getElementById("textName").value;
            var fieldName = document.getElementById("textFieldName").value;

            if (name.trim() === "" || fieldName.trim() === "") {
                alert("Please fill in all the fields.");
                return false;
            }
        }
    </script>
</body>
</html>