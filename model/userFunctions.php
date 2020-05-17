<?php
function newUser($username, $password,$role, $firstname, $lastname, $email)
{
    global $conn;
    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO users(firstName, lastName, email, password)
        VALUES (:firstname, :lastname, :email, :password)");
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        // last inserted = loginID
        $lastCustID = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO login(username, password, customerID)
        VALUES (:username, :password, :role, :cID)");
        $stmt->bindValue(':uname', $username);
        $stmt->bindValue(':upass', $password);
        $stmt->bindValue(':role', $role);
        $stmt->execute();
        $conn->commit(); // save to database
    }
    catch (PDOException $ex) {
        $conn->rollBack(); // something went wrong rollback!
        throw $ex;
    }
}
?>
