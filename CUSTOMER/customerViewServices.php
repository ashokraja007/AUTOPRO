<?php
session_start();
include "customerHeader.php";
$uid = $_SESSION['uid'];
?>

<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">View</h5>
                    <h2 class="main-title">Service</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="customerHome.php">Home</a></li>
                    <li class="breadcrumb-item active">View Service</li>
                </ul>
            </div>
            <div class="page-banner-images">
                <img src="../assets/images/about/about-2.png" alt="Page Banner">
            </div>
        </div>
    </div>
</div>
<!-- Page Banner Section End -->


<?php
include "../DBConnection/dbconnection.php";
$qry = "SELECT * FROM `services`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Data</h1>
    </center>
<?php

} else {
?>

    <div class="section ">
        <div class="container">
            <div class="section-padding-02 position-relative">

                <img class="services-shape" src="../assets/images/services.png" alt="Service">

                <!-- Section Title Start -->
                <div class="section-title text-center">
                    <h5 class="sub-title">What we do</h5>
                    <h2 class="main-title">Our Services <br> that we provide</h2>
                </div>
                <!-- Section Title End -->

                <!-- Service Wrapper Start -->
                <div class="service-wrapper">
                    <div class="row gx-lg-5">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <!-- Single Service Start -->
                                <div class="single-service" data-aos="fade-up" data-aos-delay="200">
                                    <h4 class="title"><a href="service-details.php"><?php echo $row['service_name'] ?></a>
                                    </h4>
                                    <h3 class="mt-3">&#8377; <?php echo $row['price'] ?></h3>
                                    <a href="service-details.php?sid=<?php echo $row['service_id'] ?>" class="more">Lean more</a>
                                </div>
                                <!-- Single Service End -->
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Service Wrapper End -->
            </div>
        </div>
    </div>
    <!-- Service Section End -->

<?php } ?>

<?php
include "../COMMON/commonFooter.php";
?>