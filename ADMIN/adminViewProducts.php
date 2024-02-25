<?php
include "adminHeader.php";
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

    /* tr:nth-child(even) {
        background-color: #dddddd;
    } */
    #img {
        width: 150px;
        height: 150px;
        border-radius: 10px;
    }
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">

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
                    <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                    <li class="breadcrumb-item active">View Products</li>
                </ul>
            </div>
            <div class="page-banner-images">
                <img src="../assets/images/page-banner-4.png" alt="Page Banner">
            </div>
        </div>
    </div>
</div>
<!-- Page Banner Section End -->


<?php
include "../DBConnection/dbconnection.php";
$qry = "SELECT * FROM `product`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Products Available</h1>
    </center>
<?php

} else {
?>

    <center>
        <!-- <h1 class="m-3 bread">&nbsp;</h1> -->
        <input type="text" class="form-control" id="searchInput" style="width: 98%;" placeholder="Search...">
        <table id="table" border="1" style="width: 98%;">
            <thead>
                <tr style="text-align: center;">
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Manufacturer</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                $counter = 1; // Initialize a counter for dynamic IDs
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr id="row{{ forloop.counter }}" style="text-align: center;">
                        <td>
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <?php echo $row['stock'] ?>
                        </td>
                        <td>
                            &#8377;<?php echo $row['price'] ?>
                        </td>
                        <td>
                            <?php echo $row['manufacturer'] ?>
                        </td>
                        <td>
                            <?php echo $row['desc'] ?>
                        </td>
                        <td>
                            <img src="../assets/image/<?php echo $row['image'] ?>" alt="" id="img">
                        </td>
                        <td>
                            <?php
                            if ($row['stock'] > 0) {
                            ?>
                                <button onclick="document.getElementById('id0<?php echo $counter ?>').style.display='block'" class="btn btn-custom-01">Buy</button></a>
                            <?php
                            } else { ?>
                                <h3 class="text-danger" style="white-space: nowrap;">Out Of Stock</h3>
                            <?php } ?>
                        </td>
                        <div class="w3-container">
                            <div id="id0<?php echo $counter ?>" class="w3-modal">
                                <div class="w3-modal-content w3-animate-top w3-card-4" style="border-radius: 10px;">
                                    <header class="w3-container" style="background-color: #1346E2;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                        <span onclick="document.getElementById('id0<?php echo $counter ?>').style.display='none'" class="w3-button w3-display-topright" style="border-top-right-radius: 10px;">&times;</span>
                                        <h2 style="color: white;">Enter Quantity</h2>
                                    </header>
                                    <div class="w3-container" style="width: 300px;">
                                        <form method="post" class="m-3">
                                            <div class="single-form">
                                                <input type="number" min="1" max="<?php echo $row['stock'] ?>" name="qty" required placeholder="Quantity">
                                                <input type="hidden" name="pid" value="<?php echo $row['pdt_id'] ?>">
                                                <input type="hidden" name="price" value="<?php echo $row['price'] ?>">
                                                <input type="hidden" name="sid" value="<?php echo $row['sid'] ?>">
                                                <input type="hidden" name="stock" value="<?php echo $row['stock'] ?>">
                                            </div>
                                            <div class="single-form mt-3">
                                                <button type="submit" name="paynow" class="btn btn-custom-01 w-100 mb-5">Pay Now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </tr>
                <?php
                    $counter++; // Increment the counter
                }
                ?>
            </tbody>
        </table>
        <div id="noMatchingData" style="display: none;">
            <h1 class="m-5">No Results Found</h1>
        </div>
    </center>
<?php }
?>

<?php
if (isset($_REQUEST['paynow'])) {
    $Qty = $_REQUEST['qty'];
    $Pid = $_REQUEST['pid'];
    $Price = $_REQUEST['price'];
    $Sid = $_REQUEST['sid'];
    $Stock = $_REQUEST['stock'];
    echo "<script>window.location='../ADMIN/CreditCardForm.php?qty=$Qty&pid=$Pid&price=$Price&sid=$Sid&stock=$Stock';</script>";
}
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