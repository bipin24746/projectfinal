<?php
$servername = "localhost";
$username = "root";
$password = ""; // Provide a valid password here if required
$dbname = "moviebooking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $industry = $_POST['industry'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];
    $reldate = $_POST['reldate'];
    $director = $_POST['director'];
    $actor = $_POST['actor'];
    $price = $_POST['price'];
    $fshow = $_POST['fshow'];
    $fdate = date('Y-m-d', strtotime($_POST['fdate']));
    $sdate = date('Y-m-d', strtotime($_POST['sdate']));

    if ($_FILES["image"]["name"]) {
        $file_name = $_FILES["image"]["name"];
        $file_size = $_FILES["image"]["size"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_type = $_FILES["image"]["type"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_extensions = array("jpg", "jpeg", "png"); // Add any additional allowed extensions here

        if (in_array($file_ext, $allowed_extensions)) {
            if ($file_size < 5242880) { // Max file size: 5MB (you can adjust this value)
                $destination = "images" . $file_name;

                if (move_uploaded_file($file_tmp, $destination)) {
                    $image = mysqli_real_escape_string($conn, $destination);

                    // Insert data into the database
                    $sql = "INSERT INTO movie (name, genre, industry, language, duration, reldate, director, actor, price, image, fshow, fdate, sdate) VALUES ('$name', '$genre', '$industry', '$language', '$duration', '$reldate', '$director', '$actor', '$price', '$file_name', '$fshow', '$fdate', '$sdate')";

                    echo 'SQL query: ' . $sql . '<br>'; // Add this line for debugging

                    $result = $conn->query($sql);

                    if ($result) {
                        echo '<script type="text/javascript"> alert("Movie added successfully."); </script>';
                        header("Location: movielist.php");
                        exit;
                    } else {
                        echo '<script type="text/javascript"> alert("Error: ' . $conn->error . '"); </script>';
                    }
                } else {
                    echo '<script type="text/javascript"> alert("Error moving uploaded file."); </script>';
                }
            } else {
                echo '<script type="text/javascript"> alert("File size exceeds the maximum limit."); </script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Invalid file format. Only JPG, JPEG, and PNG files are allowed."); </script>';
        }
    } else {
        // Insert data into the database without an image
        $sql = "INSERT INTO movie (name, genre, industry, language, duration, reldate, director, actor, price, fshow, fdate, sdate) VALUES ('$name', '$genre', '$industry', '$language', '$duration', '$reldate', '$director', '$actor', '$price', '$fshow', '$fdate', '$sdate')";

        echo 'SQL query: ' . $sql . '<br>'; // Add this line for debugging

        $result = $conn->query($sql);

        if ($result) {
            echo '<script type="text/javascript"> alert("Movie added successfully."); </script>';
            header("Location: movielist.php");
            exit;
        } else {
            echo '<script type="text/javascript"> alert("Error: ' . $conn->error . '"); </script>';
        }
    }
}
?>
