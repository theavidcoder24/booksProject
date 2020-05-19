<?php
session_start();
require("../model/connectionDB.php");
require("../model/userFunctions.php");
require("filterInput.php");
if (!empty([$_POST])) {
    // input sanitation via testInput function
    $username = testInput($_POST['username']);
    $password = testInput($_POST['pass']);
    $accessrights = testInput($_POST['acRights']);
    $firstName = testInput($_POST['fname']);
    $lastName = testInput($_POST['lname']);
    $email = testInput($_POST['email']);

    // hashing the password with PASSWORD_HASH()
    $hpassword = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("SELECT username FROM login WHERE username = :user");
    $query->bindValue(":user", $username);
    $query->execute();
    if ($query->rowCount() < 1) { // If user does not exist
        newUser($username, $password, $accessrights, $firstname, $lastname, $email); // function call
        echo "User account has been created";
    } else {
        echo "Customer already exists";
    }
}
?>