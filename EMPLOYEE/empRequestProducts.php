<?php
session_start();
include "employeeHeader.php";
include "../DBConnection/dbconnection.php";
$uid = $_SESSION['uid'];
?>
<style>
    #table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 95%;
        margin-top: 10px !important;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
        color: black;
    }
</style>

<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">Request</h5>
                    <h2 class="main-title">Parts</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="employeeHome.php">Home</a></li>
                    <li class="breadcrumb-item active">Request Parts</li>
                </ul>
            </div>
            <div class="page-banner-images">
                <img src="../assets/images/about/about-2.png" alt="Page Banner">
            </div>
        </div>
    </div>
</div>
<!-- Page Banner Section End -->

<!-- Login & Register Section Start -->
<div class="section section-padding">
    <div class="container">
        <!-- Register & Login Wrapper Start -->
        <div class="register-login-wrapper">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <!-- Register & Login Form Start -->
                    <div class="register-login-form">
                        <h3 class="title">Request <span>Parts</span></h3>
                        <div class="form-wrapper">
                            <form method="post">
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <input type="text" placeholder="Name" required name="name">
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <input type="text" placeholder="Compatiable For" required name="model">
                                </div>
                                <div class="single-form">
                                    <input type="text" pattern="[0-9]+" placeholder="Quantity" required name="qty">
                                </div>
                                <div class="single-form">
                                    <textarea name="desc" id="" cols="30" required rows="5" placeholder="Remarks"></textarea>
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <button type="submit" name="add" class="btn btn-custom-01 w-100">Add</button>
                                </div>
                                <!-- Single Form End -->
                            </form>
                        </div>
                    </div>
                    <!-- Register & Login Form End -->
                </div>
            </div>
        </div>
        <!-- Register & Login Wrapper End -->
    </div>
</div>
<!-- Login & Register Section End -->

<?php
include "../DBConnection/dbconnection.php";
if (isset($_REQUEST['add'])) {
    $Name = $_REQUEST['name'];
    $Model = $_REQUEST['model'];
    $Qty = $_REQUEST['qty'];
    $Desc = $_REQUEST['desc'];

    $qryCheck = "SELECT COUNT(*) AS cnt, `name`, `model`, `emp_id`, `qty` FROM `requests` WHERE `name` = ? AND `model` = ? AND `emp_id` = ? GROUP BY `name`, `model`, `emp_id`, `qty`";
    $stmtCheck = mysqli_prepare($conn, $qryCheck);
    mysqli_stmt_bind_param($stmtCheck, "sss", $Name, $Model, $uid);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    $fetchData = mysqli_fetch_array($resultCheck);

    if ($fetchData['cnt'] > 0) {
        $updateQty = $fetchData['qty'] + $Qty;
        $qryUpdate = "UPDATE `requests` SET `qty` = ?, `status` = 'Requested' WHERE `name` = ? AND `model` = ? AND `emp_id` = ?";
        $stmtUpdate = mysqli_prepare($conn, $qryUpdate);
        mysqli_stmt_bind_param($stmtUpdate, "dsss", $updateQty, $Name, $Model, $uid);
        if (mysqli_stmt_execute($stmtUpdate)) {
            // echo $fetchData['cnt'];
            echo "<script>alert('Success');window.location='empRequestProducts.php';</script>";
        } else {
            $qryAdd = "INSERT INTO `requests` (`emp_id`,`name`,`model`,`qty`,`desc`,`date`) VALUES('$uid','$Name','$Model','$Qty','$Desc',CURDATE())";
            if ($conn->query($qryAdd) == TRUE) {
                echo "<script>alert('Request Added');window.location = 'empRequestProducts.php';</script>";
            } else {
                echo "<script>alert('Failed');window.location = 'empRequestProducts.php';</script>";
                echo "Error:" . mysqli_error($conn);
            }
        }
    }
}
?>


<?php
$qry = "SELECT `requests`.* FROM `requests`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Requests Added</h1>
    </center>
<?php

} else {
    $row = mysqli_fetch_array($result);
?>

    <center>
        <h1 class="m-3 bread">My Requests</h1>
        <input type="text" class="form-control" id="searchInput" style="width: 98%;" placeholder="Search...">
        <table id="table" border="1" style="width: 98%;">
            <thead>
                <tr style="text-align: center;">
                    <th>Name</th>
                    <th>Model</th>
                    <th>Quantity</th>
                    <th>Remarks</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                do {
                ?>
                    <tr id="row{{ forloop.counter }}" style="text-align: center;">
                        <td>
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <?php echo $row["model"] ?>
                        </td>
                        <td>
                            <?php echo $row['qty'] ?>
                        </td>
                        <td>
                            <?php echo $row['desc'] ?>
                        </td>
                        <td>
                            <?php echo $row['date'] ?>
                        </td>
                        <td>
                            <?php echo $row['status'] ?>
                        </td>
                    </tr>
                <?php
                } while ($row = mysqli_fetch_array($result))
                ?>
            </tbody>
        </table>
        <div id="noMatchingData" style="display: none;">
            <h1 class="m-5">No Results Found</h1>
        </div>
    </center>
<?php }

?>


<!-- Include Bootstrap JS and jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle search input
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            var rows = $("#tableBody tr");
            var matchingRows = rows.filter(function() {
                var rowText = $(this).text().toLowerCase();
                return rowText.indexOf(value) > -1;
            });
            rows.hide(); // Hide all rows initially
            matchingRows.show(); // Show matching rows
            if (matchingRows.length === 0) {
                $("#noMatchingData").show(); // Show message if no matching rows
                $("#table").hide();
            } else {
                $("#noMatchingData").hide(); // Hide message if there are matching rows
                $("#table").show();
            }
        });
    });
</script>

<?php
include "../COMMON/commonFooter.php";
?>