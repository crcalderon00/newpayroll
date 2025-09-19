<?php
include('connection.php');
include('../sanitise.php');

$staff_id   = sanitise($_POST['staff_id']);
$fname      = sanitise($_POST['fname']);
$department = sanitise($_POST['department']);
$position   = sanitise($_POST['position']);
$years      = sanitise($_POST['years']);
$grade      = sanitise($_POST['grade']);

$qry = "UPDATE register_staff 
        SET fname = '$fname', 
            department = '$department', 
            position = '$position', 
            years = '$years', 
            grade = '$grade' 
        WHERE staff_id = '$staff_id'";

$run = $conn->query($qry);

if ($run) {
    echo "Staff $fname update has been completed successfully";
    echo "<br><a href='/newpayroll/admin/view_staff.php'> Home </a>";
} else {
    echo "Update not successful: " . $conn->error;
}
?>
