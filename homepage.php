<?php 
include('controller/loginProcess.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/books.css">
    <link rel="icon" href="view/images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Books System</title>
</head>

<body>
    <header>
        <div class="userForm">
            <a href="view/pages/register.html">Create New User</a>
            <a href="model/logout.php">Logout</a>
        </div>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="#" class="active">Display Books</a></li>
            <li><a href="view/pages/addBookForm.html">Add Book</a></li>
            <li><a href="view/pages/editBooks.php">Edit Book</a></li>
            <li><a href="view/pages/deleteBooks.php">Delete Book</a></li>
        </ul>
    </nav>
    <main>
        <!-- Welcome user) -->
        <p>Welcome <br><?php echo $_SESSION['AdminUser'] ?></br>You have successfully logged in</p>

        <div id="displayDatabase">
            <?php
            include("model/connectionDB.php");
            $pdo = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
            $query = "SELECT * FROM book INNER JOIN author ON book.BookID = author.AuthorID";

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();

            if ($stmt->rowCount() < 1) {
                echo "There are no books!";
            } else {
                foreach ($data as $row) {
                    if ($row['coverImagePath'] == null) {
                        echo '<br><img id="defultImg" src="view/images/defaultImage.png">';
                    } else {
                        echo '<img src="view/images/' . $row['coverImagePath'] . '">';
                    }
            ?>
                    <div class="container">
                        <div class="dataSection">
                            <figure>
                                <img src="<?php echo $row['coverImagePath']; ?>">
                            </figure>
                            <figcaption>
                                <p class="data">Author: <?php echo $row['Name'] . ' ' . $row['Surname']; ?></p>
                                <p class="data">Book Title: <?php echo $row['BookTitle']; ?></p>
                                <p class="data">Year of Publication: <?php echo $row['YearofPublication']; ?></p>
                                <p class="data">Copies Sold: <?php echo $row['MillionsSold']; ?></p>

                            </figcaption>

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