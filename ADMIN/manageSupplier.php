<?php
include "../DBConnection/dbconnection.php";
$id = $_REQUEST['id'];
$status = $_REQUEST['status'];

if ($status == "Approved") {
    $qry = "UPDATE `login` SET `status`='$status' WHERE `reg_id`='$id' AND `usertype`='Supplier'";
    $result = mysqli_query($conn, $qry);
} else if ($status == "Rejected") {
    $qry = "UPDATE `login` SET `status`='$status' WHERE `reg_id`='$id' AND `usertype`='Supplier'";
    $result = mysqli_query($conn, $qry);
}

if ($result) {
    echo "<script type=\"text/javascript\"> alert(\"$status\");
window.location=(\"adminViewSuppliers.php\");
</script>";
}
