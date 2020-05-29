<?php
function editBook($authName, $authSur, $nationality, $birthYear, $deathYear, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc)
{
    global $conn;
    try {
        $sql = "UPDATE author SET Name=?, Surname=?, Nationality=?, BirthYear=?, DeathYear=?";
        $stmt = $conn->prepare($sql);
        // Execute the update statement
        $stmt->execute([$authName, $authSur, $nationality, $birthYear, $deathYear]);

        $sql = "UPDATE book SET BookTitle=?, OriginalTitle=?, YearofPublication=?, Genre=?, MillionsSold=?, LanguageWritten=?, coverImagePath=?";
        $stmt = $conn->prepare($sql);
        // Execute the update statement
        $stmt->execute([$bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage]);

        $sql = "UPDATE bookplot SET BookTitle=?, OriginalTitle=?, YearofPublication=?, Genre=?, MillionsSold=?, LanguageWritten=?, coverImagePath=?";
        $stmt = $conn->prepare($sql);
        // Execute the update statement
        $stmt->execute([$bookPlot, $bookPlotSrc]);
    } catch (PDOException $ex) {
    }
}
