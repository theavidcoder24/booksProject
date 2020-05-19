<?php
session_start();
require("../model/connectionDB.php");
require("../model/userFunctions.php");
require("inputFilter.php");
if (!empty([$_POST])) {
    // input sanitation via testInput function
    $userID = inputFilter($_POST['userID']);
    $firstName = inputFilter($_POST['fname']);
    $lastName = inputFilter($_POST['lname']);
    $email = inputFilter($_POST['email']);
    $loginID = inputFilter($_POST['loginID']);
    $password = inputFilter($_POST['pass']);

    // hashing the password with PASSWORD_HASH()
    $hpassword = password_hash($mypass, PASSWORD_DEFAULT);
    $query = $conn->prepare("SELECT username FROM login WHERE username = :user");
    $query->bindValue(":user", $username);
    $query->execute();
    if ($query->rowCount() < 1 ) { // if user does not exist
        newUser($username, $password, $role, $firstname, $lastname, $email, $phone); // function call
        echo "User account has been created";
    }
    else {
        echo "Customer already exists";
    }
}