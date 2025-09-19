<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}

include('connection.php');
include('../sanitise.php');
$id = sanitise($_GET['ao_id']);
$staff_id = sanitise($_GET['staff_id']);
$qry =("SELECT * FROM admin_outbox WHERE ao_id = '$id' AND staff_id = '$staff_id'");
$update = mysql_query($qry) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin - Sent Messages</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="outerwrapper">
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
<table width="593" border="1" align="center">
  <tr>
    <td width="82"><strong>Message ID</strong></td>
    <td width="495"><?php echo $row_update['ao_id']; ?></td>
  </tr>
  <tr>
    <td><strong>Date Sent</strong></td>
    <td><?php echo $row_update['sent_date']; ?></td>
  </tr>
  <tr>
    <td><strong>Sent to</strong></td>
    <td><?php echo $row_update['receiver']; ?></td>
  </tr>
  <tr>
    <td><strong>Subject</strong></td>
    <td><?php echo $row_update['msg_subject']; ?></td>
  </tr>
  <tr>
    <td><strong>Message</strong></td>
    <td><?php echo $row_update['msg_msg']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>