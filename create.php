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
<div class="container">
    <div class="navbar">
        <ul>
            <li><a href="create.php">Create</a></li>
            <li><a href="fill.php">Fill</a></li>
            <li><a href="see.php">See</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="form">
            <form action="create.php" method="POST">
                <label for="textName">Name: </label>
                <input type="text" name="textName" id="textName">
                <br>
                <label for="textFieldName">Fieldname: </label>
                <input type="text" name="textFieldName" id="textFieldName">
                <br>
                <label for="comboType">Type: </label>
                <select name="comboType" id="comboType">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="-">Other</option>
                </select>
                <br>
                <input type="button" name="buttonAdd" id="buttonAdd" value="+">
                <input type="button" name="buttonRemove" id="buttonRemove" value="-">
                <br>
                <div class="textBox">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <input type="submit" name="submitSubmit" id="submitSubmit">
            </form>
        </div>
    </div>
</div>
</body>
</html>