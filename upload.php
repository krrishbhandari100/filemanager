<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
} else {
    if (!isset($_GET['location'])) {
        $location = __DIR__;
    } else {
        $location = $_GET['location'];
    }
    $location = str_replace('\\', '/', $location);
}

    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_FILES['Uploaded'])){
        for ($i=0; $i < count($_FILES['Uploaded']['name']); $i++) {
            move_uploaded_file($_FILES['Uploaded']['tmp_name'][$i], $location . '/' . $_FILES['Uploaded']['name'][$i]);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <link rel="stylesheet" href="./output.css">
</head>

<body>
    <header class="body-font bg-black text-white">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl text-white">
                    <?php echo $_SESSION['email'] ?>
                </span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 cursor-pointer">
                    <button onclick="createFile()" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                        Create File
                    </button>
                </a>
                <a class="mr-5 cursor-pointer">
                    <button onclick="createFolder()" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                        Create Folder
                    </button>
                </a>
                <a href="./logout.php" class="mr-5 cursor-pointer">Logout</a>
            </nav>
        </div>
    </header>

    <div class="py-20 h-screen bg-gray-300 px-2">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-lg">
            <div class="md:flex">
                <div class="w-full">
                    <div class="p-4 border-b-2">
                        <form method="post" enctype="multipart/form-data">
                            <span class="text-lg font-bold text-gray-600">Upload Files</span>
                            <br>
                            <input type="file" class="h-auto w-auto mb-4" name="Uploaded[]" id="Uploaded" multiple>
                            <br>
                            <input type="submit" class="w-full h-12 text-lg bg-blue-600 rounded text-white hover:bg-blue-700" value="Upload">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>