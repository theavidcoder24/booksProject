<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/books.css">
    <title>Login</title>
</head>

<body>
    <header>
        <div class="userForm">
            <a href="view/pages/register.html" alt="Registration Form">Register</a>
        </div>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <fieldset>
        <legend>User Login</legend>
        <form action="controller/loginProcess.php" method="POST">
            <label for="uname">Username</label>
            <input type="text" name="uname" id="uname">
            <label for="upass">Password</label>
            <input type="text" name="upass" id="upass">
            <input type="submit" value="Login">
        </form>
    </fieldset>
</body>

</html>