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
            <a href="#">Login</a>
            <a href="view/pages/register.html" alt="Registration Form">Sign Up</a>
        </div>
        <div id="adminTitle">
            <h1>Administration</h1>
        </div>
    </header>
    <fieldset>
        <legend>User Login</legend>
        <form action="controller/loginProcess.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit">Submit</button>
        </form>
    </fieldset>
</body>

</html>