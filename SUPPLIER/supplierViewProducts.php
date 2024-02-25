<?php
session_start();
include "../DBConnection/dbconnection.php";
include "supplierHeader.php";
$uid = $_SESSION['uid'];
?>

<style>
    #img {
        height: 350px;
    }
</style>

<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">View</h5>
                    <h2 class="main-title">Products</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="supplierHome.php">Home</a></li>
                    <li class="breadcrumb-item active">View Products</li>
                </ul>
            </div>
            <div class="page-banner-images">
                <img src="../assets/images/spare.png" alt="Page Banner">
            </div>
        </div>
    </div>
</div>
<!-- Page Banner Section End -->

<?php
include "../DBConnection/dbconnection.php";
$qry = "SELECT * FROM `product` WHERE `sid`='$uid'";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Products Added</h1>
    </center>
<?php

} else {
?>


    <!-- Shop Section Start -->
    <div class="section section-padding">
        <div class="container">
            <!-- Shop Wrapper Start -->
            <div class="shop-wrapper">
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <div class="col-lg-4 col-sm-6">
                            <!-- Single Product Start -->
                            <div class="single-product" data-aos="fade-up" data-aos-delay="200">
                                <div class="product-image">
                                    <!-- <span class="lable">25%</span> -->
                                    <a><img src="../assets/image/<?php echo $row['image'] ?>" id="img" alt="Product"></a>
                                    <ul class="product-action">
                                        <!-- <li><button data-bs-tooltip="tooltip" data-bs-placement="top" title="Add to Cart"><i class="icofont-shopping-cart"></i></button></li> -->
                                        <li><button data-bs-tooltip="tooltip" data-bs-placement="top" title="Quick View" data-bs-toggle="modal" data-bs-target="#quickview"><a href="singleProduct.php?id=<?php echo $row['pdt_id'] ?>"> <i class="icofont-eye"></i></a></button></li>
                                        <!-- <li><button data-bs-tooltip="tooltip" data-bs-placement="top" title="Add to wishlist"><i class="fa fa-heart-o"></i></button></li> -->
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <h3 class="name" style="white-space: nowrap;"><a href="singleProduct.php?id=<?php echo $row['pdt_id'] ?>"><?php echo $row['name'] ?></a>
                                    </h3>
                                    <div class="price">
                                        <span class="sale-price">&#8377; <?php echo $row['price'] ?></span>
                                        <!-- <span class="regular-price">$350</span> -->
                                    </div>
                                    <!-- <hr>
                                    <div class="price">
                                        <span class="sale-price"><?php echo $row['desc'] ?></span>
                                    </div> -->
                                </div>
                            </div>
                            <!-- Single Product End -->
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Shop Wrapper End -->
        </div>
    </div>
    <!-- Shop Section End -->

<?php } ?>

<?php
include "../COMMON/commonFooter.php";
?>