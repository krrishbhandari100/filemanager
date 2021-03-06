<?php
include './params.php';
if ($auth) {
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
    }
}
$file_name = $_GET['file_name'];
$scr = "";
$file_name = str_replace('\\', '/', $file_name);
if (!file_exists($file_name)) {
    header('Location: filemanager.php?location=' . __DIR__);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileContents = $_POST['contents'];
    $file_put = file_put_contents($file_name, $fileContents);
    if ($file_put) {
        $scr = "
        <script>
        Swal.fire(
            'File Saved',
            'You file is saved now',
            'success'
          ).then(()=>{
              window.location = 'filemanager.php?location=" . dirname($file_name) . "';
          })
          </script>
        ";
    } else {
        $scr = "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!'
          }).then(()=>{
               window.location = 'filemanager.php?location=" . dirname($file_name) . "';
          })
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./output.css">
    <?php echo $scr; ?>
</head>

<body>
    <center>
        <form method="post">
            <textarea id="contents" name="contents" class="h-[90vh] w-[90vw] border border-black"><?php echo file_get_contents($file_name); ?></textarea>
            <br>
            <button type='submit' class='text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Edit</button>
        </form>
    </center>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo $scr; ?>

</html>