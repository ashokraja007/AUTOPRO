<?php
session_start();
include "employeeHeader.php";
include "../DBConnection/dbconnection.php";
$uid = $_SESSION['uid'];
$sid = $_REQUEST['sid'];
$qry = "SELECT * FROM `services` WHERE `service_id`='$sid'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result)
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
                    <h2 class="main-title">Service</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="employeeHome.php">Home</a></li>
                    <li class="breadcrumb-item active">Update Service</li>
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
                        <h3 class="title">Add <span>Now</span></h3>
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
                                    <input type="text" value="<?php echo $row['service_name'] ?>" placeholder="Service Name" required name="name">
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <input type="text" value="<?php echo $row['duration'] ?>" placeholder="Duration" required name="duration">
                                </div>
                                <div class="single-form">
                                    <input type="text" placeholder="Price" value="<?php echo $row['price'] ?>" required name="price">
                                </div>
                                <div class="single-form">
                                    <input type="text" placeholder="Labor Cost" value="<?php echo $row['labor_cost'] ?>" name="laborcost" required>
                                </div>
                                <div class="single-form">
                                    <textarea name="desc" id="" cols="30" required rows="5" placeholder="Description"><?php echo $row['description'] ?></textarea>
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <button type="submit" name="add" class="btn btn-custom-01 w-100">Update</button>
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
    $Duration = $_REQUEST['duration'];
    $Price = $_REQUEST['price'];
    $LaborCost = $_REQUEST['laborcost'];
    $Desc = $_REQUEST['desc'];

    $Image = $_FILES["imgfile"]["name"];
    $tempname = $_FILES["imgfile"]["tmp_name"];
    $folder = "image/" . $Image;
    if (move_uploaded_file($tempname, '../assets/image/' . $Image)) {
        $qryAdd = "UPDATE `services` SET `service_name`='$Name',`description`='$Desc',`duration`='$Duration',`price`='$Price',`labor_cost`='$LaborCost',`image`='$Image' WHERE `service_id`='$sid'";
        if ($conn->query($qryAdd) == TRUE) {
            echo "<script>alert('Service Updated');window.location = 'service-details.php?sid=$sid';</script>";
        } else {
            // echo "Error: " . mysqli_error($conn);
            echo "<script>alert('Failed');window.location = 'updateService.php';</script>";
        }
    } else {
        echo "Error:" . mysqli_error($conn);
    }
}


?>



<?php
include "../COMMON/commonFooter.php";
?>