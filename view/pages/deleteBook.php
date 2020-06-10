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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Books Style -->
    <link rel="stylesheet" href="../css/books.css">
    <!-- Font Awesome Style -->
    <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
    <link rel="icon" href="../images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Delete Books</title>
</head>

<body>
    <?php
    $BookID = $_GET['BookID'];
    $stmt = $conn->prepare("DELETE FROM book WHERE BookID = '$BookID'");
    $stmt->execute();
    echo "Book Deleted";
    ?>
    <header>
        <div class="userForm">
            <a href="../../model/logout.php">Logout</a>
        </div>
        <div id="adminTitle">
            <h1>Administration - Delete Book</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../../homepage.php" id="home"><i class="fas fa-home"></i></a></li>
            <li><a href="displayBooks.php">Display Books</a></li>
            <li><a href="addBook.php">Add Book</a></li>
            <li><a href="editBook.php">Edit Book</a></li>
            <li><a href="#" class="active">Delete Book</a></li>
        </ul>
    </nav>
    <!-- Welcome user-->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
    <!-- Get table data -->

    <main>
        <h2>Delete Book: <?php echo $data['BookTitle'] ?></h2>
    </main>
    <footer>
        <div class="copyright">
            <p>&copy; Copyright Mallorie Cini <script type="text/javascript">
                    document.write("2020 - " + new Date().getFullYear());
                </script>
        </div>
    </footer>
</body>

</html>