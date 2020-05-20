<?php
// Add a new row to the table
function addBook($bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage)
{
    global $conn;
    try {
        // prepares statement with named placeholders
        $stmt = $conn->prepare("INSERT INTO book(BookTitle, OriginalTitle, YearOfPublication, Genre, MillionsSold, LanguageWritten, coverImagePath)
        VALUES (:bkTitle, :ogTitle, :yearOfPub, :genre, :millSold, :langWritten, :covimage)");
        // bind values
        $stmt->bindValue(':bkTitle', $bookTitle);
        $stmt->bindValue(':ogTitle', $originalTitle);
        $stmt->bindValue(':yearOfPub', $yearOfPublication);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':millSold', $millionsSold);
        $stmt->bindValue(':langWritten', $languageWritten);
        $stmt->bindValue(':covimage', $coverImage);

        // execute insert statement
        $stmt->execute();
    } catch (PDOException $ex) {
        throw $ex;
    }
}
?>
