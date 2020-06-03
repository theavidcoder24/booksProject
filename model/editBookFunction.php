<?php
/* ------------------- Edit record from the table ------------------- */
function editBook($AuthorID, $authName, $authSur, $nationality, $birthYear, $deathYear, $BookID, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage)
{
    global $conn;
    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("UPDATE author SET Name = :name, Surname = :surname, Nationality = :nation, BirthYear = :birthYr, DeathYear = :deathYear WHERE $AuthorID = :aID");
        $stmt->bindValue(':name', $authName);
        $stmt->bindValue(':surname', $authSur);
        $stmt->bindValue(':nation', $nationality);
        $stmt->bindValue(':birthYr', $birthYear);
        $stmt->bindValue(':deathYr', $deathYear);
        $stmt->bindValue('aID', $AuthorID);
        // Execute the update statement
        $stmt->execute([$authName, $authSur, $nationality, $birthYear, $deathYear, $AuthorID]);

        $stmt = "UPDATE book SET BookTitle = :bkTitle, OriginalTitle = :ogTitle, YearofPublication = :yearOfPub, Genre = :genre, MillionsSold = :millSold, LanguageWritten = :langWritten, coverImagePath = :covImage WHERE $BookID = :bID";
        $stmt = $conn->prepare($stmt);
        // bind values
        $stmt->bindValue(':bkTitle', $bookTitle);
        $stmt->bindValue(':ogTitle', $originalTitle);
        $stmt->bindValue(':yearOfPub', $yearOfPublication);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':millSold', $millionsSold);
        $stmt->bindValue(':langWritten', $languageWritten);
        $stmt->bindValue(':covImage', $coverImage);
        $stmt->bindValue(':bID', $BookID);
        // Execute the update statement
        $stmt->execute([$bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $BookID]);

        // Commit changes here //
        $conn->commit();
    } catch (PDOException $ex) {
        throw $ex;
    }
}
