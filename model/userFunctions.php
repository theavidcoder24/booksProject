<?php
function newUser($username, $password, $accessrights, $firstname, $lastname, $email)
{
    global $conn;
    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO users(firstName, lastName, email)
        VALUES (:firstname, :lastname, :email)");
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        // last inserted = loginID
        $lastloginID = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO login(username, password, accessRights, loginID)
        VALUES (:username, :password, :acRights, :logId)");
        $stmt->bindValue(':uname', $username);
        $stmt->bindValue(':upass', $password);
        $stmt->bindValue(':acRights', $accessrights);
        $stmt->bindValue(':logId', $lastloginID);
        $stmt->execute();
        $conn->commit(); // Save to the database
    } catch (PDOException $ex) {
        $conn->rollBack(); // Something went wrong rollback!
        throw $ex;
    }
}
