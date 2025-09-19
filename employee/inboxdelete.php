<?php 
include('../admin/connection.php');
include('../sanitise.php');
$id = sanitise($_GET['id']);
$qry = ("DELETE FROM staff_inbox WHERE id = '$id'");
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
