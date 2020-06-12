<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // echo "Connected successfully!!";
} catch (PDOException $e) {
    $error_message = $e->getMessage();
?>
    <h1>Database Connection Error</h1>
    <p>There was an error connecting to the database.</p>
    <!-- display the error message -->
    <p>Error message:<?php echo $error_message; ?></p>
<?php
    exit();
}
?>