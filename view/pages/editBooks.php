<?php
include('../../controller/loginProcess.php');
include('../../model/connectionDB.php');
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
            <li><a href="../../homepage.php" id="home"><i class="fas fa-home"></i></a></li>
            <li><a href="displayBooks.php">Display Books</a></li>
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
        <?php
        $query = 'SELECT * FROM author INNER JOIN book ON author.AuthorID = book.AuthorID';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="editForm">
            <h2>Edit Book: </h2>
            <form action="../../controller/editFormProcess.php" method="POST">
                <!--
                    <fieldset class="bookFieldset">
                        <legend>Edit Author Details: </legend>
                        <input type="hidden" name="AuthorID" value=""><br>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"><br>
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" id="surname"><br>
                        // Rest of form goes where? 
                        <label for="nation">Nationality</label>
                        <input type="text" name="nation" id="nation">
                        <label for="birthYr">Birth Year</label>
                        <input type="number" name="birthYr" id="birthYr">
                        <label for="deathYr">Death Year</label>
                        <input type="number" name="deathYr" id="deathYr">
                    </fieldset>
        -->
                <fieldset class="bookFieldset">
                    <legend>Edit Book Details</legend>
                    <!-- Book ID + Hidden Input -->
                    <input type="hidden" id="bID" name="BookID" value="<?php echo $data["BookID"]; ?>"><br>
                    <label for="BookID">BookID:</label>
                    <input type="number" name="BookID" value="<?php if (isset($_POST['BookID'])) echo $_POST['BookID']; ?>" />
                    <label for="bkTitle">Book Title</label>
                    <input type="text" name="bkTitle" value="<?php if (isset($_POST['bkTitle'])) echo $_POST['bkTitle']; ?>" /><br>
                    <label for="ogTitle">Original Title</label>
                    <input type="text" name="ogTitle"><br>
                    <label for="yearOfPub">Year of Publication</label>
                    <input type="text" name="yearOfPub"><br>
                    <label for="genre">Genre</label>
                    <input type="text" name="genre"><br>
                    <label for="millSold">Millions Sold</label>
                    <input type="text" name="millSold"><br>
                    <label for="langWritten">Language Written</label>
                    <input type="text" name="langWritten"><br>
                    <label for="covImage">Cover Image</label>
                    <input type="text" name="covImage"><br>
                </fieldset>
                <input type="hidden" name="action_type" value="update">
                <input type="submit" value="Save">
                <input type="button" onclick="location.href='?linkhomepage';" value="Cancel">
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