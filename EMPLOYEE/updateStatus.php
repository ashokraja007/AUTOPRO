<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
include '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
include '../vendor/phpmailer/phpmailer/src/SMTP.php';

//Getting URL Datas
$status = $_REQUEST['status'];
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$uemail = $_REQUEST['uemail'];
$emp_mail = $_REQUEST['emp_mail'];
$vehicle = $_REQUEST['model'];


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'forpythonjava@gmail.com';                     //SMTP username
    $mail->Password   = 'qehhljesobtovekv';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    //Recipients
    $mail->setFrom($emp_mail, 'AutoPro');    //From
    $mail->addAddress($uemail, $name);     //Add a recipient--To
    $mail->addAddress($uemail);               //Name is optional


    // $message = "Dear " . $name . ",\r\n\r\n";
    // $message .= "I hope this email finds you well. We wanted to provide you with an update on the status of your vehicle, " . $vehicle . ".\r\n\r\n";

    // if ($status === "Diagnosed") {
    //     $message .= "After a thorough diagnosis, we have identified the issues with your vehicle and are now proceeding with the necessary repairs.\r\n\r\n";
    // } else if ($status === "Repaired") {
    //     $message .= "Great news! Your vehicle has been successfully repaired and is ready for pickup.\r\n\r\n";
    // } else if ($status === "Delivered") {
    //     $message .= "Your vehicle has been delivered to your specified location. It's now ready for you to use.\r\n\r\n";
    // } else {
    //     $message .= "We apologize, but there has been an error in updating your vehicle's status. Please contact us for further information.\r\n\r\n";
    // }

    // $message .= "If you have any questions or require additional details, please do not hesitate to contact us. We are here to assist you with any concerns you may have.\r\n\r\n";
    // $message .= "Thank you for choosing our car workshop, and we look forward to continuing to serve your automotive needs.";

    //TEST
    $mail->IsHTML(true); // Set email format to HTML

    $message = '<html>
<head>
    <title>Service Status Update</title>
</head>
<body>
    <p>Dear ' . $name . ',</p>
    <p>I hope this email finds you well. We wanted to provide you with an update on the status of your vehicle, ' . $vehicle . '.</p>';

    // Add HTML content, styling, and conditional content here
    if ($status === "Diagnosed") {
        $message .= '<p>After a thorough diagnosis, we have identified the issues with your vehicle and are now proceeding with the necessary repairs.</p>';
    } elseif ($status === "Repaired") {
        $message .= '<p>Great news! Your vehicle has been successfully repaired and is ready for pickup.</p>';
    } elseif ($status === "Delivered") {
        $message .= '<p>Your vehicle has been delivered to your specified location. It\'s now ready for you to use.</p>';
    } else {
        $message .= '<p>We apologize, but there has been an error in updating your vehicle\'s status. Please contact us for further information.</p>';
    }

    $message .= '
    <p>If you have any questions or require additional details, please do not hesitate to contact us. We are here to assist you with any concerns you may have.</p>
    <p>Thank you for choosing our car workshop, and we look forward to continuing to serve your automotive needs.</p>
</body>
</html>';

    $mail->Body = $message; // Set the complete HTML message as the email body

    include '../DBConnection/dbconnection.php';

    // TEST END
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Service Status Update for Your Vehicle';
    $mail->Body    = $message;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    if ($status == "Booked") {
        $qry = "UPDATE `booking` SET `status`='Diagnosed' WHERE `booking_id`='$id'";
        $result = mysqli_query($conn, $qry);
    } else if ($status == "Diagnosed") {
        $qry = "UPDATE `booking` SET `status`='Repaired' WHERE `booking_id`='$id'";
        $result = mysqli_query($conn, $qry);
    } else if ($status == "Repaired") {
        $qry = "UPDATE `booking` SET `status`='Delivered' WHERE `booking_id`='$id'";
        $result = mysqli_query($conn, $qry);
    }

    if ($result) {
        echo "<script type=\"text/javascript\"> alert(\"Updated\");
    window.location=(\"empViewBookings.php\");
    </script>";
    }

    // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
