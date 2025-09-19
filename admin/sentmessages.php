<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Sent Messages</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body><div id="outerwrapper">
<div id="header"></div>
<div id="links">
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="index.php">HOME</a>      </li>
    <li><a href="reg_staff.php">REGISTER STAFF</a></li>
    <li><a href="view_staff.php">VIEW STAFF</a>      </li>
    <li><a href="payroll.php" class="MenuBarItemSubmenu">PAYROLL</a>
      <ul>
        <li><a href="print.php">Print Slip</a></li>
      </ul>
    </li>
    <li><a href="#" class="MenuBarItemSubmenu">MESSAGE</a>
      <ul>
<li><a href="inbox.php">Inbox</a></li>
<li><a href="sentmessages.php">Sent</a></li>
      </ul>
    </li>
    <li><a href="../logout.php">Logout</a></li>
  </ul>
</div>
<div id="body">




  <?php
//database connection
include_once('connection.php');

//view record
$qry = mysql_query("SELECT * FROM admin_outbox");
echo "<table border='1' align='center'>
<tr>
<th>Message ID</th>
<th>Sender</th>
<th>Receipient ID</th>
<th>Receipients</th>
<th>Subject</th>
<th>Message</th>
<th>Date sent</th>
</tr>";


while ($row = mysql_fetch_array($qry))
{
	echo "<tr>";
	echo "<td>" .$row['ao_id'] . "</td>";
	echo "<td>" .$row['sender'] . "</td>";
	echo "<td>" .$row['staff_id'] . "</td>";
	echo "<td>" .$row['receiver'] . "</td>";
	echo "<td>" .$row['msg_subject'] . "</td>";
	echo "<td>" .substr($row['msg_msg'],0,50) . "</td>";
	echo "<td>" .$row['sent_date'] . "</td>";
	echo "<td> <a href=messagedelete.php?staff_id=".$row['staff_id']."&ao_id=".$row['ao_id'].">Delete</a>";
	echo "<td> <a href=readmessage.php?staff_id=".$row['staff_id']."&ao_id=".$row['ao_id'].">Read Message</a>";
	echo "</tr>";
}
echo "</table>";
echo "<a href=index.php>Go Home</a> <br />";
echo "<a href=payroll.php>Calculate Payroll</a>";
?>
</div>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>