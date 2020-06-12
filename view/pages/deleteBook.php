<?php
require('../../controller/loginProcess.php');
require('../../model/connectionDB.php');
require('../../model/dbFunctions.php');
if (!isset($_SESSION['AdminUser'])) {
    echo "<script type='text/javascript'> alert('You must be a logged in member to access the page.'); </script>";
    echo '<h2><a style=text-decoration:none; href="../../index.php">Login</a></h2>';
    exit();
}
?>
<?php
$BookID = $_GET['BookID'];
$stmt = $conn->prepare("DELETE FROM book WHERE BookID = '$BookID'");
$stmt->execute();
echo "<h2>Record deleted successfully</h2>";
header('Location:displayBooks.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Books Style -->
    <link rel="stylesheet" href="../css/books.css">
    <!-- Font Awesome Style -->
    <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
    <link rel="icon" href="../images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Edit Book</title>
</head>
<div id="adminTitle">
    <h1>Administration - Delete Book</h1>
</div>
<!-- Welcome user-->
<p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
<nav>
    <ul>
        <div class="topnav" id="myTopnav">
            <li><a href="../../homepage.php" id="home"><i class="fas fa-home"></i></a></li>
            <li><a href="displayBooks.php">Display Books</a></li>
            <li><a href="addBook.php">Add Book</a></li>
            <li><a href="editBook.php">Edit Book</a></li>
            <li><a href="deleteBook.php">Delete Book</a></li>
            <li><a href="changelogHistory.php">Changelog History</a></li>
        </div>
    </ul>
</nav>