<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/books.css">
    <link rel="icon" href="../images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Edit Book</title>
</head>

<body>
    <header>
        <div class="userForm">
            <a href="../../model/logout.php">Logout</a>
        </div>
        <div id="adminTitle">
            <h1>Administration - Edit Book</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../../homepage.php">Display Books</a></li>
            <li><a href="addBookForm.html">Add Book</a></li>
            <li><a href="#" class="active">Edit Book</a></li>
            <li><a href="deleteBooks.php">Delete Book</a></li>
        </ul>
    </nav>
    <main>
        <?php
        $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.BookID";
        ?>
        <form action="./booksProject/controller/bookFormProcess.php" method="POST">
            <fieldset class="bookFieldset">
                <legend>Edit Author Details</legend>
                <input type="hidden" name="AuthorID" id="aID" value="<?php echo $AuthorID["AuthorID"]; ?>"><br>
                <label for="name">Name</label>
                <input type="text" name="name" id="name"><br>
                <label for="surname">Surname</label>
                <input type="text" name="surname" id="surname"><br>
                <label for="nation">Nationality</label>
                <input type="text" name="nation" id="nation"><br>
                <label for="birthYr">Birth Year</label>
                <input type="number" name="birthYr" id="birthYr"><br>
                <label for="deathYr">Death Year</label>
                <input type="number" name="deathYr" id="deathYr"><br>
            </fieldset>

            <fieldset class="bookFieldset">
                <legend>Edit Book Details</legend>
                <input type="hidden" name="BookID" id="bID" value="<?php echo $BookID["BookID"]; ?>"><br>
                <label for="bkTitle">Book Title</label>
                <input type="text" name="bkTitle"><br>
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
                <!-- https://m.media-amazon.com/images/I/415Vok2xosL._SY346_.jpg -->
            </fieldset>
            <input type="submit" value="Update Book">
        </form>
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