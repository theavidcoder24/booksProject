<?php
function editBook($authName, $authSur, $nationality, $birthYear, $deathYear, $AuthorID, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $BookID, $bookPlot, $bookPlotSrc)
{
    global $conn;
    try {
        $sql = "UPDATE author SET Name=?, Surname=?, Nationality=?, BirthYear=?, DeathYear=? WHERE $AuthorID=?";
        $stmt = $conn->prepare($sql);
        // Execute the update statement
        $stmt->execute([$authName, $authSur, $nationality, $birthYear, $deathYear, $AuthorID]);

        $sql = "UPDATE book SET BookTitle=?, OriginalTitle=?, YearofPublication=?, Genre=?, MillionsSold=?, LanguageWritten=?, coverImagePath=? WHERE $BookID=?";
        $stmt = $conn->prepare($sql);
        // Execute the update statement
        $stmt->execute([$bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage]);

        $sql = "UPDATE bookplot SET BookTitle=?, OriginalTitle=?, YearofPublication=?, Genre=?, MillionsSold=?, LanguageWritten=?, coverImagePath=? WHERE $BookID=?";
        $stmt = $conn->prepare($sql);
        // Execute the update statement
        $stmt->execute([$bookPlot, $bookPlotSrc, $BookID]);
    } catch (PDOException $ex) {
    }
}
