<?php
session_start();
require("../model/connectionDB.php");
require("../model/dbFunctions.php");
require("filterInput.php");
if (!empty([$_POST])) {
    // input sanitation via testInput function
    $username = inputFilter(($_POST['username']));
    $password = inputFilter(($_POST['password']));
    $accessrights = inputFilter(($_POST['acRights']));
    $firstname = inputFilter(($_POST['firstname']));
    $lastname = inputFilter(($_POST['lastname']));
    $email = inputFilter(($_POST['email']));

    // hashing the password with PASSWORD_HASH()
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("SELECT username FROM login WHERE username = :user");
    $query->bindValue(":user", $username);
    $query->execute();
    if ($query->rowCount() < 1) { // If user does not exist
        newUser($username, $password, $accessrights, $firstname, $lastname, $email); // function call
        echo "User account has been created";
        echo '<h2><a style=text-decoration:none; href="../index.php">Login</a></h2>';
    } else {
        echo "Customer already exists";
        echo '<h2><a style=text-decoration:none; href="../index.php">Login</a></h2>';
       // $error_message = $ex->getMessage();
    }
}
