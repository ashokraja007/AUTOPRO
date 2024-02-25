<?php
session_start();
include "../DBConnection/dbconnection.php";
include "supplierHeader.php";
$uid = $_SESSION['uid'];
$pid = $_REQUEST['id'];
?>
<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">SUPPLIER</h5>
                    <h2 class="main-title">PRODUCT DETAILS</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="supplierHome.php">Home</a></li>
                    <li class="breadcrumb-item active">Product Details</li>
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
$qry = "SELECT * FROM `product` WHERE `pdt_id`='$pid'";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Products Added</h1>
    </center>
<?php

} else {
    $row = mysqli_fetch_array($result)
?>

    <div class="section section-padding">
        <div class="container">
            <!-- Shop Wrapper Start -->
            <div class="shop-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Product Details Start -->
                        <div class="product-details">
                            <div class="row gx-lg-0">
                                <div class="col-md-5">
                                    <!-- Product Details Image Start -->
                                    <div class="product-details-image product-details-active">
                                        <span class="lable">25%</span>
                                        <div class="swiper-container">
                                            <div class="swiper-wrapperr">
                                                <div class="swiper-slide">
                                                    <img src="../assets/image/<?php echo $row['image'] ?>" alt="Product Details">
                                                </div>
                                                <!-- <div class="swiper-slide">
                                                    <img src="../assets/images/shop/product-details-02.jpg" alt="Product Details">
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="../assets/images/shop/product-details-03.jpg" alt="Product Details">
                                                </div> -->
                                            </div>
                                            <!-- <div class="swiper-button-prev"><i class="icofont-rounded-left"></i></div> -->
                                            <!-- <div class="swiper-button-next"><i class="icofont-rounded-right"></i></div> -->
                                        </div>
                                    </div>
                                    <!-- Product Details Image End -->
                                </div>
                                <div class="col-md-7">
                                    <!-- Product Details Content Start -->
                                    <div class="product-details-content">
                                        <h3 class="title"><?php echo $row['name'] ?></h3>
                                        <div class="price-rating">
                                            <div class="price">
                                                <span class="sale-price">&#8377; <?php echo $row['price'] ?></span>
                                                <span class="regular-price"><?php $a = $row['price'] + 300;
                                                                            echo $a; ?></span>
                                            </div>
                                            <!-- <div class="rating">
                                                <div class="rating-star">
                                                    <div class="star" style="width: 60%;"></div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <p>
                                            <?php echo $row['desc'] ?>
                                        </p>
                                        <div class="product-label">
                                            <div class="single-label">
                                                <p>Stock: <span><?php echo $row['stock'] ?></span></p>
                                            </div>
                                            <!-- <div class="single-label">
                                                <p>SKU: <span>3FRF54V7</span></p>
                                            </div> -->
                                        </div>
                                        <div class="product-quantity-action">
                                            <div class="product-quantity d-inline-flex">
                                                <a href="updateProduct.php?id=<?php echo $row['pdt_id'] ?>" class="btn btn-custom-01">UPDATE</a>
                                                <!-- <input type="text" name="count" value="1" /> -->
                                                <!-- <button type="button" class="add">+</button> -->
                                            </div>
                                            <!-- <ul class="product-action">
                                                <li><button data-bs-tooltip="tooltip" data-bs-placement="top" title="Add to Cart"><i class="icofont-shopping-cart"></i></button></li>
                                                <li><button data-bs-tooltip="tooltip" data-bs-placement="top" title="Add to wishlist"><i class="fa fa-heart-o"></i></button></li>
                                                <li><button data-bs-tooltip="tooltip" data-bs-placement="top" title="Add to compare"><i class="fa fa-random"></i></button></li>
                                            </ul> -->
                                        </div>
                                        <div class="product-categories-tags">
                                            <div class="product-categories">
                                                <span class="label">Manufacturer:</span>
                                                <ul>
                                                    <li><?php echo $row['manufacturer'] ?></li>
                                                    <!-- <li><a href="#">Repari</a></li>
                                                    <li><a href="#">Servicing</a></li> -->
                                                </ul>
                                            </div>
                                            <!-- <div class="product-tags">
                                                <span class="label">tags:</span>
                                                <ul>
                                                    <li><a href="#">Auto Servicing</a></li>
                                                </ul>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- Product Details Content End -->
                                </div>
                            </div>
                        </div>
                        <!-- Product Details End -->
                    </div>
                </div>
            </div>
            <!-- Shop Wrapper End -->
        </div>
    </div>

<?php } ?>
<?php
include "../COMMON/commonFooter.php";
?>