<?php
session_start();
include('header.php');
if(isset($_POST['signinBtn'])) {
    // Get the username and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $dbname = "moviebooking";
    $conn = new mysqli($servername, $username, "", $dbname);
    if($conn->connect_error) {
        die ("Connection failed ".$conn->connect_error);
    }

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the row as an associative array
        $_SESSION['id'] = $row['uid']; // Access the 'id' column from the fetched row
        $_SESSION['email'] = $email;
        // if (isset($row['id'])) {
        //     $_SESSION['id'] = $row['id']; // Access the 'id' column from the fetched row
        // }
        
        header ('location: index.php');
        
        exit();
    }
    else {
        echo "email or password invalid";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Tailwind CSS CDN link here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .form-box {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="form-box bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl text-center font-bold mb-6">Sign In</h1>
            <h2 class="text-center mb-4">WELCOME TO MOVIE WORLD</h2>
            <form method="POST" action="login.php">
                <div class="input-group">
                    <div class="input-field mb-4">
                        <input type="text" placeholder="Enter Your email" name="email" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="input-field mb-4">
                        <input type="password" placeholder="Password" name="password" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="SignUp-link mb-4">
                        <button type="submit" name="signinBtn"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Sign In
                        </button>
                    </div>
                    <p class="text-center">Don't have an account? <a href="register.php"
                            class="text-blue-500 hover:text-blue-700">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>

