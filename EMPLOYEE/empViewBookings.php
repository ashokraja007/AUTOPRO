<?php
session_start();
include "../DBConnection/dbconnection.php";
include "employeeHeader.php";
$uid = $_SESSION['uid'];
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
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
                    <li class="breadcrumb-item"><a href="employeeHome.php">Home</a></li>
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
$qry = "SELECT `booking`.*,`services`.*,`customer`.*,`employee`.`email` AS emp_mail FROM `booking`,`services`,`customer`,`employee` WHERE `booking`.`uid`=`customer`.`cid` AND `booking`.`sid`=`services`.`service_id` AND `employee`.`emp_id`='$uid'";
$result = mysqli_query($conn, $qry);
// echo $qry;
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Orders Yet</h1>
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
                $counter = 1; // Initialize a counter for dynamic IDs
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr id="row<?php echo $counter; ?>" style="text-align: center;">
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
                            <?php if ($row['status'] == "Delivered") { ?>
                                <a title="Vehicle Delivered" class="btn btn-outline-success">
                                    <?php echo $row['status'] ?> </a>
                            <?php } else { ?>
                                <a title="Click To Update" onclick="document.getElementById('id0<?php echo $counter ?>').style.display='block'" class="btn btn-outline-success">
                                    <?php echo $row['status'] ?> </a>
                            <?php } ?>
                        </td>
                        <div class="w3-container">
                            <div id="id0<?php echo $counter ?>" class="w3-modal">
                                <div class="w3-modal-content w3-animate-top w3-card-4">
                                    <header class="w3-container w3-teal">
                                        <span onclick="document.getElementById('id0<?php echo $counter ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <h2 style="color: white;">Update Status</h2>
                                    </header>
                                    <div class="w3-container">
                                        <?php if ($row['status'] == "Booked") { ?>
                                            <a href="updateStatus.php?status=<?php echo $row['status'] ?>&id=<?php echo $row['booking_id'] ?>&name=<?php echo $row['name'] ?>&uemail=<?php echo $row['email'] ?>&emp_mail=<?php echo $row['emp_mail'] ?>&model=<?php echo $row['vehicle_model'] ?>" class="btn btn-outline-primary m-3">
                                                Diagnosed </a>
                                        <?php } else if ($row['status'] == "Diagnosed") { ?>
                                            <a href="updateStatus.php?status=<?php echo $row['status'] ?>&id=<?php echo $row['booking_id'] ?>&name=<?php echo $row['name'] ?>&uemail=<?php echo $row['email'] ?>&emp_mail=<?php echo $row['emp_mail'] ?>&model=<?php echo $row['vehicle_model'] ?>" class="btn btn-outline-primary m-3">
                                                Repaired </a>
                                        <?php } else if ($row['status'] == "Repaired") { ?>
                                            <a href="updateStatus.php?status=<?php echo $row['status'] ?>&id=<?php echo $row['booking_id'] ?>&name=<?php echo $row['name'] ?>&uemail=<?php echo $row['email'] ?>&emp_mail=<?php echo $row['emp_mail'] ?>&model=<?php echo $row['vehicle_model'] ?>" class="btn btn-outline-primary m-3">
                                                Delivered </a>
                                        <?php } else {
                                            echo "Error Occurred: {$row['status']}";
                                        } ?>
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
<?php } ?>

<script>
    function sendServiceStatusEmail(email, name, vehicle, status) {
        var subject = "Service Status Update for Your Vehicle";
        var body = "Dear " + name + ",\n\n";
        body += "I hope this email finds you well. We wanted to provide you with an update on the status of your vehicle, a " + vehicle + ".\n\n";

        if (status === "Diagnosed") {
            body += "After a thorough diagnosis, we have identified the issues with your vehicle and are now proceeding with the necessary repairs.\n\n";
        } else if (status === "Repaired") {
            body += "Great news! Your vehicle has been successfully repaired and is ready for pickup.\n\n";
        } else if (status === "Delivered") {
            body += "Your vehicle has been delivered to your specified location. It's now ready for you to use.\n\n";
        } else {
            body += "We apologize, but there has been an error in updating your vehicle's status. Please contact us for further information.\n\n";
        }

        body += "If you have any questions or require additional details, please do not hesitate to contact us. We are here to assist you with any concerns you may have.\n\n";
        body += "Thank you for choosing our car workshop, and we look forward to continuing to serve your automotive needs.";

        var mailtoLink = "mailto:" + email + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);

        // Open the user's default email client with the pre-filled email body
        window.location.href = mailtoLink;
    }
</script>




<!-- Include Bootstrap JS and jQuery -->
<script src=" https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
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
                $("#noMatchingData")
                    .hide(); // Hide message if there are matching rows
                $("#table").show();
            }
        });
    });
</script>


<?php
include "../COMMON/commonFooter.php";
?>