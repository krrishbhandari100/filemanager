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
    $dirs = scandir($location);
    $location = str_replace('\\', '/', $location);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['Uploaded'])) {
        for ($i = 0; $i < count($_FILES['Uploaded']['name']); $i++) {
            move_uploaded_file($_FILES['Uploaded']['tmp_name'][$i], $location . '/' . $_FILES['Uploaded']['name'][$i]);
        }
        header("Location: filemanager.php?location=" . $location);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To
        <?php echo $_SESSION['email'] ?>
    </title>
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

                <a class="mr-5 cursor-pointer">
                    <form method="post" enctype="multipart/form-data">
                        <input id="fileupload" onchange="fileUpload()" type="file" class="h-auto w-auto mb-4" name="Uploaded[]" id="Uploaded" multiple value="File Upload">
                        <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            <span>Upload</span>
                        </button>
                    </form>
                </a>
                <a href="./logout.php" class="mr-5 cursor-pointer">Logout</a>
            </nav>
        </div>
    </header>

    <div class="form">
        <center>
            <form method="get">
                <input type="text" name="location" value="<?php echo $location; ?>" class="border-2 border-black w-[98vw] h-14 mb-3 mt-3 rounded-lg text-2xl">
            </form>
        </center>
    </div>
    <div class="relative sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Filename
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Delete
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rename
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($dirs); $i++) {
                    if ($dirs[$i] == "." || $dirs[$i] == '..') {
                        echo "";
                    } else {
                        if (is_dir($location . '/' . $dirs[$i])) {
                            echo "
                            <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                            <th scope='row' class='px-6 flex items-center py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap'><img style='height: 51px;' src='https://i.pinimg.com/474x/fe/dc/ee/fedceef43b1e8c83b404245a6686bafe.jpg' />&nbsp;&nbsp;<a href='./filemanager.php?location=" . $location . '/' . $dirs[$i] . "'>" . $dirs[$i] . "</a></th>
                            <td class='px-6 py-4'>
                                <button type='button' disabled class='text-white opacity-20 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Edit</button>
                            </td>
                            
                            
                            <td class='px-6 py-4'>
                                <a onclick='deleteFile(`$location/$dirs[$i]`, `folder`)' type='button' class='focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 cursor-pointer dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'>Delete</a>
                            </td>
                            
                            <td class='px-6 py-4'>
                                <a onclick='renameFile(`$dirs[$i]`)' type='button' class='focus:outline-none text-white cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900'>Rename</a>
                            </td>
                            </tr>";
                        } else {
                            echo "
                            <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                            <th scope='row' class='px-6 flex items-center py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap'><img style='height: 51px;' src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/File_alt_font_awesome.svg/1024px-File_alt_font_awesome.svg.png' />&nbsp;&nbsp;" . $dirs[$i] . "</th>
                            <td class='px-6 py-4'>
                                <a href='./edit.php?file_name=" . $location . '/' . $dirs[$i] . "' type='button' class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Edit</a>
                            </td>
                            <td class='px-6 py-4'>
                                <a onclick='deleteFile(`$location/$dirs[$i]`, `file`)' type='button' class='focus:outline-none cursor-pointer text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'>Delete</a>
                            </td>

                            <td class='px-6 py-4'>
                                <a onclick='renameFile(`$dirs[$i]`)' type='button' class='focus:outline-none text-white bg-blue-700 cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900'>Rename</a>
                            </td>
                            </tr>";
                        }
                    }
                }

                ?>
            </tbody>
        </table>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script defer>
    const createFile = () => {
        Swal.fire({
            text: "Enter the name of the file",
            input: 'text',
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                let location = `<?php echo $location; ?>/${result.value}`;
                $.post('create_file_folder.php', {
                    type: 'file',
                    location: location
                }, (data, status) => {
                    console.log(data)
                    Swal.fire('Created!', data, 'success').then(() => {
                        window.location.reload();
                    });
                })
            }
        });

    }

    const createFolder = () => {
        Swal.fire({
            text: "Enter the name of the folder",
            input: 'text',
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                let location = `<?php echo $location; ?>/${result.value}`;
                $.post('create_file_folder.php', {
                    type: 'folder',
                    location: location
                }, (data, status) => {
                    Swal.fire('Created!', data, 'success').then(() => {
                        window.location.reload();
                    });
                })
            }
        });
    }

    const deleteFile = (file, type) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('delete.php', {
                    type: type,
                    location: file
                }, (data, status) => {
                    Swal.fire('Deleted!', data, 'success').then(() => {
                        window.location.reload();
                    });
                })
            }
        })

    }

    const renameFile = (filename) => {
        Swal.fire({
            text: "New Name for the file:",
            input: 'text',
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                let iniFileName = `<?php echo $location; ?>/${filename}`;
                let newNameFile = `<?php echo $location; ?>/${result.value}`;
                $.post('rename.php', {
                    location: iniFileName,
                    newName: newNameFile
                }, (data, status) => {
                    Swal.fire('Renamed!', 'Your file got renamed.', 'success').then(() => {
                        window.location.reload();
                    })
                })
            }
        });
    }

    const fileUpload = () => {
        console.log("File Upload called")
        let timerInterval
        Swal.fire({
            title: 'File is uploading',
            html: 'Uploading in <b></b> milliseconds.',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 1000)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            Swal.fire('Upload Success!', 'File Uploaded', 'success')
        })
    }
</script>

</html>