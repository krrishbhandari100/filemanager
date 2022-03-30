<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
} else {
    $location = $_POST['location'];
    $type = $_POST['type'];
    echo $location;
    if($type == 'file'){
        $myfile = fopen($location, "w") or die("Unable to open file!");
        fclose($myfile);
    }
    else if($type == 'folder') {
        mkdir($location);
    }
}
?>