<?php
$_SESSION['time_start_login'] = time();
session_start();
//require('../../controller/loginProcess.php');
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
    <title>Changelog History</title>
</head>
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
        <div class="topnav" id="myTopnav">
            <li><a href="../../homepage.php" id="home"><i class="fas fa-home"></i></a></li>
            <li><a href="displayBooks.php">Display Books</a></li>
            <li><a href="addBook.php">Add Book</a></li>
            <li><a href="editBook.php">Edit Book</a></li>
            <li><a href="deleteBook.php">Delete Book</a></li>
            <li><a href="#">Changelog History</a></li>
        </div>
    </ul>
</nav>
<!-- Welcome user-->
<p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>

<body>
    <main>
        <div id="displayDatabase">
            <!-- Get Changelog Table data -->
            <?php
            //$BookID = $_GET['BookID'];
            $query = "SELECT * FROM changelog";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($stmt->rowCount() < 1) {
                echo "There are no books!";
            }
            ?>
            <div class="dataSection">
                <table id="logHistory">
                    <tr>
                        <th>Book Created Date: </th>
                        <th>Book Changed Date: </th>
                        <th>Book ID: </th>
                        <th>User ID: </th>
                    </tr>
                    <?php
                    foreach ($result as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['dateCreated']; ?></td>
                            <td><?php echo $data['dateChanged']; ?></td>
                            <td><?php echo $data['BookID']; ?></td>
                            <td><?php echo $_SESSION['userID']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>

</body>

</html>