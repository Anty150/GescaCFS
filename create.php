<!doctype html>
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
                <li><a href="create.php">Create</a></li>
                <li><a href="fill.php">Fill</a></li>
                <li><a href="see.php">See</a></li>
            </ul>
        </aside>
        <main>
            <div class="form">
                <form action="create.php" method="POST">
                    <p>
                        <span><label for="textName">Name</label></span>
                        <span><input type="text" name="textName" id="textName"></span>
                    </p>

                    <p>
                        <span><label for="textFieldName">Fieldname</label></span>
                        <span><input type="text" name="textFieldName" id="textFieldName"></span>
                    </p>

                    <p>
                        <span><label for="comboType">Type</label></span>
                        <span><select name="comboType" id="comboType">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="-">Other</option>
                        </select></span>
                    </p>

                    <p>
                        <input type="button" name="buttonAdd" id="buttonAdd" value="+" onclick="addToTextBox()">
                        <input type="button" name="buttonRemove" id="buttonRemove" value="-">
                    </p>


                    <div class="textBox" id="textBox">

                    </div>
                    <input type="submit" name="submitSubmit" id="submitSubmit">
                </form>
            </div>
        </main>
    </div>
</body>
</html>