<?php
require("connectionDB.php");
$pdo = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
$query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.BookID";

$data = $pdo->query($query);
// fetch data one by one using query() method

foreach ($data as $row) { // d is a pdo query and append data inside $data variable
    // If no image is set display the default 
    if ($row['coverImagePath'] == null) {
        echo '<br><img id="defultImg" src="view/images/defaultImage.png">';
    } else {
        echo '<img src="view/images/' . $row['coverImagePath'] . '">';
    }
    echo '<h4>Author: </h4>' . $row['Name'] . ' ' . $row['Surname'];
    echo '<h4>Book Title: </h4>' . $row['BookTitle'];
    echo '<h4>Year Published: </h4>' . $row['YearofPublication'];
    echo '<h4>Copies Sold: </h4>' . $row['MillionsSold'] . '<br>';
    echo '<br>';

    echo '<a style="background-color:rgb(70, 70, 251)"; href="view/pages/editBooks.php" id="editLink">EDIT</a>';
    echo '<a style="background-color:rgb(245, 44, 44)"; href="view/pages/deleteBooks.php" id="delLink">DELETE</a>';
    echo '<br>';
}
