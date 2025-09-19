<?php
include('admin/connection.php');
include('sanitise.php');
session_start();

if(!isset($_POST['staff_id']) || !isset($_POST['newpassword'])) {
    die("Required data missing.");
}

$staff_id = sanitise($_POST['staff_id'], $conn);
$password = sanitise($_POST['newpassword'], $conn);

$qry = $conn->query("UPDATE register_staff SET password = '$password' WHERE staff_id = '$staff_id'");

if($qry) {
    echo "Password reset successful";
} else {
    echo "Password reset failed: " . $conn->error;
}
?>
