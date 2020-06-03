<?php
include('../../controller/loginProcess.php');
include('../../model/connectionDB.php');
include('../../model/dbFunctions.php');
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
            <li><a href="addBookForm.php">Add Book</a></li>
            <li><a href="editBooks.php">Edit Book</a></li>
            <li><a href="deleteBooks.php">Delete Book</a></li>
        </ul>
    </nav>
    <!-- Welcome user-->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
    <main>
        <div class="message">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
        </div>
        <div id="displayDatabase">
            <?php
            $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.AuthorID";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();

            if ($stmt->rowCount() < 1) {
                echo "There are no books!";
            } else {
                foreach ($data as $row) {
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
                                <?php
                                echo $row['BookTitle']; ?><br>
                                <a href="?link=edit&BookID=<?php echo $row['BookID']; ?>"><b>Edit Book</b></a>
                                <a href="?link=delete&BookID=<?php echo $row['BookID']; ?>"><b>Delete Book</b></a>
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