<?php
require("connectionDB.php");
function selectAllBook() {
    global $conn;
    try {
        $stmt = $conn->prepare('SELECT * FROM author');
        $stmt->execute();
        $stmt = $conn->prepare('SELECT * FROM book');
        $stmt->execute();
        $stmt = $conn->prepare('SELECT * FROM bookplot');
        $stmt->execute();
        $result = $stmt-> fetchAll();
        foreach ($result AS $row)
        echo
        $numRows = $stmt ->rowCount();
        echo "Total number of rows is: ".$numRows. "<br>";
        if ($numRows < 1) {
            echo "Table is basically empty";
        }
        else {
            foreach ($result as $row) {
                echo $row['BookTitle']." - ".$row['YearOfPublication']. "<br>";
            }
        }
    }
    catch (PDOException $ex) {
        throw $ex;
    }
}
