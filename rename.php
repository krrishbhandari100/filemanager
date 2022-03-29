<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
}

else {
    $location = $_POST['location'];
    $newname = $_POST['newName'];

    echo $location;
    echo $newname;
    rename($location, $newname);
    
}
?>