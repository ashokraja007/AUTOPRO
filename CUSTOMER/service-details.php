<?php
session_start();
include "customerHeader.php";
$uid = $_SESSION['uid'];
$sid = $_REQUEST['sid'];
?>
<?php
include "../DBConnection/dbconnection.php";
$qry = "SELECT services.*, booking.* FROM services JOIN booking ON services.service_id = booking.sid WHERE services.service_id = '$sid' AND booking.rating IS NOT NULL AND booking.rating <> ''";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Data</h1>
    </center>
<?php

} else {
    $row = mysqli_fetch_array($result)
?>

    <!-- Page Banner Section Start -->
    <div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
        <div class="container">
            <div class="page-banner-wrapper">
                <div class="page-banner-content">
                    <div class="section-title">
                        <h5 class="sub-title">View</h5>
                        <h2 class="main-title">
                            <?php echo $row['service_name'] ?>
                        </h2>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="customerHome.php">Home</a></li>
                        <li class="breadcrumb-item active">Services</li>
                        <li class="breadcrumb-item active">Services Details</li>
                    </ul>
                </div>
                <div class="page-banner-images">
                    <img src="../assets/images/about/about-2.png" alt="Page Banner">
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->


    <div class="section section-padding">
        <div class="container">
            <!-- Service Details Wrapper Start -->
            <div class="service-details-wrapper">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <!-- Service Details Content Start -->
                        <div class="service-details-content">
                            <div class="details-image">
                                <img src="../assets/image/<?php echo $row['image'] ?>" alt="Service">
                            </div>
                            <h2 class="title">
                                <?php echo $row['service_name'] ?>
                            </h2>
                            <p>
                                <?php echo $row['description'] ?>
                            </p>
                            <div style="white-space: nowrap;">
                                <h2 class="title" style="display: inline-block;">Service Cost: &#8377;
                                    <?php echo $row['price'] ?>
                                </h2>
                                <span style="display: inline-block;color:red"><sup>(*Labor Cost Excluded)</sup></span>
                            </div>
                            <h2 class="title">Duration:
                                <?php echo $row['duration'] ?>
                            </h2>
                        </div>
                        <!-- <a href="updateService.php?sid=<?php echo $row['service_id'] ?>" class="btn btn-custom-01 mt-5">UPDATE SERVICE</a> -->
                        <a class="btn btn-custom-01 mt-5" href="bookService.php?sid=<?php echo $row['service_id'] ?>">Book
                            Now</a>
                        <!-- Service Details Content End -->
                    </div>
                </div>
            </div>
            <!-- Service Details Wrapper End -->
        </div>
    </div>
    <!-- Service Details Section End -->
<?php } ?>

<?php
$qry1 = "SELECT services.*, booking.*, customer.*
FROM services
JOIN booking ON services.service_id = booking.sid
JOIN customer ON booking.uid = customer.cid
WHERE services.service_id = '$sid' AND booking.rating IS NOT NULL AND booking.rating <> ''";
$result1 = mysqli_query($conn, $qry1);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Data</h1>
    </center>
<?php

} else {
    $row = mysqli_fetch_array($result)
?>
    <center>
        <h1>Ratings & Reviews</h1>
    </center>
    <!-- Service Wrapper Start -->
    <div class="service-wrapper">

        <div class="row gx-lg-5">
            <?php
            while ($row1 = mysqli_fetch_array($result1)) {
            ?>
                <div class="col-lg-4 col-sm-6">
                    <!-- Single Service Start -->
                    <div class="single-service" data-aos="fade-up" data-aos-delay="200">
                        <h4>
                            <?php echo $row1['name'] ?>
                        </h4>
                        <h3 class="title">
                            <?php echo $row1['feedback'] ?>
                        </h3>
                        <center>
                            <?php
                            if ($row1['rating'] == 1) {
                            ?>
                                <h3 class="mt-3">⭐</h3>
                            <?php } else if ($row1['rating'] == 2) {
                            ?>
                                <h3 class="mt-3">⭐⭐</h3>
                            <?php } else if ($row1['rating'] == 3) {
                            ?>
                                <h3 class="mt-3">⭐⭐⭐</h3>
                            <?php } else if ($row1['rating'] == 4) {
                            ?>
                                <h3 class="mt-3">⭐⭐⭐⭐</h3>
                            <?php } else if ($row1['rating'] == 5) {
                            ?>
                                <h3 class="mt-3">⭐⭐⭐⭐⭐</h3>
                            <?php }
                            ?>
                        </center>
                    </div>
                    <!-- Single Service End -->
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Service Wrapper End -->
<?php } ?>

<?php
include "../COMMON/commonFooter.php";
?>