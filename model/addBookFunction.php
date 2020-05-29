<?php
// Add a new row to the table
function addBook($authName, $authSur, $nationality, $birthYear, $deathYear, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc)
{
    global $conn;
    try {
        $conn->beginTransaction();
        // Prepares statement with named placeholders
        $stmt = $conn->prepare("INSERT INTO author(Name, Surname, Nationality, BirthYear, DeathYear)
        VALUES (:name, :surname, :nation, :birthYr, :deathYr)");
        // bind values
        $stmt->bindValue(':name', $authName);
        $stmt->bindValue(':surname', $authSur);
        $stmt->bindValue(':nation', $nationality);
        $stmt->bindValue(':birthYr', $birthYear);
        $stmt->bindValue(':deathYr', $deathYear);
        // Execute the insert statement
        $stmt->execute();

        // Last inserted BookID
        $lastAuthorID = $conn->lastInsertId();

        // prepares statement with named placeholders
        $stmt = $conn->prepare("INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, coverImagePath, AuthorID)
        VALUES (:bkTitle, :ogTitle, :yearOfPub, :genre, :millSold, :langWritten, :covImage, :AuthorID)");
        // bind values
        $stmt->bindValue(':bkTitle', $bookTitle);
        $stmt->bindValue(':ogTitle', $originalTitle);
        $stmt->bindValue(':yearOfPub', $yearOfPublication);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':millSold', $millionsSold);
        $stmt->bindValue(':langWritten', $languageWritten);
        $stmt->bindValue(':covImage', $coverImage);
        $stmt->bindValue(':AuthorID', $lastAuthorID);
        // execute the insert statement
        $stmt->execute();

        // prepares statement with named placeholders
        $stmt = $conn->prepare("INSERT INTO bookplot(Plot, PlotSource)
        VALUES (:bkPlot, :bkPlotSrc)");
        // bind values
        $stmt->bindValue(':bkPlot', $bookPlot);
        $stmt->bindValue(':bkPlotSrc', $bookPlotSrc);
        // execute the insert statement
        $stmt->execute();
    } catch (PDOException $ex) {
        throw $ex;
    }
}
