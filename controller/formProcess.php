<?php
require("../model/connectionDB.php");
require("../model/addBooks.php");
require("inputSanitation.php");
if (!empty([$_POST])) {
    // input sanitation via testInput function
    $bookTitle = inputFilter($_POST['bkTitle']);
    $originalTitle = inputFilter($_POST['ogTitle']);
    $yearOfPublication = inputFilter($_POST['yearOfPub']);
    $genre = inputFilter($_POST['genre']);
    $millionsSold = inputFilter($_POST['millSold']);
    $languageWritten = inputFilter($_POST['langWritten']);
    $coverImage = inputFilter($_POST['covimage']);
    // funtion call
    addBook($bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage);
    echo "New row inserted";
} else {
    echo "Record couldn't be inserted";
}
?>