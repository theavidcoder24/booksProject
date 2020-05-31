<?php
require("../model/connectionDB.php");
require("filterInput.php");

// input via POST method
if (!empty($_POST)) {
    $username = inputFilter($_POST['uname']);
    $password = inputFilter($_POST['upass']);

    $stmt = $conn->prepare("SELECT loginID, password, accessRights FROM login WHERE username=:user");
    $stmt->bindParam(':user', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    if (password_verify($password, $row['password'])) {
        // assign session variables
        $_SESSION["LoginID"] = $row["loginID"];
        $_SESSION["adminUser"] = $username["username"];
        $_SESSION["AccessRights"] = $row["accessRights"];
        $_SESSION["login"] = 'yes';
        echo "You are now logged in . $username";

        // this will be the page the user gets sent to when they login
        header('Location: ../homepage.php');
    }
    //display a user message if action is successful
    elseif (isset($_SESSION['success'])) {
        echo '<div class="success">';
        echo '<p>' . $_SESSION['success'] . '</p>';
        echo '</div>';
        //unset the session named 'success' else it will show each time you visit the page
        unset($_SESSION['success']);
    } 
    else {
        // this will be the page the user gets sent to when they fail to login
        header('Location: ../homepage.php');
    }
}
