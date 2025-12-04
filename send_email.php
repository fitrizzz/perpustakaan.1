<?php
require 'vendor/autoload.php'; // Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'conn.php'; // Include database connection

// Fetch email addresses from MySQL
$sql = "SELECT * FROM pengguna"; // Change table and column names if needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Change if using a different SMTP provider
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dopymonster@gmail.com'; // Your email address
        $mail->Password   = 'ewzvlofdvddedtqy'; // Use App Password if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('dopymonster@gmail.com', 'dopy'); // Sender email and name

        // Loop through users and send email
        while ($row = $result->fetch_assoc()) {
            $mail->addAddress($row['email'], $row['nama_pengguna']); // Recipient email & name

            // Email Content
            $mail->Subject = "Hello " . $row['nama_pengguna'] . ", Welcome!";
            $mail->Body    = "Dear " . $row['nama_pengguna'] . ",\n\nThis is a test email from our system.";

            // Send email
            if ($mail->send()) {
                echo "Email sent to: " . $row['email'] . "<br>";
            } else {
                echo "Failed to send email to: " . $row['email'] . "<br>";
            }

            $mail->clearAddresses(); // Clear recipients for the next loop
        }
    } catch (Exception $e) {
        echo "Email sending failed: {$mail->ErrorInfo}";
    }
} else {
    echo "No users found!";
}

$conn->close();
?>
