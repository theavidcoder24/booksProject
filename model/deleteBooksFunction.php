<?php 
function deleteBook($BookID) {
    global $conn;
    try {
        $stmt = $conn->prepare("DELETE FROM book WHERE BookID=:id");
        $stmt->bindValue('id', $BookID);
        $stmt->execute();
        if( ! $stmt->rowCount() ) echo "Deletion failed";
    }
    catch (PD0Exception $ex){
        throw $ex;
    }
}

?>