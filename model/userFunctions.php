<?php
function newUser($username, $password, $role, $firstname, $lastname, $email)
{
    global $conn;
    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO users(firstName, lastName, email, loginID, password)
        VALUES (:firstname, :lastname, :email, :password)");
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        // last inserted = loginID
        $lastloginID = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO login(username, password, accessRights, loginID)
        VALUES (:username, :password, :role, :acRights, :logId)");
        $stmt->bindValue(':uname', $username);
        $stmt->bindValue(':upass', $password);
        $stmt->bindValue(':role', $role);
        $stmt->bindValue(':acRights', $accessRights);
        $stmt->bindValue(':logId', $loginID);
        $stmt->execute();
        $conn->commit(); // save to database
    }
    catch (PDOException $ex) {
        $conn->rollBack(); // something went wrong rollback!
        throw $ex;
    }
}
