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
    <title>Add Books</title>
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
            <h1>Administration - Add Book</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../../homepage.php" id="home"><i class="fas fa-home"></i></a></li>
            <li><a href="displayBooks.php">Display Books</a></li>
            <li><a href="#" class="active">Add Book</a></li>
            <li><a href="editBook.php">Edit Book</a></li>
            <li><a href="deleteBook.php">Delete Book</a></li>
        </ul>
    </nav>
    <!-- Welcome user-->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
    <main>
        <div class="containerWrapper">
            <div class="formBody">
                <h2>Add Book:</h2>
                <form action="../../controller/addFormProcess.php" method="POST">
                    <fieldset class="bookFieldset">
                        <!-- Author Table -->
                        <legend>Author Details</legend>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" maxlength="20" required><br>
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" id="surname" required><br>
                        <label for="nation">Nationality</label>
                        <input type="text" name="nation" id="nation" required><br>
                        <label for="birthYr">Birth Year</label>
                        <input type="text" name="birthYr" id="birthYr" required><br>
                        <label for="deathYr">Death Year</label>
                        <input type="text" name="deathYr" id="deathYr" required><br>
                    </fieldset>

                    <!-- Book Table -->
                    <fieldset class="bookFieldset">
                        <legend>Book Details</legend>
                        <label for="bkTitle">Book Title</label>
                        <input type="text" name="bkTitle" required><br>
                        <label for="ogTitle">Original Title</label>
                        <input type="text" name="ogTitle"><br>
                        <label for="yearOfPub">Year of Publication</label>
                        <input type="text" name="yearOfPub" required><br>
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" required><br>
                        <label for="millSold">Millions Sold</label>
                        <input type="text" name="millSold" required><br>
                        <label for="langWritten">Language Written</label>
                        <input type="text" name="langWritten"><br>
                        <label for="covImage">Cover Image</label>
                        <input type="text" name="covImage"><br>
                    </fieldset>

                    <!-- Bookplot Table -->
                    <fieldset class="bookFieldset">
                        <legend>Book Plot</legend>
                        <label for="bkPlot">Plot</label><br>
                        <textarea name="bkPlot" id="bkPlot" cols="30" rows="10" required></textarea><br>
                        <label for="bkPlotSrc">Plot Source</label>
                        <input type="text" name="bkPlotSrc" id="bkPlotSrc" required>
                    </fieldset>
                    <input type="hidden" name="action_type" value="add">
                    <input type="submit" value="Submit"><br>
                    <input type="button" onclick="location.href='?link=displayBooks';" value="Cancel" />
                </form>
            </div>
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