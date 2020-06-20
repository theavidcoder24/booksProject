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
    $coverImage = inputFilter($_POST['covImage']);

    // Book Plot Table
    $bookPlot = !empty($_POST['bkPlot']) ? inputFilter($_POST['bkPlot']) : null;
    $bookPlotSrc = !empty($_POST['bkPlotSrc']) ? inputFilter($_POST['bkPlotSrc']) : null;


    // Record the account who added this book
    $userID = $_SESSION['userID'];

    // Record the current date and time
    $date = date('Y-m-d H:i:s');

    if ($_POST['action_type'] == 'add') {
        /* */
        $stmt = $conn->prepare("SELECT name, surname, AuthorID FROM author WHERE name = :name AND surname = :surname");
        // bind values
        $stmt->bindValue(':name', $authName);
        $stmt->bindValue(':surname', $authSur);
        $stmt->execute();
        $row = $stmt->fetch();

        // If rows aren't found
        if ($stmt->rowCount() < 1) {

            //   $stmt = $conn->prepare("SELECT userID FROM users WHERE loginID = :userID");

            // funtion call
            addBook($authName, $authSur, $nationality, $birthYear, $deathYear, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc);
           // changeLog($date, $date, $BookID, $userID);
            echo "New Record Inserted";

            // this will be the page the user enters record successfully
            // header('Location: ../homepage.php');
        } else {
            $lkAuthorID = $row['AuthorID'];
            addBookWithoutAuthor($bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc, $lkAuthorID);
            // changeLog($date, $date, $BookID, $userID);
            echo "Book added";
        }
    }
}
