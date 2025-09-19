<?php 
include('connection.php');
include('../sanitise.php');
$staff_id = sanitise($_GET['staff_id']);
$qry = ("DELETE FROM register_staff WHERE staff_id = '$staff_id'");
$qry1 = ("DELETE FROM salary WHERE staff_id = '$staff_id'");
$con = mysql_query($qry) or die(mysql_error());
$con1 = mysql_query($qry1) or die(mysql_error());
if((!$con) && (!$con1))
{
	echo "not deleted successfully";
	echo "<a href = view_staff.php>Go Back</a>";
}

else
{
	echo "staff has been successfully deleted";
	echo "<a href = view_staff.php>Go Back Home</a>";
}
?>
