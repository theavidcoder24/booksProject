<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/books.css">
    <link rel="icon" href="../images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <title>Delete Books</title>
</head>

<body>
    <header>
        <div class="userForm">
            <a href="../../model/logout.php">Logout</a>
        </div>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../../homepage.php">Display Books</a></li>
            <li><a href="addBookForm.html">Add Book</a></li>
            <li><a href="editBooks.php">Edit Books</a></li>
            <li><a href="#">Delete Books</a></li>
        </ul>
    </nav>
    <main>
        <form action="../../model/deleteBooksFunction.php" method="POST">

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