<?php
/* ------------------- New User ------------------- */
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
