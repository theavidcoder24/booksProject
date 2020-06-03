<?php
include('controller/loginProcess.php');
include('model/connectionDB.php');
include('model/dbFunctions.php');
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
            <li><a href="#" id="home" class="active"><i class="fas fa-home"></i></a></li>
            <li><a href="view/pages/displayBooks.php">Display Books</a></li>
            <li><a href="view/pages/addBookForm.php">Add Book</a></li>
            <li><a href="view/pages/editBooks.php">Edit Book</a></li>
            <li><a href="view/pages/deleteBooks.php">Delete Book</a></li>
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
        <?php
        /*
        if (isset($_GET['link'])) {
            $link = $_GET['link'];
            switch ($link) {
                /*
                case "allBooks":
                    require("model/displayBooks.php");
                    break;
                case "newBook":
                    require_once("addBookFunction.php");
                    break;
                case "edit":
                    require_once("editBookFunction.php");
                    break;
                case "delete":
                    require("deleteBooksFunction.php");
                    break;
            }
        } else {
            require("../model/displayBooks.php");
        }
        */
        ?>
        <!-- Display Data -->
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
                                <p class="data"><b>Book ID: </b><?php echo $row['BookID'] ?></p>
                                <p class="data"><b>Author ID: </b><?php echo $row['AuthorID'] ?></p>
                                <p class="data"><b>Author: </b><?php echo $row['Name'] . ' ' . $row['Surname']; ?></p>
                                <p class="data"><b>Book Title: </b><?php echo $row['BookTitle']; ?></p>
                                <p class="data"><b>Year of Publication: </b><?php echo $row['YearofPublication']; ?></p>
                                <p class="data"><b>Genre: </b><?php echo $row['Genre']; ?></p>
                                <p class="data"><b>Copies Sold: </b><?php echo $row['MillionsSold']; ?></p>
                                <p class="data"><b>Language Written: </b><?php echo $row['LanguageWritten']; ?></p><br>
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