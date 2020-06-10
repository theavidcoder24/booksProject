<?php
/* ====================================== Add a new row to the table ====================================== */
function addBook($authName, $authSur, $nationality, $birthYear, $deathYear, $bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $bookPlot, $bookPlotSrc)
{
    global $conn;
    try {
        $conn->beginTransaction();
        /* --- Author Table --- */
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

        /* --- Book Table --- */
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

        /* --- Book Plot Table --- */
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

        //changeLog('2020-01-01 01:01:01', 1, 3);
        changeLog('2020-01-01 01:01:01', 1, 3);

        // Commit changes here //
        $conn->commit();
    } catch (PDOException $ex) {
        throw $ex;
    }
}


function changeLog($date, $lastBookID, $userID) {
    global $conn;
    /* --- Changelog Table --- */
    // prepares statement with named placeholders
    // INSERT INTO changelog (dateCreated, BookID, userID) VALUES ('2020-01-01 01:01:01', 1, 3)
    $changelog = "INSERT INTO changelog (dateCreated, BookID, userID) VALUES (:datestamp, :BookID, :userid)";
    $stmt = $conn->prepare($changelog);
    $stmt->bindValue(':datestamp', $date, PDO::PARAM_STR);
    $stmt->bindValue(':BookID', $lastBookID, PDO::PARAM_INT); 
    $stmt->bindValue(':userid', $userID, PDO::PARAM_INT);
    $stmt->execute();
}

/* 
mysql> SELECT EXISTS(SELECT * from ExistsRowDemo WHERE ExistId=104);
*/

/* ====================================== Display all rows from the table ====================================== */
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
/* ====================================== Edit record from the table ====================================== */
function editBook($bookTitle, $originalTitle, $yearOfPublication, $genre, $millionsSold, $languageWritten, $coverImage, $BookID, $userID, $changelogid, $dcreated, $date)
{
    global $conn;
    try {
        $conn->beginTransaction();

        /* --- Book Table --- */
        $stmt = $conn->prepare("UPDATE book SET BookTitle=:bkTitle, OriginalTitle=:ogTitle, YearofPublication=:yearOfPub, Genre=:genre, MillionsSold=:millSold, LanguageWritten=:langWritten, coverImagePath=:covImage WHERE BookID=:BookID");

        // bind values
        $stmt->bindValue(':bkTitle', $bookTitle);
        $stmt->bindValue(':ogTitle', $originalTitle);
        $stmt->bindValue(':yearOfPub', $yearOfPublication);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':millSold', $millionsSold);
        $stmt->bindValue(':langWritten', $languageWritten);
        $stmt->bindValue(':covImage', $coverImage);
        $stmt->bindValue(':BookID', $BookID);
        //  $stmt->bindValue(':userid', $lastuserID);
        // Execute the update statement
        $stmt->execute();

        /* --- Changelog Table --- */
        $stmt = $conn->prepare("UPDATE changelog SET changeLogID = :changelogid, dateCreated = :date, userID = :userid, ");
        // Bind values
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':dcreated', $dcreated);
        $stmt->bindValue(':BookID', $BookID);
        $stmt->bindValue(':userid', $userID);
        //$stmt->bindValue('changelogid', $changelogid);
        $stmt->execute();


        // Commit changes here //
        $conn->commit();
    } catch (PDOException $ex) {
        throw $ex;
    }
}

/* ====================================== Delete a row from the table ====================================== */
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

/* =============================================== New User =============================================== */
function newUser($username, $password, $accessrights, $firstname, $lastname, $email)
{
    global $conn;
    try {
        $conn->beginTransaction();

        // last inserted = loginID
        $lastloginID = $conn->lastInsertId();

        /* --- Login Table --- */
        $stmt = $conn->prepare("INSERT INTO login(username, password, accessRights)
        VALUES (:username, :password, :accessrights)");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':accessrights', $accessrights);
        $stmt->execute();

        // last inserted = loginID
        $lastloginID = $conn->lastInsertId();

        /* --- Users Table --- */
        $stmt = $conn->prepare("INSERT INTO users(firstName, lastName, email, loginID)
        VALUES (:firstname, :lastname, :email, :loginID)");
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
