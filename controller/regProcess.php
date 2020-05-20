<?php
session_start();
require("../model/connectionDB.php");
require("../model/userFunctions.php");
require("filterInput.php");
if (!empty([$_POST])) {
    // input sanitation via testInput function
    $username = !empty($_POST['username']) ? testInput(($_POST['username'])) : null;
    $password = !empty($_POST['pass']) ? testInput(($_POST['pass'])) : null;
    $accessrights = !empty($_POST['acRights']) ? testInput(($_POST['acRights'])) : null;
    $firstname = !empty($_POST['firstname']) ? testInput(($_POST['firstname'])) : null;
    $lastname = !empty($_POST['lastname']) ? testInput(($_POST['lastname'])) : null;
    $email = !empty($_POST['email']) ? testInput(($_POST['email'])) : null;

    // hashing the password with PASSWORD_HASH()
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("SELECT username FROM login WHERE username = ':user'");
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