<?php
require("../model/connectionDB.php");
require("../model/implodeFunction.php");
require("filterInput.php");
if (!empty([$_POST])) {
    // passing form data to an array
    $data = [testInput($_POST['fname']), testInput($_POST['lname']), testInput($_POST['email'])];
    $table = "users";
    print_r($data); // displays array
    $uname = ($data);
    $uname = $data[0];
    $query = $conn->prepare("SELECT username FROM users WHERE username = $uname");
    $query->execute();
    if ($query->rowCount() < 1 ) { # If rows are not found
        insert($table, $data); // Fuction call
        echo "User account has been created";
    }
    else {
        echo "User already exists";
    }
}
?>