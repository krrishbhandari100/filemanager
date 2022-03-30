<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
} else {
    $location = $_POST['location'];
    $type = $_POST['type'];
    
    if($type == 'file'){
        $myfile = fopen($location, "w") or die("Unable to open file!");
        fclose($myfile);
        echo "Your file has been created.";
    }
    else if($type == 'folder') {
        if(mkdir($location)){
            echo "Folder is created";
        }
        else {
            echo "Folder is not created";
        }
    }
}
?>