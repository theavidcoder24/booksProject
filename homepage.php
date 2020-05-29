<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/books.css">
    <link rel="icon" href="view/images/books-1673578_1280.png" type="image/gif" sizes="16x16">
    <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
    <title>Display Books</title>
</head>

<body>
    <header>
        <div class="userForm">
            <a href="model/logout.php">Logout</a>
            <!-- Welcome user) -->
        </div>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="#" class="active">Display Books</a></li>
            <li><a href="view/pages/addBookForm.html">Add Book</a></li>
            <li><a href="view/pages/editBooks.html">Edit Books</a></li>
            <li><a href="view/pages/deleteBooks.html">Delete Books</a></li>
        </ul>
    </nav>
    <main>
        <div id="displayDatabase">
            <?php include('model/displayBooks.php'); ?>
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