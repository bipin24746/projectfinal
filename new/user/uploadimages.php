<?php
session_start();
date_default_timezone_set('Asia/Kathmandu');

require '../connection.php';
include 'header.php';

// Check if the user is logged in and the email address is available in the session
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page or display an error message
    header('Location: login.php');
    exit;
}

// Get the user ID of the logged-in user
$userId = $_SESSION['user_id'];
if (isset($_GET['booking_date']) && isset($_GET['booking_time'])) {
    $booking_date = $_GET['booking_date'];
    $booking_time = $_GET['booking_time'];

    echo "Booking Date: $booking_date<br>";
    echo "Booking Time: $booking_time";}
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Check if there are uploaded files
    if (isset($_FILES['images']) && is_array($_FILES['images']['tmp_name']) && count($_FILES['images']['tmp_name']) > 0) {
        // Define upload directory
        $uploadDir = '../uploads/';

        // Start a transaction to ensure consistency in the database
        $conn->begin_transaction();

        try {
            // Iterate through each uploaded file
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                // Generate a unique filename
                $fileName = uniqid() . '_' . $_FILES['images']['name'][$key];

                // Define the full path for the file
                $targetPath = $uploadDir . $fileName;

                // Move the uploaded file to the destination
                if (move_uploaded_file($tmpName, $targetPath)) {
                    // Update the 'image_path' column in the 'booking' table
                    $imagePath = $fileName;
                    $bookingDate = $_POST['booking_date']; // Assuming you have a hidden input field for booking_date in your form
                    $bookingTime = $_POST['booking_time']; // Assuming you have a hidden input field for booking_time in your form

                    $sql = "UPDATE booking SET image_path = ? WHERE user_id = ? AND booking_date = ? AND booking_time = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('siss', $imagePath, $userId, $bookingDate, $bookingTime);
                    $stmt->execute();
                    $stmt->close();

                    echo "Image uploaded successfully!";
                } else {
                    echo "Image upload unsuccessful.";
                }
            }

            // Commit the transaction if all insertions are successful
            $conn->commit();
        } catch (Exception $e) {
            // Rollback the transaction in case of any error during insertions
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No images selected for upload.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Images</title>
    <link rel="stylesheet" href="seats.css">
</head>
<body>
    <div class="container">
        <h1>Upload Images</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <!-- Assuming you have a hidden input field for booking_date and booking_time -->
            <input type="hidden" name="booking_date" value="<?php echo $_GET['booking_date']; ?>">
            <input type="hidden" name="booking_time" value="<?php echo $_GET['booking_time']; ?>">

            <label>Select Images:</label>
            <input type="file" name="images[]" multiple accept="image/*">

            <input type="submit" name="submit" value="Upload Images">
        </form>

        <a href="index.php">Back to Booking</a>
    </div>
</body>
</html>
