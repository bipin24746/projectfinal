 <?php
session_start();

// Check if OTP is submitted
if (isset($_POST['verifyBtn'])) {
    $otp = $_POST['otp'];

    // Check if OTP is correct
    if ($otp == $_SESSION['otp']) {
        // OTP is correct, redirect to login page
        header('location: login.php');
        exit();
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
