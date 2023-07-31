<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moviebooking";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mid = isset($_POST['mid']) ? $_POST['mid'] : null;
$fdate = isset($_POST['fdate']) ? $_POST['fdate'] : null;
$fshow = isset($_POST['fshow']) ? $_POST['fshow'] : null;

if ($mid === null || $fdate === null || $fshow === null) {
    echo "Invalid booking details.";
    exit;
}

// Validate the movie ID
$sql = "SELECT * FROM movie WHERE id = $mid";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    echo "Movie not found.";
    exit;
}

// Insert the booking record
$sqlInsert = "INSERT INTO booking (seats, movie_id, show_date, show_time) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sqlInsert);
$stmt->bind_param("iiss", $seats, $mid, $fdate, $fshow);

// Retrieve the number of seats from the form
$seats = isset($_POST['seats']) ? $_POST['seats'] : null;

if ($seats === null) {
    echo "Invalid number of seats.";
    exit;
}

if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Booking failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
