<?php
session_start();

// Check if the user is logged in (you can implement your own authentication logic)
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Database connection (you should replace this with your own database connection code)
    $servername = "localhost";
    $username = "root";
    $password = ""; // Your database password
    $dbname = "moviebooking";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $uid = $_SESSION['id']; // Assuming you have stored user_id in the session

    // Retrieve the current hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM user WHERE uid = ?");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        echo "Error in query: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentHashedPassword = $row['password'];

        // Verify the old password
        if (password_verify($oldPassword, $currentHashedPassword)) {
            // Old password is correct, update the password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateStmt = $conn->prepare("UPDATE user SET password = ? WHERE uid = ?");
            $updateStmt->bind_param("si", $hashedNewPassword, $uid);

            if ($updateStmt->execute()) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . $updateStmt->error;
            }
        } else {
            echo "Old password is incorrect.";
        }
    } else {
        echo "User not found or there was an error in the query.";
    }

    $stmt->close();
    $updateStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    <form action="change_password.php" method="POST">
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required><br><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        
        <input type="submit" value="Change Password">
    </form>
</body>
</html>
