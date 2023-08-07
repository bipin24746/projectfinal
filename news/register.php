<?php
session_start();
require_once "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

// Initialize error variables
$emailErr = $passwordErr = $cpasswordErr = $phoneErr = "";

// Check if the registration form is submitted
if (isset($_POST['signupBtn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    // Check if the email already exists in the database
    $existing_email_query = "SELECT email FROM user WHERE email = '$email'";
    $result = $conn->query($existing_email_query);
    if ($result->num_rows > 0) {
        $emailErr = "Email already exists.";
    }

    // Validate password length
    if (strlen($password) < 6 || strlen($password) > 16) {
        $passwordErr = "Password must be between 6 and 16 characters long.";
    }

    // Check if password and confirm password match
    if ($password !== $cpassword) {
        $cpasswordErr = "Passwords do not match.";
    }

    // If there are no errors, proceed with the registration process
    if (empty($emailErr) && empty($passwordErr) && empty($cpasswordErr)) {
        // Generate and store OTP
        $otp = mt_rand(100000, 999999);
        $_SESSION['otp'] = $otp;

        // Send OTP to user's email
        $message = "Your OTP is: $otp";

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Gmail SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sainjubipin247460@gmail.com';
            $mail->Password = 'lyyyecmtzwunvzhs';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient details
            $mail->setFrom('sainjubipin247460@gmail.com', 'Movie World');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'OTP Verification';
            $mail->Body = $message;

            $mail->send();

            // Insert user data into the database
            $sql = "INSERT INTO user (fname, lname, email, password, phone) VALUES ('$fname', '$lname', '$email', '$password', '$phone')";
            if ($conn->query($sql) === true) {
                $u_id = $conn->insert_id;
                $otp_query = "INSERT INTO otp (u_id, otp) VALUES ('$u_id', '$otp')";
                if ($conn->query($otp_query) === true) {
                    header('location: verify_otp.php');
                    exit();
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error: " . $conn->error;
            }
        } catch (Exception $e) {
            $emailErr = 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
    }
}

include('header.php');
?>

<link rel="stylesheet" href="style.css">
<div class="container">
    <div class="form-box">
        <h1 id="Title">Sign Up</h1>
        <h2>LET'S ENJOY MOVIE WORLD</h2>
        <form action="register.php" method="POST">
            <div class="input-group">
                <div class="input-field">
                    
<div class="input-field">
    <input type="text" placeholder="Enter First Name" id="fname" name="fname" required value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>"><br>
</div>
<div class="input-field">
    <input type="text" placeholder="Enter Last Name" id="lname" name="lname" required value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''; ?>"><br>
</div>

<!-- Display error message for email -->
<div class="input-field">
    <input type="email" placeholder="Enter your Email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br>
</div>
<div class="error"><?php echo $emailErr; ?></div>

<!-- Display error message for password -->
<div class="input-field">
    <input type="password" placeholder="Enter Your Password" id="password" name="password" required><br>
</div>
<div class="error"><?php echo $passwordErr; ?></div>

<!-- Display error message for confirm password -->
<div class="input-field">
    <input type="password" placeholder="Confirm Password" id="cpassword" name="cpassword" required><br>
</div>
<div class="error"><?php echo $cpasswordErr; ?></div>

<!-- Display error message for phone -->
<div class="input-field">
    <input type="contact" placeholder="Enter Your Phone Number" id="phone" name="phone" required value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"><br>
</div>
<div class="error"><?php echo $phoneErr; ?>
</div>

                <div class="SignUp-link">
                    <button type="submit" name="signupBtn">Sign Up</button>
                    <br>
                </div>
                <p>Already have an account? <a href="login.php">Sign in</a></p>
            </div>
        </form>
    </div>
</div>


