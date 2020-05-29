<?php 
function deleteBook($BookID) {
    global $conn;
    try {
        $stmt = $conn->prepare("DELETE FROM book WHERE BookID=:id");
        $stmt->bindValue('id', $BookID);
        // Execute the delete statement
        $stmt->execute();
        if( ! $stmt->rowCount() ) echo "Deletion failed";
    }
    catch (PDOException $ex){
        throw $ex;
    }
}
