<?php
ob_start();
session_start();

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
        <p>Welcome <br><?php echo $_SESSION['login'] ?></br>You have successfully logged in</p>
        <?php
        echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
        ?>
        <div id="displayDatabase">
            <?php
            include("model/connectionDB.php");
            $pdo = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
            $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.BookID";

            $data = $pdo->query($query);
            // fetch data one by one using query() method

            foreach ($data as $row) {?>
            <div class="container">
                <div class="data">
                    <figure>
                        ig
                    </figure>

                </div>

            </div>
        </div>
    <?php
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