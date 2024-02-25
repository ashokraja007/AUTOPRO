<?php
include "../DBConnection/dbconnection.php";
$rid = $_REQUEST['rid'];
$status = $_REQUEST['status'];

if ($status == "Approved") {
    $qry = "UPDATE `requests` SET `status`='$status' WHERE `req_id`='$rid'";
    $result = mysqli_query($conn, $qry);
} else if ($status == "Rejected") {
    $qry = "UPDATE `login` SET `status`='$status' WHERE `req_id`='$rid'";
    $result = mysqli_query($conn, $qry);
}

if ($result) {
    echo "<script type=\"text/javascript\"> alert(\"$status\");
window.location=(\"adminViewRequests.php\");
</script>";
}
