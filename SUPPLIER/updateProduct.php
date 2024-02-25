<?php
session_start();
include "../DBConnection/dbconnection.php";
include "supplierHeader.php";
$uid = $_SESSION['uid'];
$pid = $_REQUEST['id'];
?>
<style>
    /* Image Upload */

    .image-upload>input {
        display: none;
    }

    #img {
        cursor: pointer;
        height: 150px;
        width: 150px;
        padding: 10px;
        border-radius: 100px;
    }

    article,
    aside,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
        display: block;
    }

    /* Image upload */
</style>


<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">Update</h5>
                    <h2 class="main-title">Products</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="supplierHome.php">Home</a></li>
                    <li class="breadcrumb-item active">Update Products</li>
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
$qry = "SELECT * FROM `product` WHERE `pdt_id`='$pid'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
?>


<!-- Login & Register Section Start -->
<div class="section section-padding">
    <div class="container">
        <!-- Register & Login Wrapper Start -->
        <div class="register-login-wrapper">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <!-- Register & Login Form Start -->
                    <div class="register-login-form">
                        <h3 class="title">Update <span>Now</span></h3>
                        <div class="form-wrapper">
                            <form method="post" enctype="multipart/form-data">
                                <div class="image-upload text-center" style="margin-bottom: 30px">
                                    <label for="file-input">
                                        <img id="img" src="../assets/image/<?php echo $row['image'] ?>" alt="Upload Image" style="margin: auto" />
                                    </label>
                                    <h3>Select Image</h3>
                                    <input id="file-input" onchange="readURL(this)" name="imgfile" type="file" />
                                </div>
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <input type="text" placeholder="Name" required name="name" value="<?php echo $row['name'] ?>">
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <input type="text" placeholder="Stock" required name="stock" value="<?php echo $row['stock'] ?>">
                                </div>
                                <div class="single-form">
                                    <input type="text" placeholder="Price" required name="price" value="<?php echo $row['price'] ?>">
                                </div>
                                <div class="single-form">
                                    <input type="text" placeholder="Manufactured By" name="mfg" required value="<?php echo $row['manufacturer'] ?>">
                                </div>
                                <div class="single-form">
                                    <textarea name="desc" id="" cols="30" required rows="5" placeholder="Description"><?php echo $row['desc'] ?></textarea>
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <button type="submit" name="update" class="btn btn-custom-01 w-100">UPDATE</button>
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


<!-- Footer Section Start -->

<?php
if (isset($_REQUEST['update'])) {
    $Name = $_REQUEST['name'];
    $Stock = $_REQUEST['stock'];
    $Price = $_REQUEST['price'];
    $Manufacturer = $_REQUEST['mfg'];
    $Desc = $_REQUEST['desc'];

    $Image = $_FILES["imgfile"]["name"];
    $tempname = $_FILES["imgfile"]["tmp_name"];
    $folder = "image/" . $Image;

    if (!empty($Image)) {
        if (move_uploaded_file($tempname, '../assets/image/' . $Image)) {
            $qryAdd = "UPDATE `product` SET `name`='$Name',`stock`='$Stock',`price`='$Price',`desc`='$Desc',`image`='$Image',`manufacturer`='$Manufacturer' WHERE `pdt_id`='$pid'";
            echo $qryAdd;
            if ($conn->query($qryAdd) == TRUE) {
                echo "<script>alert('Product Updated');window.location = 'singleProduct.php?id=$pid';</script>";
            } else {
                // echo "Error: " . mysqli_error($conn);
                // echo "<script>alert('Failed');window.location = 'updateProduct.php?id=$pid';</script>";
            }
        } else {
            echo "Error:" . mysqli_error($conn);
        }
    } else {
        $qryAdd = "UPDATE `product` SET `name`='$Name',`stock`='$Stock',`price`='$Price',`desc`='$Desc',`manufacturer`='$Manufacturer' WHERE `pdt_id`='$pid'";
        echo $qryAdd;
        if ($conn->query($qryAdd) == TRUE) {
            echo "<script>alert('Product Updated');window.location = 'singleProduct.php?id=$pid';</script>";
        } else {
            echo "Error:" . mysqli_error($conn);
        }
    }
}
?>

<?php
include "../COMMON/commonFooter.php";
?>