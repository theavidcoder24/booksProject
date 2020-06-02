<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include '../model/connectionDB.php';
    include '../model/dbFunctions.php'; //WHat?
    $stmt = $conn->prepare('SELECT BookID, BookTitle FROM book ORDER BY BookTitle');
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() < 1) {
        echo "The table is empty";
    } else {
        foreach ($result as $row) {
            echo $row['BookTitle']; ?><br>
            <a href="?link=edit&BookID=<?php echo $row['BookID']; ?>">Edit Book</a><br>
            <a href="?link=delete&BookID=<?php echo $row['BookID']; ?>">Delete Book</a>
    <?php
        }
    }
    ?>
</body>

</html>