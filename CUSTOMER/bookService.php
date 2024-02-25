<?php
session_start();
include "../DBConnection/dbconnection.php";
$sid = $_REQUEST['sid'];
$uid = $_SESSION['uid'];

$qry = "SELECT * FROM `booking` WHERE `sid`='$sid' AND `uid`='$uid' AND `status`='Booked'";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) > 0) {
    echo "<script type=\"text/javascript\"> alert(\"Already Booked\");
    window.location=(\"service-details.php?sid=$sid\");</script>";
} else {
    $qryCheck = "SELECT COUNT(*) AS cnt FROM `booking` WHERE `sid`='$sid' AND `status`='Booked'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);
    if ($fetchData['cnt'] < 5) {
        $qry1 = "INSERT INTO `booking`(`uid`,`sid`,`date`)VALUES('$uid','$sid',CURDATE())";
        if (mysqli_query($conn, $qry1)) {
            echo "<script type=\"text/javascript\"> alert(\"Booking Successful\");window.location=(\"service-details.php?sid=$sid\");</script>";
        }
    } else {
        echo "<script>alert('Booking Full....Sorry For The Inconvenience');window.location=(\"service-details.php?sid=$sid\");</script>";
    }
}
