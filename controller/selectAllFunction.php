<?php
function selectAllBook() {
    global $conn;
    try {
        $stmt = $conn->prepare('SELECT * FROM book');
        $stmt->execute();
        $result = $stmt-> fetchAll();
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



?>