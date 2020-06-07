<?php
/* ------------------- Add a new row to the table ------------------- */
function addBook($authName, $authSur, $nationality, $birthYear, $deathYear, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc, $userID)
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

        // Last inserted BookID & userID
        $lastBookID = $conn->lastInsertId();

        /* === Changelog Table === */
        // prepares statement with named placeholders
        $changelog = ("INSERT INTO changelog(BookID, userID)
        VALUES (:BookID, :userid)");
        $conn->prepare($changelog);
        $stmt->bindValue(':BookID', $lastBookID);
        $stmt->bindValue(':userid', $userID);
        // execute the insert statement
        $stmt->execute();

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
    global $conn;
    try {
        $stmt = $conn->prepare('SELECT * FROM author INNER JOIN book ON author.AuthorID = book.AuthorID');
        $stmt->execute();
        $data = $stmt->fetchAll();
        if ($stmt->rowCount() < 1) {
            echo "Table empty?";
        } else {
            foreach ($data as $row) {
                echo $row['AuthorID'] . '<br>';
                echo $row['Name'] . ' ' . $row['Surname'] . '<br>';
                echo $row['BookTitle'] . '<br>';
                echo $row['YearofPublication'] . '<br>';
                echo $row['MillionsSold'] . '<br>';
            }
        }
    } catch (PDOException $ex) {
        throw $ex;
    }
}
/* ------------------- Edit record from the table ------------------- */
function editBook(/*$AuthorID, $authName, $authSur, $nationality, $birthYear, $deathYear*/$bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $BookID)
{
    global $conn;
    /*
        $stmt = $conn->prepare("UPDATE author SET Name = :name, Surname = :surname, Nationality = :nation, BirthYear = :birthYr, DeathYear = :deathYear WHERE $AuthorID = :aID");
        $stmt->bindValue(':name', $authName);
        $stmt->bindValue(':surname', $authSur);
        $stmt->bindValue(':nation', $nationality);
        $stmt->bindValue(':birthYr', $birthYear);
        $stmt->bindValue(':deathYr', $deathYear);
        $stmt->bindValue('aID', $AuthorID);
        // Execute the update statement
        $stmt->execute([$authName, $authSur, $nationality, $birthYear, $deathYear, $AuthorID]);
        */
    $stmt = $conn->prepare("UPDATE book SET BookTitle=:bkTitle, OriginalTitle=:ogTitle, YearofPublication=:yearOfPub, Genre=:genre, MillionsSold=:millSold, LanguageWritten=:langWritten, coverImagePath=:covImage WHERE BookID=$BookID");

    try {
        // bind values
        $stmt->bindValue(':bkTitle', $bookTitle);
        $stmt->bindValue(':ogTitle', $originalTitle);
        $stmt->bindValue(':yearOfPub', $yearOfPublication);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':millSold', $millionsSold);
        $stmt->bindValue(':langWritten', $languageWritten);
        $stmt->bindValue(':covImage', $coverImage);
        // $stmt->bindValue(':bID', $BookID);
        //  $stmt->bindValue(':userID', $lastuserID);
        // Execute the update statement
        $stmt->execute();

        // Commit changes here //
        // $conn->commit();
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
        // Bind values
        $stmt->bindValue(':bID', $BookID);


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

/* =============================================== New User =============================================== */
function newUser($username, $password, $accessrights, $firstname, $lastname, $email)
{
    global $conn;
    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO login(username, password, accessRights)
        VALUES (:username, :password, :accessrights)");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':accessrights', $accessrights);
        $stmt->execute();

        // last inserted = userID
        $lastuserID = $conn->lastInsertId();

        // last inserted = loginID
        $lastloginID = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO users(firstName, lastName, email, loginID)
        VALUES (:firstname, :lastname, :email, :loginID)");
        $stmt->bindValue(':userID', $lastuserID);
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':loginID', $lastloginID);
        $stmt->execute();

        $conn->commit(); // Save to the database
    } catch (PDOException $ex) {
        $conn->rollBack(); // Something went wrong rollback!
        throw $ex;
    }
    $conn = null;
}