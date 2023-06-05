<!doctype html>
<?php
session_start();
if(!isset($_SESSION['valid'])){
    //header("Location:login.php");
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
            <form action="fill.php" method="POST">
                <p>
                    <span><label for="textName">Fill Name</label></span>
                    <span><input type="text" name="textFillName" id="textFillName"></span>
                </p>
                <div id="selectedItem"></div>
                <p>
                    <span><label for="comboSelect">Select</label></span>
                    <span>
                        <select name="comboSelect" id="comboSelect">
                            <?php
                            global $conn;

                            $hostName = "localhost";
                            $userName = "root";
                            $password = "";
                            $databaseName = "gescatest";
                            $query ="SELECT Name FROM `names`";

                            $conn = new mysqli($hostName, $userName, $password, $databaseName);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $result = $conn->query($query);
                            if($result->num_rows> 0){
                                while($optionData=$result->fetch_assoc()){
                                    $option =$optionData['Name'];
                                    ?>
                                    <?php
                                    if(!empty($courseName) && $courseName== $option){
                                        ?>
                                        <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                                        <?php
                                        continue;
                                    }?>
                                    <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </span>
                </p>

                <div class="textBox" id="textBox">
                    <?php
                    //echo $queryFieldNameTB
                    //$resultFieldNameTB = $conn->query($queryFieldNameTB);
                    ?>
                </div>
                <input type="submit" name="submitSubmit" id="submitSubmit">
            </form>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#comboSelect').on('change', function() {
            let selectedItem = $(this).val();

            $.ajax({
                type: 'POST',
                url: 'getSelectedItemFromFill.php',
                data: { selectedItem: selectedItem },
                success: function(response) {
                    $('#textBox').text(response);
                }
            });
        });
    });
</script>

</body>
</html>
