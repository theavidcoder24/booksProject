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
            <li><a href="../../homepage.php" id="home"><i class="fas fa-home"></i></a></li>
            <li><a href="#">Display Books</a></li>
            <li><a href="addBook.php">Add Book</a></li>
            <li><a href="editBook.php">Edit Book</a></li>
            <li><a href="deleteBook.php">Delete Book</a></li>
        </ul>
    </nav>
    <!-- Welcome user-->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
    <main>
        <div id="displayDatabase">
            <?php
            $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.AuthorID ORDER BY BookTitle";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($stmt->rowCount() < 1) {
                echo "There are no books!";
            } else {
                foreach ($result as $row) {
                    if ($row['coverImagePath'] == null) {
                        echo '<br><img id="defultImg" src="../images/defaultImage.png">';
                    } else {
                        echo '<img src="../images/' . $row['coverImagePath'] . '">';
                    }
            ?>
                    <div class="container">
                        <div class="dataSection">
                            <figure>
                                <img src="<?php echo $row['coverImagePath']; ?>">
                            </figure>
                            <figcaption>
                                <p class="data"><b>Author: </b><?php echo $row['Name'] . ' ' . $row['Surname']; ?></p>
                                <p class="data"><b>Book Title: </b><?php echo $row['BookTitle']; ?></p>
                                <p class="data"><b>Year of Publication: </b><?php echo $row['YearofPublication']; ?></p>
                                <p class="data"><b>Copies Sold: </b><?php echo $row['MillionsSold']; ?></p><br>
                                <a href="?link=edit&BookID=<?php echo $row['BookID']; ?>">
                                    <button type="button">Edit</button>
                                </a>
                                <a href="?link=delete&BookID=<?php echo $row['BookID']; ?>">
                                    <button type="button">Delete</button>
                                </a>
                            </figcaption>
                        </div>
                    </div>
        </div>
<?php
                }
            }
?>
    </main>
</body>

</html>