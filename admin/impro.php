<?php
if(isset($_POST['submit'])){
include('connection.php');
include('../sanitise.php');
//admin name
$sender = sanitise($_POST['from']);
//sent to staff id n receiver
$staff_id= sanitise($_POST['staff_id']);
$receiver = sanitise($_POST['fname']);
//message subject
$subject = sanitise($_POST['subject']);
//message
$message = sanitise($_POST['message']);

if (isset($_POST['submit']))
	{
		$insert = "INSERT INTO admin_outbox(staff_id, sender, receiver, msg_subject, msg_msg) VALUES ('$staff_id', '$sender', '$receiver', '$subject', '$message')";
		$insert2 = mysql_query($insert) or die(mysql_error());
		
		$insert3 =  "INSERT INTO staff_inbox(staff_id, sender, receiver, msg_subject, msg_msg) VALUES ('$staff_id', '$sender', '$receiver', '$subject', '$message')";
		$insert4 = mysql_query($insert3) or die(mysql_error());

			if (($insert2) && ($insert4))
				{
					echo "message sent";
					header('Location: sentmessages.php');
				}
			else
				{
					echo "message not sent";
				}

	}
}
?>
