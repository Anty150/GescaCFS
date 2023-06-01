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
            <form action="fill.php" method="POST">
                <p>
                    <span><label for="textName">Fill Name</label></span>
                    <span><input type="text" name="textFillName" id="textFillName"></span>
                </p>

                <p>
                    <span><label for="comboSelect">Select</label></span>
                    <span><select name="comboSelect" id="comboSelect">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="-">Other</option></span>
                    </select>
                </p>

                <p>
                    <input type="button" name="buttonAdd" id="buttonAdd" value="+">
                    <input type="button" name="buttonRemove" id="buttonRemove" value="-">
                </p>


                <div class="textBox">
                    <br>
                    <br>
                    TEXT
                    <br>
                    <br>
                    <br>
                </div>
                <input type="submit" name="submitSubmit" id="submitSubmit">
            </form>
        </div>
    </main>
</div>
</body>
</html>