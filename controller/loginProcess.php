<?php
require("../model/connectionDB.php.php");
require("filterInput.php");
// input via POST method
if(!empty($_POST)) {
    $username = inputFilter($_POST['uname']);
    $password = inputFilter($_POST['upass']);

    $stmt = $conn->prepare("SELECT loginID, password, accessRights FROM login WHERE username=:user");
    $stmt->bindParam(':user', $username);
    $stmt->execute();
    $row = $stmt -> fetch();
    if (password_verify($password, $row['Password'])) {
        // assign session variables
        $_SESSION["adminUser"] = $username;
        $_SESSION["loginID"] = $row["LoginID"];
        $_SESSION["accessRights"] = $row["accessRights"];
        $_SESSION["login"] = 'yes';
        echo "You are now logged in";
    }
    else {
        header('../index.php');
    }
}
