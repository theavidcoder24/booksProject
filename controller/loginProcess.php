<?php
require("filterInput.php");
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$conn = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
// input via POST method
if (!empty($_POST)) {
    $username = inputFilter($_POST['uname']);
    $password = inputFilter($_POST['upass']);

    $stmt = $conn->prepare("SELECT * FROM login INNER JOIN users ON login.loginID = users.loginID WHERE username=:user");
    $stmt->bindParam(':user', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    if (password_verify($password, $row['password'])) {
        // assign session variables
        $_SESSION['login'] = $row[':user'];
        $_SESSION['LoginID'] = $row['LoginID'];
        $_SESSION["accessrights"] = $row["accessRights"];
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['time_startt_login'] = time('H:i:s');

        /*
        $_SESSION["login"] = 'yes';
        echo "You are now logged in . $username";
*/
        // this will be the page the user gets sent to when they login
        header('Location: ../homepage.php');
    } else {
        // this will be the page the user gets sent to when they fail to login
        echo "Login credentials are incorrect";
        echo "<br><a href='../index.php'></a>";
    }
}
