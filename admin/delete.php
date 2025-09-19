<?php 
include('connection.php');
include('../sanitise.php');

$staff_id = sanitise($_GET['staff_id']); // will use global $conn from sanitise.php

$qry  = "DELETE FROM register_staff WHERE staff_id = '$staff_id'";
$qry1 = "DELETE FROM salary WHERE staff_id = '$staff_id'";

$con  = $conn->query($qry);
$con1 = $conn->query($qry1);

if(!$con || !$con1) {
    echo "Not deleted successfully: " . $conn->error;
    echo "<br><a href='view_staff.php'>Go Back</a>";
} else {
    echo "Staff has been successfully deleted";
    echo "<br><a href='view_staff.php'>Go Back Home</a>";
}
?>
