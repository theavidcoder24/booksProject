<?php
require("../model/connectionDB.php");
require("../model/addBookFunction.php");
require("inputSanitation.php");
if (!empty([$_POST])) {
    // input sanitation via testInput function
    // Author Table 
    $authName = inputFilter($_POST['name']);
    $authSur = inputFilter($_POST['surname']);
    $nationality = inputFilter($_POST['nation']);
    $birthYear = inputFilter($_POST['birthYr']);
    $deathYear = inputFilter($_POST['deathYr']);

    // Book Table
    $bookTitle = inputFilter($_POST['bkTitle']);
    $originalTitle = inputFilter($_POST['ogTitle']);
    $yearOfPublication = inputFilter($_POST['yearOfPub']);
    $genre = inputFilter($_POST['genre']);
    $millionsSold = inputFilter($_POST['millSold']);
    $languageWritten = inputFilter($_POST['langWritten']);
    $coverImage = inputFilter($_POST['covImage']);

    // Book Plot Table
    $bookPlot = inputFilter($_POST['bkPlot']);
    $bookPlotSrc = inputFilter($_POST['bkPlotSrc']);
    // funtion call
    addBook($authName, $authSur, $nationality, $birthYear, $deathYear, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc);
    echo "New row inserted";
} else {
    echo "Record couldn't be inserted";
}
