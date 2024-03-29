<?php
$_SESSION['time_start_login'] = time();
require('../../controller/loginProcess.php');
require('../../model/connectionDB.php');
require('../../model/dbFunctions.php');
require('../../model/switchFunction.php');
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
    <script src="../../model/script.js" defer></script>
    <title>Display Books</title>
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
            <h1>Administration - Display Books</h1>
        </div>
    </header>
    <nav>
        <ul>
            <div class="topnav" id="myTopnav">
                <li><a href="../../homepage.php" id="home"><i class="fas fa-home"></i></a></li>
                <li><a href="#">Display Books</a></li>
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
        <div class="displayDatabase">
            <?php
            $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.AuthorID ORDER BY BookTitle";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($stmt->rowCount() < 1) {
                echo "There are no books!";
            } else {
                foreach ($result as $row) {
                    echo '<div class="dataRow">';
                    if ($row['coverImagePath'] == null) {
                        echo '<br><img id="defaultImg" src="../images/defaultImage.png">';
                    } else {
                        echo '<br><img id="defaultImg" src="../images/' . $row['coverImagePath'] . '">';
                    }
            ?>
                    <div class="container">
                        <div class="displaySection">
                            <figure>
                                <figcaption>
                                    <p class="data"><b>Author: </b><?php echo $row['Name'] . ' ' . $row['Surname']; ?></p>
                                    <p class="data"><b>Book Title: </b><?php echo $row['BookTitle']; ?></p>
                                    <p class="data"><b>Year of Publication: </b><?php echo $row['YearofPublication']; ?></p>
                                    <p class="data"><b>Copies Sold: </b><?php echo $row['MillionsSold']; ?></p><br>
                                    <a id="editLink" href="editBook.php?BookID=<?php echo $row["BookID"]; ?>">Edit</a>
                                    <a id="delLink" onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteBook.php?BookID=<?php echo $row["BookID"]; ?>">Delete</a>
                                </figcaption>
                            </figure>
                            <?php
                            echo '</div>'
                            ?>
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