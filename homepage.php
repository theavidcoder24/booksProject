<?php
session_start();
include('model/connectionDB.php');
include('model/dbFunctions.php');
if (!isset($_SESSION['AdminUser'])) {
    echo "<script type='text/javascript'> alert('You must be a logged in member to access the page.'); </script>";
    echo '<h2><a style=text-decoration:none; href="index.php">Login</a></h2>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Books Style -->
    <link rel="stylesheet" href="view/css/books.css">
    <!-- Font Awesome Style -->
    <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
    <link rel="icon" href="view/images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Books System</title>
</head>

<body>
    <header>
        <div class="userForm">
            <?php
            if (isset($_SESSION['accessrights'])) {
                if ($_SESSION['accessrights'] == 'Admin') {
                    echo '<a href="view/pages/register.html">Create New User</a>';
                }
            }
            ?>
            <a href="model/logout.php">Logout</a>
        </div>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <nav>
        <ul>
            <div class="topnav" id="myTopnav">
                <li><a href="#" id="home" class="active"><i class="fas fa-home"></i></a></li>
                <li><a href="view/pages/displayBooks.php">Display Books</a></li>
                <li><a href="view/pages/addBook.php">Add Book</a></li>
                <li><a href="view/pages/editBook.php">Edit Book</a></li>
                <li><a href="view/pages/deleteBook.php">Delete Book</a></li>
                <li><a href="view/pages/changelogHistory.php">Changelog History</a></li>
            </div>
        </ul>
    </nav>
    <!-- Welcome user-->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
    <main>
        <!-- Get link -->
        <?php
        if (isset($_GET['link'])) {
            $link = $_GET['link'];
            switch ($link) {
                case "displayBooks":
                    require("view/pages/displayBooks.php");
                    break;

                case "addBook":
                    require("view/pages/addBook.php");
                    break;

                case "edit":
                    require("view/pages/editBook.php");
                    break;

                case "delete":
                    require("view/pages/deleteBook.php");
                    break;
            }
        }
        ?>
        <!-- Display Data -->
        <div class="displayDatabase">
            <?php
            $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.AuthorID";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($stmt->rowCount() < 1) {
                echo "There are no books!";
            } else {
                foreach ($result as $row) {
            ?>
                    <div class="container">
                        <div class="dataSection">
                            <article>
                                <p class="input"><b>Book ID: </b><?php echo $row['BookID'] ?></p>
                                <p class="input"><b>Author ID: </b><?php echo $row['AuthorID'] ?></p>
                                <p class="input"><b>Author: </b><?php echo $row['Name'] . ' ' . $row['Surname']; ?></p>
                                <p class="input"><b>Book Title: </b><?php echo $row['BookTitle']; ?></p>
                                <p class="input"><b>Year of Publication: </b><?php echo $row['YearofPublication']; ?></p>
                                <p class="input"><b>Genre: </b><?php echo $row['Genre']; ?></p>
                                <p class="input"><b>Copies Sold: </b><?php echo $row['MillionsSold']; ?></p>
                                <p class="input"><b>Language Written: </b><?php echo $row['LanguageWritten']; ?></p><br>
                            </article>
                        </div>
                    </div>
        </div>
<?php
                }
            }
?>
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