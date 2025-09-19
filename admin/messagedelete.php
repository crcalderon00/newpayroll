<?php 
include('connection.php');
include('../sanitise.php');
$staff_id = sanitise($_GET['staff_id']);
$id = sanitise($_GET['ao_id']);
$qry = ("DELETE FROM admin_outbox WHERE staff_id = '$staff_id' AND ao_id = '$id'");
$con = mysql_query($qry) or die(mysql_error());
if(!$con)
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
