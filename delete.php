<?php
session_start();
function delete_directory($dirname) {
    if (is_dir($dirname))
      $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
            else
                    delete_directory($dirname.'/'.$file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
} else {
    $location = $_POST['location'];
    $type = $_POST['type'];
    
    if($type == "file" && is_file($location)){
        if(unlink($location)){
            echo "File is deleted";
        }
        else {
            echo "File could not be deleted";
        }
    }

    else if($type == "folder" && is_dir($location)) {
        if(delete_directory($location)){
            echo "Folder is deleted successfully";
        }
        else {
            echo "Folder could not be deleted";
        }
    }
    
    else {
        echo "Some Problem with your command";
    }
    
}
?>