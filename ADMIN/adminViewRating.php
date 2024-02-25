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

<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">View</h5>
                    <h2 class="main-title">Feedbacks</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                    <li class="breadcrumb-item active">View Feedbacks</li>
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
$qry = "SELECT `booking`.*,`customer`.`name` FROM `booking`,`customer` WHERE `booking`.`rating`!='no rating' AND `customer`.`cid`=`booking`.`uid`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Reviews Yet</h1>
    </center>
<?php

} else {
    $row = mysqli_fetch_array($result);
?>

    <center>
        <!-- <h1 class="m-3 bread">&nbsp;</h1> -->
        <input type="text" class="form-control" id="searchInput" style="width: 98%;" placeholder="Search...">
        <table id="table" border="1" style="width: 98%;">
            <thead>
                <tr style="text-align: center;">
                    <th>Customer Name</th>
                    <th>Feedback</th>
                    <th>Rating</th>
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
                            <?php echo $row["feedback"] ?>
                        </td>
                        <td>
                            <?php echo $row['rating'] ?>⭐
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