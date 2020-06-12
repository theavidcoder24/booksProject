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
<?php
$BookID = $_GET['BookID'];
$stmt = $conn->prepare("DELETE FROM book WHERE BookID = '$BookID'");
$stmt->execute();
echo "<h2>Record deleted successfully</h2>";
?>
<!-- Welcome user-->
<p>Welcome <b><?php echo $_SESSION['AdminUser'] ?></b><br>You have successfully logged in</p><br>
<!-- Get table data -->

<main>
   <!-- <h2>Delete Book: <?php // echo $result['BookTitle'] ?></h2> -->
</main>
<footer>
    <div class="copyright">
        <p>&copy; Copyright Mallorie Cini <script type="text/javascript">
                document.write("2020 - " + new Date().getFullYear());
            </script>
    </div>
</footer>