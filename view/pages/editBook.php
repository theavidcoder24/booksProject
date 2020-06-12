<?php
session_start();
//require('../../controller/loginProcess.php');
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
    <title>Edit Book</title>
</head>

<body>
    <header>
        <div class="userForm">
            <?php
            if (isset($_SESSION['accessrights'])) {
                if ($_SESSION['accessrights'] == 'Admin') {
                    echo '<a href="register.html">Create New User</a>';
                }
            }
            ?>
            <a href="../../model/logout.php">Logout</a>
        </div>
        <div id="adminTitle">
            <h1>Administration - Edit Book</h1>
        </div>
    </header>
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
    <!-- Welcome user-->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
    <main>
        <!-- Get table data -->
        <?php
        $BookID = $_GET['BookID'];
        $sql = "SELECT * FROM book WHERE BookID = '$BookID'"; //{$_GET[$BookID]}
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="editForm">
            <h2>Edit Book: <?php echo $result['BookTitle']
                            ?></h2>
            <form action="../../controller/editFormProcess.php" method="POST">
                <fieldset class="bookFieldset">
                    <legend>Book Details</legend>
                    <!-- Book ID + Hidden Input -->
                    <label for="BookID">Book ID: <?php echo $result['BookID']; ?></label><br>
                    <input type="hidden" name="BookID" value="<?php echo $result['BookID']; ?>"><br>

                    <label for="bkTitle">Book Title</label>
                    <input type="text" name="bkTitle" value="<?php echo $result['BookTitle']; ?>" /><br>

                    <label for="ogTitle">Original Title</label>
                    <input type="text" name="ogTitle" value="<?php echo $result['OriginalTitle']; ?>"><br>

                    <label for="yearOfPub">Year of Publication</label>
                    <input type="text" name="yearOfPub" value="<?php echo $result['YearofPublication']; ?>"><br>

                    <label for="genre">Genre</label>
                    <input type="text" name="genre" value="<?php echo $result['Genre']; ?>"><br>

                    <label for="millSold">Millions Sold</label>
                    <input type="text" name="millSold" value="<?php echo $result['MillionsSold']; ?>"><br>

                    <label for="langWritten">Language Written</label>
                    <input type="text" name="langWritten" value="<?php echo $result['LanguageWritten']; ?>"><br>

                    <label for="covImage">Cover Image</label>
                    <input type="text" name="covImage" value="<?php echo $result['coverImagePath']; ?>"><br>
                </fieldset>
                <input type="hidden" name="action_type" value="edit">
                <input type="submit" value="Submit">
                <input type="button" onclick="location.href='?link=displayBooks';" value="Cancel" />
            </form>
        </div>
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