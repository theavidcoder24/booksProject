<?php
if (isset($_GET['link'])) {
    $link = $_GET['link'];
    switch ($link) {
        case "allBooks":
            require("../model/displayBooks.php");
            break;
        case "newBook":
            require_once("addBookFunction.php");
            break;
        case "edit":
            require_once("editBookFunction.php");
            break;
        case "delete":
            require("deleteBooksFunction.php");
            break;
    }
} else {
    require("../model/displayBooks.php");
}
