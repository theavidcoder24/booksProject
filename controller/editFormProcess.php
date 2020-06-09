<?php
//session_start();
require("../model/connectionDB.php");
require("../model/dbFunctions.php");
require("../model/switchFunction.php");
require("filterInput.php");
date_default_timezone_set('Australia/Brisbane');

if (!empty([$_POST])) {
    // Input sanitation 

    // Book Table
    $BookID = inputFilter($_POST['BookID']);
    $bookTitle = inputFilter($_POST['bkTitle']);
    $originalTitle = inputFilter($_POST['ogTitle']);
    $yearOfPublication = inputFilter($_POST['yearOfPub']);
    $genre = inputFilter($_POST['genre']);
    $millionsSold = !inputFilter($_POST['millSold']);
    $languageWritten = inputFilter($_POST['langWritten']);
    $coverImage = inputFilter($_POST['covImage']);

    $action_type = inputFilter(($_POST['actiontype']));


    // Record the account who added this book
    $userID = $_SESSION['userid'];

    // Record the current date and time
    $date = date('Y-m-d H:i:s');

    // Changelog Table

    if ($_REQUEST['actiontype'] == 'edit') {

        try {
            // funtion call
            editBook($bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, /*$date,*/ $BookID/*, $userID, $changelogid*/);
            $_SESSION['message'] = "Edit Successful!!";
            header('location:../homepage.php');
        } catch (PDOException $ex) {
            echo "Problem updating Book " . $ex->getMessage();
            exit();
        }
    }
} else {
    $_SESSION['message'] = "Failed to Edit ";
    $error_message = $e->getMessage();
}
