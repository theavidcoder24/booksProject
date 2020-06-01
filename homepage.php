   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="view/css/books.css">
       <link rel="icon" href="view/images/books-1673578_1280.png" type="image/gif" sizes="16x16">
       <title>Display Books</title>
   </head>

   <body>
       <header>
           <div class="userForm">
               <a href="model/logout.php">Logout</a>
               <!-- Welcome user) -->
               <?php
               
                ?>
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
               <li><a href="view/pages/deleteBooks.php">Delete Books</a></li>
           </ul>
       </nav>
       <main>
           <div id="displayDatabase">
               <?php
                require("model/connectionDB.php");
                $pdo = new PDO("mysql:host=$servername;dbname=dbbooksproject", $dbusername, $dbpassword);
                $query = "SELECT * FROM author INNER JOIN book ON author.AuthorID = book.BookID";

                $d = $pdo->query($query);
                // fetch data one by one using query() method

                foreach ($d as $data) { // here d is a pdo query and append data inside $data variable
                    echo '<h4>Author: </h4>' . $data['Name'] . $data['Surname'];
                    echo '<h4>Book Title: </h4>' . $data['BookTitle'];
                    echo '<h4>Original Title: </h4>' . $data['OriginalTitle'];
                    echo '<h4>Year Published: </h4>' . $data['YearofPublication'];
                    echo '<h4>Genre: </h4>' . $data['Genre'];
                    echo '<h4>Copies Sold: </h4>' . $data['MillionsSold'];
                    echo '<h4>Language: </h4>' . $data['LanguageWritten'];

                    if ($data['coverImagePath'] == null) {
                        echo '<br><img id="defultImg" src="view/images/defaultImage.png">';
                    }
                    /*else {
                    echo '<img src="view/images/' . $data['coverImagePath'] . '">';
                }
                */
                }
                ?>
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