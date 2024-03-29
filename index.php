<?php
include('model/dbFunctions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Books Style -->
    <link rel="stylesheet" href="view/css/books.css">
    <!-- Font Awesome Style -->
    <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
    <link rel="icon" href="view/images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Login</title>
</head>

<body>
    <header>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <div class="loginForm">
        <fieldset>
            <legend>User Login</legend>
            <form action="controller/loginProcess.php" method="POST">
                <label for="password">Username</label>
                <input type="text" name="username" id="username" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <input type="submit" value="login">
            </form>
        </fieldset>
    </div>
    <footer>

    </footer>
</body>

</html>