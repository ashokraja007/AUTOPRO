<?php
session_start();
include "../DBConnection/dbconnection.php";
include "customerHeader.php";
$uid = $_SESSION['uid'];
?>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 95%;
        margin: 10px;
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
        width: 100px;
        height: 100px;
        transition-duration: .9s;
    }

    #img:hover {
        transform: scale(1.5);
    }
</style>

<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">View</h5>
                    <h2 class="main-title">Bookings</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="customerHome.php">Home</a></li>
                    <li class="breadcrumb-item active">View Bookings</li>
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
$qry = "SELECT `booking`.*,`services`.*,`customer`.* FROM `booking`,`services`,`customer` WHERE `booking`.`uid`=`customer`.`cid` AND `booking`.`sid`=`services`.`service_id` AND `booking`.`uid`='$uid'";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Bookings Yet</h1>
    </center>
<?php
} else {
?>

    <center>
        <!-- <h1 class="m-3 bread">My Products</h1> -->
        <input type="text" class="form-control m-3" id="searchInput" style="width: 90%;" placeholder="Search...">
        <table id="table" border="1" style="width: 90%;">
            <thead>
                <tr style="text-align: center;">
                    <th>Booked By</th>
                    <th>Service Name</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>Image</th>
                    <th>Rate</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr id="row{{ forloop.counter }}" style="text-align: center;">
                        <td>
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <?php echo $row['service_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['date'] ?>
                        </td>
                        <td>
                            <?php echo $row['duration'] ?>
                        </td>
                        <td>
                            <img src="../assets/image/<?php echo $row['image'] ?>" alt="img" id="img">
                        </td>
                        <td>
                            &#8377;<?php echo $row['price'] ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == "Delivered" && $row['rating'] == "") { ?>
                                <a href="addFeedback.php?bid=<?php echo $row['booking_id'] ?>" class="btn btn-outline-success">Add Feedback</a>
                            <?php } else { ?>
                                <a class="btn btn-outline-success"> <?php echo $row['status'] ?></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div id="noMatchingData" style="display: none;">
            <h1 class="m-5">No Results Found</h1>
        </div>
    </center>
<?php } ?>



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