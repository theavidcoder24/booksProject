<?php
session_start();
require("../model/switchFunction.php");
require("../model/connectionDB.php");
require("../model/dbFunctions.php");
require("filterInput.php");
date_default_timezone_set('Australia/Brisbane');

if (!empty([$_POST])) {
    // Input sanitation 

    // Book Table
    /*  $BookID = /*!empty($_POST['BookID']) ?*/ //inputFilter($_POST['BookID']) /* : null*/;
    $bookTitle = inputFilter($_POST['bkTitle']);
    $originalTitle = inputFilter($_POST['ogTitle']);
    $yearOfPublication = inputFilter($_POST['yearOfPub']);
    $genre = inputFilter($_POST['genre']);
    $millionsSold = inputFilter($_POST['millSold']);
    $languageWritten = inputFilter($_POST['langWritten']);
    $coverImage = inputFilter($_POST['covImage']);
    $BookID = inputFilter($_POST['BookID']);

    // Hidden action
    // $action_type = !empty($_POST['action_type']) ? inputFilter($_POST['action_type']) : null;


    // Record the account who added this book
     $userID = $_SESSION['userID'];

    // Record the current date and time
    $date = date('Y-m-d H:i:s');


    if ($_POST['action_type'] == 'edit') {
        try {
            // funtion call
            editBook($bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $BookID);
            changeLog($date, $date, $BookID, $userID);
            echo "Edit Successful!!";
            // header('location:../homepage.php');
        } catch (PDOException $ex) {
            echo "Problem updating Book " . $ex->getMessage();
            exit();
        }
    }
} else {
    $_SESSION['message'] = "Failed to Edit ";
    $error_message = $e->getMessage();
}
