<?php
function insert($table,$data) { //form input passed as an array
    global $conn;
    try {
        // Imploding the array
        $newdata = "'" . implode("','", $data) . "'";
        $stmt = $conn->prepare("INSERT INTO $table(username, password, accessRights)
        VALUES ($newdata)");
        $stmt->execute();
    }
    catch (PDOException $ex) {
        throw $ex;
    }
}
?>
