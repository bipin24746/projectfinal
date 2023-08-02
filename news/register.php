<?php
session_start();
require_once "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

// Check if the registration form is submitted
if (isset($_POST['signupBtn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];

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

        // Insert user data into database
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
        echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
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
                    <input type="text" placeholder="Enter First Name" id="fname" name="fname" required><br>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Enter Last Name" id="lname" name="lname" required><br>
                </div>
                <div class="input-field">
                    <input type="email" placeholder="Enter your Email" id="email" name="email" required><br>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Enter Your Password" id="password" name="password" required><br>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Confirm Password" id="cpassword" name="cpassword" required><br>
                </div>
                <div class="input-field">
                    <input type="contact" placeholder="Enter Your Phone Number" id="phone" name="phone" required><br>
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

<?php
include('footer.php');
?>
