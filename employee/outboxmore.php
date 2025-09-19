<?php
include('../admin/connection.php');
include('../sanitise.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}
$staff_id = $_SESSION['staff_id'];
$so_id = sanitise($_GET['so_id']);
$qry = "SELECT * FROM staff_outbox WHERE so_id = '$so_id'";
$run = mysql_query($qry);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/staff.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="outerwrapper">
<div id="header"><img src="../images/staffhead.jpg" /></div>
<div id="links"><?php include('link.php'); ?></div>
<div id="body">
<table width="100%" border="1" align="center">
  <tr>   <?php while ($row = mysql_fetch_array($run)) { ?>
    <td width="198">&nbsp;</td>
    <td width="105"><strong>Receiver ID</strong></td>
    <td width="463">&nbsp;<?php echo $row['staff_id'];?></td>
    <td width="120">&nbsp;</td>
    <td width="80">&nbsp;</td>
  </tr>
  <tr> 

    <td>&nbsp;</td>
    <td><strong>Receiver Name</strong></td>
    <td>&nbsp;<?php echo $row['receiver'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Subject</strong></td>
    <td>&nbsp;<?php echo $row['msg_subject'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Message</strong></td>
    <td>&nbsp;<?php echo stripslashes($row['msg_msg']);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
</table>
</div>
</div>

</body>
</html>