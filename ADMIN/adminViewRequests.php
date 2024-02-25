<?php
include "adminHeader.php";
include "../DBConnection/dbconnection.php";
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
</style>

<!-- Page Banner Section Start -->
<div class="section page-banner-section mb-5" style="background-image: url(../assets/images/page-banner-bg.png);">
    <div class="container">
        <div class="page-banner-wrapper">
            <div class="page-banner-content">
                <div class="section-title">
                    <h5 class="sub-title">View</h5>
                    <h2 class="main-title">Requests</h2>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
                    <li class="breadcrumb-item active">View Requests</li>
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
$qry = "SELECT `requests`.*,`employee`.* FROM `requests`,`employee` WHERE `employee`.`emp_id`=`requests`.`emp_id`";
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
        <h1 class="m-3 bread">Spare Parts Requests</h1>
        <input type="text" class="form-control" id="searchInput" style="width: 98%;" placeholder="Search...">
        <table id="table" border="1" style="width: 98%;">
            <thead>
                <tr style="text-align: center;">
                    <th>Name</th>
                    <th>Model</th>
                    <th>Quantity</th>
                    <th>Remarks</th>
                    <th>Requested By</th>
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
                            <?php echo $row[2] ?>
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
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <?php echo $row['date'] ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == "Requested") { ?>
                                <a class="btn btn-success" href="managePartsRequests.php?rid=<?php echo $row['req_id'] ?>&status=Approved">Approve</a>
                                <a class="btn btn-danger" href="managePartsRequests.php?rid=<?php echo $row['req_id'] ?>&status=Rejected">Reject</a>
                            <?php } else {
                                echo "<p style='font-weight:bolder'>{$row['status']}</p>";
                            }
                            ?>
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