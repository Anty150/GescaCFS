<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
            <form action="fill.php" method="POST">
                <label for="textFillName">Fill Name</label><input type="text" name="textFillName" id="textFillName">
                </br>
                <label for="comboSelect">Select</label>
                <select name="comboSelect" id="comboSelect">
                    <?php


                    ?>
                </select>
                </br>
                <div class="textbox">
                    lorem lorem ipsum lorem
                </div>
                <input type="submit" name="submitSubmit" id="submitSubmit">
            </form>
        </div>
    </div>
</div>
</body>
</html>