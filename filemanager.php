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
}
function escapeJsonString($value)
{
    $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
    $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
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
                            <th scope='row' class='px-6 flex items-center py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap'><img style='height: 51px;' src='https://i.pinimg.com/474x/fe/dc/ee/fedceef43b1e8c83b404245a6686bafe.jpg' />&nbsp;&nbsp;<a href='./filemanager.php?location=" . $location . '\\' . $dirs[$i] . "'>" . $dirs[$i] . "</a></th>
                            <td class='px-6 py-4'>
                                <button type='button' disabled class='text-white opacity-20 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Edit</button>
                            </td>
                            
                            
                            <td class='px-6 py-4'>
                                <a href='./delete.php?type=folder&location=" . $location . '\\' . $dirs[$i] . "' type='button' class='focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'>Delete</a>
                            </td>
                            
                            <td class='px-6 py-4'>
                                <a onclick='renameFile(" . $dirs[$i] . ")' href='./rename.php?type=folder&location=" . $location . '\\' . $dirs[$i] . "' type='button' class='focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900'>Rename</a>
                            </td>
                            </tr>";
                        } else {
                            echo "
                            <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                            <th scope='row' class='px-6 flex items-center py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap'><img style='height: 51px;' src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/File_alt_font_awesome.svg/1024px-File_alt_font_awesome.svg.png' />&nbsp;&nbsp;" . $dirs[$i] . "</th>
                            <td class='px-6 py-4'>
                                <a href='./edit.php?file_name=" . $location . '\\' . $dirs[$i] . "' type='button' class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Edit</a>
                            </td>
                            <td class='px-6 py-4'>
                                <a href='./delete.php?type=file&location=" . $location . '\\' . $dirs[$i] . "' type='button' class='focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'>Delete</a>
                            </td>

                            <td class='px-6 py-4'>
                                <a onclick='renameFile(`$dirs[$i]`)' type='button' class='focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900'>Rename</a>
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
<script defer>
    const createFile = () => {
        const filename = prompt("Enter the Filename with extension");
        let location = `<?php echo escapeJsonString($location) ?>\\${filename}`;
        $.post('create_file_folder.php', {
            type: 'file',
            location: location
        }, (data, status) => {
            window.location.reload();
        })
    }

    const createFolder = () => {
        const filename = prompt("Enter the Foldername");
        let location = `<?php echo escapeJsonString($location) ?>\\${filename}`;
        $.post('create_file_folder.php', {
            type: 'folder',
            location: location
        }, (data, status) => {
            window.location.reload();
        })
    }

    const renameFile = (filename) => {
        let iniFileName = `<?php echo escapeJsonString($location) ?>\\${filename}`;
        const newName = prompt("Enter the New name");
        let newNameFile = `<?php echo escapeJsonString($location) ?>\\${newName}`;
        $.post('rename.php', {
            location: iniFileName,
            newName: newNameFile
        }, (data, status) => {
            window.location.reload();
        })
    }
</script>

</html>