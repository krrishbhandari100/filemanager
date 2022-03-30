<?php
include './params.php';
if($auth){
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
    }
}
$location = $_POST['location'];
$newname = $_POST['newName'];

echo $location;
echo $newname;
rename($location, $newname);
?>