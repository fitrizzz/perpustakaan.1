<?php
    include "conn.php";
    session_start();

    $pid = $_SESSION["id"];
    $bukuid = $_GET["bukuid"];
    $namabuku = $_GET["namabuku"];

    $sql = "UPDATE buku SET status = 'tersedia' WHERE buku_id = $bukuid";
    mysqli_query($conn,$sql);

    $sql = "DELETE FROM pinjam WHERE buku_id = $bukuid AND pengguna_id = $pid AND status = 'lulus' ";
    mysqli_query($conn,$sql);
    

    // echo "<script>alert('BERJAYA PULANG');</script>";
    // -------------------------------------------------------------------------------------------------------------------------------------------------
    require 'vendor/autoload.php'; // Load PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    include 'conn.php'; // Include database connection
    
    // Fetch email addresses from MySQL
    $sql = "SELECT * FROM pengguna WHERE pengguna_id IN 
            (SELECT pengguna_id FROM pinjam WHERE status = 'noti_me' AND buku_id = $bukuid)"; // Change table and column names if needed
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
                $mail->Subject = "Hello " . $row['nama_pengguna'];
                $mail->Body    = "BUKU ANDA $namabuku . $bukuid telah depulangkan sila terima dari noti degan cepat";
    
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

    // ------------------------------------------------------------------------------------------------------------------------------------------------------

    header("location: home_pengguna.php");


?>