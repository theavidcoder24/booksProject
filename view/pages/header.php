<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <li><a href="?link=homepage.php">Display Books</a></li>
            <li><a href="?link=addBookForm.html">Add Book</a></li>
            <li><a href="?link=editBooks.php">Edit Book</a></li>
            <li><a href="?link=deleteBooks.php">Delete Book</a></li>
        </ul>
    </nav>
    <!-- Welcome user) -->
    <p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
</body>

</html>