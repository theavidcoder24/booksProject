<?php
session_start();
require("../model/connectionDB.php");
require("../model/dbFunctions.php");
require("filterInput.php");
date_default_timezone_set('Australia/Brisbane');

if (!empty([$_POST])) {
    // input sanitation via testInput function
    // Author Table 
    $authName = !empty($_POST['name']) ? inputFilter($_POST['name']) : null;
    $authSur = !empty($_POST['surname']) ? inputFilter($_POST['surname']) : null;
    $nationality = !empty($_POST['nation']) ? inputFilter($_POST['nation']) : null;
    $birthYear = !empty($_POST['birthYr']) ? inputFilter($_POST['birthYr']) : null;
    $deathYear = !empty($_POST['deathYr']) ? inputFilter($_POST['deathYr']) : null;

    // Book Table
    $bookTitle = !empty($_POST['bkTitle']) ? inputFilter($_POST['bkTitle']) : null;
    $originalTitle = !empty($_POST['ogTitle']) ? inputFilter($_POST['ogTitle']) : null;
    $yearOfPublication = !empty($_POST['yearOfPub']) ? inputFilter($_POST['yearOfPub']) : null;
    $genre = !empty($_POST['genre']) ? inputFilter($_POST['genre']) : null;
    $millionsSold = !empty($_POST['millSold']) ? inputFilter($_POST['millSold']) : null;
    $languageWritten = !empty($_POST['langWritten']) ? inputFilter($_POST['langWritten']) : null;
    $coverImage = !empty($_POST['covImage']) ? inputFilter($_POST['covImage']) : null;

    // Book Plot Table
    $bookPlot = !empty($_POST['bkPlot']) ? inputFilter($_POST['bkPlot']) : null;
    $bookPlotSrc = !empty($_POST['bkPlotSrc']) ? inputFilter($_POST['bkPlotSrc']) : null;

    $action_type = !empty($_POST['actType']) ? inputFilter($_POST['actType']) : null;

    // Record the account who added this book
    $userID = $_SESSION['userid'];
    echo $userID;

    // Record the current date and time
    $date = date('Y-m-d H:i:s');

    // Changelog Table?

    if ($_REQUEST['action_type'] == 'update') {

        try {
            // funtion call
            editBook($bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc,);
        } catch (PDOException $ex) {
            echo "Problem updating Book " . $ex->getMessage();
            exit();
        }
    }
} else {
    $_SESSION['message'] = "Failed to update";
    $error_message = $e->getMessage();
}
