<?php
/*
if(isset($_GET['link'])) {
    $link = $_GET['link'];
    switch ($link) {
        case "add":
            require("../controller/addFormProcess.php");
            break;

        case "edit":
            require("../controller/editFormProcess.php");
            break;

        case "delete":
            require("../controller/deleteFormProcess.php");
            break;
    }
}
*/
if (isset($_GET['link'])) {
    $action_type = $_GET['link'];
    switch ($action_type) {
            /* case ($action_type == 'add');
            include("../controller/addFormProcess.php");
            break; */
        case ($action_type == "edit"):
            include("../controller/editFormProcess.php");
            break;

        case ($action_type == "delete"):
            include("../controller/deleteFormProcess.php");
            break;
        default:
            echo "No information available for that day.";
            break;
    }
}
