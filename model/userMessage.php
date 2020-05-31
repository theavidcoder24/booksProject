<?php
require("connectionDB.php");
require("../controller/loginProcess.php");
require("userFunctions.php");
function user_message()
{
    //if there is one matching record
    if ($count == 1) {
        //start the user session to allow authorised access to secured web pages
        $_SESSION['user'] = $user;
        //if login is successful, create a success message to display on the products page
        $_SESSION['success'] = 'Hello ' . $username . '. Have a great day!';
        //redirect to products.php
        header('location:../view/products.php');
    } else {
        //if login not successful, create an error message to display on the login page
        $_SESSION['error'] = 'Incorrect username or password. Please try again.';
        //redirect to login.php
        header('location:../view/login_form.php');
    }
}
