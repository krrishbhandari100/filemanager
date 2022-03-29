<?php
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email == "krrish@mail2webmaster.com" && $password == "admin"){
        session_start();
        $_SESSION['email'] = $email;
        header('Location: filemanager.php?location=' . __DIR__);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhandari FileManager</title>
    <link rel="stylesheet" href="./output.css">
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
    <div class="flex items-center justify-center h-[100vh]">
        <div class="space-y-8 bg-white w-full rounded-md h-[400px] flex justify-center flex-col md:w-[700px]">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://www.certifiedfinancialguardian.com/images/blog-wp-login.png" alt="Workflow">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-black">Welcome To Bhandari File FileManager</h2>
                
            </div>
            <center>
            <form class="mt-8 space-y-6" action="#" method="POST">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">

                        <div>
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address" name="email" type="email" required class="mb-4 appearance-none rounded-none relative block w-full md:w-[600px] px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                        </div>
                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full md:w-[600px] px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                        </div>
                    </div>
                    <div>
                    <button type="submit" class="group relative w-full md:w-[600px] flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </center>
        </div>
    </div>

</body>

</html>