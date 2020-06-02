<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/books.css">
    <link rel="icon" href="view/images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Login</title>
</head>

<body>
    <header>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <?php 
    $_SESSION["login"] = "$username";
    $_SESSION["favcolor"] = "green";
    ?>
    <div class="loginForm">
        <fieldset>
            <legend>User Login</legend>
            <form action="controller/loginProcess.php" method="POST">
                <label for="uname">Username</label>
                <input type="text" name="uname" id="uname">
                <label for="upass">Password</label>
                <input type="password" name="upass" id="upass">
                <input type="submit" value="login">
            </form>
        </fieldset>
    </div>
    <footer>

    </footer>
</body>

</html>