<?php
session_start();
require("filterInput.php");
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$conn = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);

// input via POST method
if (!empty($_POST)) {
    $username = inputFilter($_POST['username']);
    $password = inputFilter($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM login INNER JOIN users ON login.loginID = users.loginID WHERE username=:user");
    $stmt->bindParam(':user', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    if (password_verify($password, $row['password'])) {
        // assign session variables
        $_SESSION['AdminUser'] = $username;
        $_SESSION['LoginID'] = $row['LoginID'];
        $_SESSION["accessrights"] = $row["accessRights"];
        $_SESSION['login'] = 'yes';
        $_SESSION['userid'] = $row['userID'];

        echo "Welcome " . $_SESSION['AdminUser'];

        // This is the page the user gets sent to when they login
        header('Location: ../homepage.php');
    } else {
        // This is the page the user gets sent to when they fail to login
        echo "Login credentials are incorrect";
        echo "<br><a href='../index.php'></a>";
    }
}
