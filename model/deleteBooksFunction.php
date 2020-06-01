<?php
/*
require("connectionDB.php");
$pdo = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
function deleteBook()
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
  } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }

  $conn = null;
}
*/
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