<?php
include('admin/connection.php');  // assumes this sets $conn as mysqli connection
include('sanitise.php');

$staff_id = sanitise($_POST['staff_id'], $conn);
$password = sanitise($_POST['newpassword'], $conn);

// Use mysqli_query instead of mysql_query
$qry = mysqli_query($conn, "UPDATE register_staff SET password = '$password' WHERE staff_id = '$staff_id'");

if ($qry) {
    echo "Password reset successful";
} else {
    echo "Not successful: " . mysqli_error($conn);
}
?>
