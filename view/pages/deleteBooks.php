<?php
include('../../controller/loginProcess.php');
include('../../model/connectionDB.php');
?>
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
            <h1>Administration - Delete Book</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../../homepage.php">Display Books</a></li>
            <li><a href="addBookForm.php">Add Book</a></li>
            <li><a href="editBooks.php">Edit Book</a></li>
            <li><a href="#" class="active">Delete Book</a></li>
        </ul>
    </nav>
    <!-- Welcome user-->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
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