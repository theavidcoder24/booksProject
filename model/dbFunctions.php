<?php
/* ------------------- Add a new row to the table ------------------- */
function addBook($authName, $authSur, $nationality, $birthYear, $deathYear, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc, $BookID, $userID)
{
    global $conn;
    try {
        $conn->beginTransaction();
        /* === Author Table === */
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

        /* === Book Table === */
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

        // Last inserted BookID
        $lastBookID = $conn->lastInsertId();

        /* === Book Plot Table === */
        // prepares statement with named placeholders
        $stmt = $conn->prepare("INSERT INTO bookplot(Plot, PlotSource, BookID)
        VALUES (:bkPlot, :bkPlotSrc, :BookID)");
        // bind values
        $stmt->bindValue(':bkPlot', $bookPlot);
        $stmt->bindValue(':bkPlotSrc', $bookPlotSrc);
        $stmt->bindValue(':BookID', $lastBookID);
        // execute the insert statement
        $stmt->execute();

        /* === Changelog Table === */
        // prepares statement with named placeholders
        $changelog = $conn->prepare("INSERT INTO changelog(dateCreated, dateChanged, BookID, userID)
        VALUES (:now(), :now():BookID, :userid)");
        $stmt->bindValue(':BookID', $BookID);
        $stmt->bindValue(':userid', $userID);
        // execute the insert statement
        $stmt->execute($changelog);

        // Commit changes here //
        $conn->commit();
    } catch (PDOException $ex) {
        throw $ex;
    }
}

/* 
mysql> SELECT EXISTS(SELECT * from ExistsRowDemo WHERE ExistId=104);
*/

/* ------------------- Display all rows from the table ------------------- */
function displayBooks()
{
    require("connectionDB.php");
    $pdo = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
    $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.BookID";

    $data = $pdo->query($query);
    // fetch data one by one using query() method

    foreach ($data as $row) { // d is a pdo query and append data inside $data variable
        // If no image is set display the default 
        if ($row['coverImagePath'] == null) {
            echo '<br><img id="defultImg" src="view/images/defaultImage.png">';
        } else {
            echo '<img src="view/images/' . $row['coverImagePath'] . '">';
        }
        echo '<h4>Author: </h4>' . $row['Name'] . ' ' . $row['Surname'];
        echo '<h4>Book Title: </h4>' . $row['BookTitle'];
        echo '<h4>Year Published: </h4>' . $row['YearofPublication'];
        echo '<h4>Copies Sold: </h4>' . $row['MillionsSold'] . '<br>';
        echo '<br>';

        echo '<a style="background-color:rgb(70, 70, 251)"; href="view/pages/editBooks.php" id="editLink">EDIT</a>';
        echo '<a style="background-color:rgb(245, 44, 44)"; href="view/pages/deleteBooks.php" id="delLink">DELETE</a>';
        echo '<br>';
    }
}

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

/* ------------------- Delete a row from the table ------------------- */
function deleteBook($BookID)
{
    global $conn;
    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to delete a record
        $sql = "DELETE FROM book WHERE BookID=:BookID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':BookID', $BookID);
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Record deleted successfully";

        // Commit changes
        $conn->commit();
    } catch (PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
        echo "Failed";
        throw $ex;
    }
}

/* 
//create a function to delete an existing product
function delete_product($productID)
{
    global $conn;
    $sql = "DELETE FROM product WHERE productID = :productID";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':productID', $productID);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;		
}
*/
