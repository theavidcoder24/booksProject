<?php
//$action_type = ':actiontype';
//require("connectionDB.php");
if (isset($_GET['link'])) {
    $link = $_GET['link'];
    switch ($link) {
        case ($action_type == "edit"):
            include("../../controller/editFormProcess.php");
            break;

        case ($action_type == "delete"):
            include("../controller/deleteFormProcess.php");
            break;
        default:
            echo "Nope";
            break;
    }
}
