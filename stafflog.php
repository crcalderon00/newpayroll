<?php
include('admin/connection.php');
include('sanitise.php');
$staff_id = sanitise($_POST['staff_id']);
$username = sanitise($_POST['username']);
$password = sanitise($_POST['password']);

$qry = mysql_query("SELECT * FROM register_staff WHERE staff_id = '$staff_id' AND username = '$username' AND password = '$password'");
$count = mysql_num_rows($qry);
if($count==1)
{
	session_start();
	$_SESSION['staff_id'] = $staff_id;
	header('Location: employee/index.php');
}
else
{
	echo "invalid login";
}

?>