<?php
session_start();

// Check if OTP is submitted
if (isset($_POST['verifyBtn'])) {
    $otp = $_POST['otp'];

    // Check if OTP is correct
    if ($otp == $_SESSION['otp']) {
        // OTP is correct, process the registration data and save to database
        if (isset($_SESSION['registration_data'])) {
            $registrationData = $_SESSION['registration_data'];

            // Connect to your database (replace these with your actual database credentials)
            $dbHost = 'your_database_host';
            $dbUser = 'your_database_username';
            $dbPass = 'your_database_password';
            $dbName = 'your_database_name';

            $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

            // Check the database connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Save the user details to the database
            $name = $registrationData['name'];
            $email = $registrationData['email'];
            // Add other fields as needed

            $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

            if ($conn->query($sql) === TRUE) {
                // Registration successful, redirect to login page
                header('location: login.php');
                exit();
            } else {
                // If there's an error in the SQL query
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Registration data not found.";
        }
    } else {
        // OTP is incorrect, display error message
        echo "Invalid OTP. Please try again.";
    }
}

include('header.php');
?>


<link rel="stylesheet" href="style.css">
<div class="container">
    <div class="form-box">
        <h1 id="Title">Verify OTP</h1>
        <form action="verify_otp.php" method="POST">
            <div class="input-group">
                <div class="input-field">
                    <input type="text" placeholder="Enter OTP" id="otp" name="otp" required><br>
                </div>
                <div class="SignUp-link">
                    <button type="submit" name="verifyBtn">Verify</button>
                    <br>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include('footer.php');
?>
