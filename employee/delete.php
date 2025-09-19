<?php 
include('../admin/connection.php');
include('../sanitise.php');
$so_id = sanitise($_GET['so_id']);
$qry = ("DELETE FROM staff_outbox WHERE so_id = '$so_id'");
$con = mysql_query($qry) or die(mysql_error());
if(!$con)
{
	echo "not deleted successfully";
	echo "<br />";
	echo "<a href = inbox.php>Go Back</a>";
}

else
{
	echo "Message has been successfully deleted";
	echo "<br />";
	echo "<a href = inbox.php>Back to inbox</a>";
}
?>
