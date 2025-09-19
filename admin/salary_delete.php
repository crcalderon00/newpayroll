<?php 
include('connection.php');
include('../sanitise.php');

$salary_id = sanitise($_GET['salary_id']);
$staff_id  = sanitise($_GET['staff_id']);

$qry = "DELETE FROM salary WHERE salary_id = '$salary_id' AND staff_id = '$staff_id'";
$result = mysqli_query($conn, $qry);

if(!$result){
    echo "Not deleted successfully: " . mysqli_error($conn);
    echo "<br><a href='view_staff.php'>Go Back</a>";
} else {
    echo "Staff has been successfully deleted";
    echo "<br><a href='view_staff.php'>Go Back Home</a>";
}
?>
