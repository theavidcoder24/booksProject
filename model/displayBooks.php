<?php
require("model/connectionDB.php");
$pdo = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
$query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.BookID";

$d = $pdo->query($query);
// fetch data one by one using query() method

foreach ($d as $data) { // here d is a pdo query and append data inside $data variable
    echo '<h4>Author: </h4>' . $data['Name'] . $data['Surname'];
    echo '<h4>Book Title: </h4>' . $data['BookTitle'];
    echo '<h4>Original Title: </h4>' . $data['OriginalTitle'];
    echo '<h4>Year Published: </h4>' . $data['YearofPublication'];
    echo '<h4>Genre: </h4>' . $data['Genre'];
    echo '<h4>Copies Sold: </h4>' . $data['MillionsSold'];
    echo '<h4>Language: </h4>' . $data['LanguageWritten'];

    if ($data['coverImagePath'] == null) {
        echo '<br><img id="defultImg" src="view/images/defaultImage.png">';
    } else {
        echo '<img src="view/images/' . $data['coverImagePath'] . '">';
    }
}
