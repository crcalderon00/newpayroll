<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}


$staff_id = $_SESSION['staff_id'];
$qry = mysql_query("SELECT * FROM register_staff WHERE staff_id = '$staff_id'");

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
<div id="links">
  <?php include('link.php'); ?>
</div>
<div id="body">
  <table width="410" border="1" align="center" cellpadding="5" cellspacing="3">
    <tr><?php while ($tbl = mysql_fetch_array($qry)) { ?>
    <td width="120"><strong>Staff ID</strong></td>
    <td width="271"><?php echo $tbl['staff_id'];?></td>
    </tr>
  <tr>
    <td><strong>Name</strong></td>
    <td><?php echo $tbl['fname']; ?></td>
    </tr>
  <tr>
    <td><strong>Sex</strong></td>
    <td><?php echo $tbl['sex']; ?></td>
    </tr>
  <tr>
    <td><strong>Birthday</strong></td>
    <td><?php echo $tbl['birthday']; ?></td>
    </tr>
  <tr>
    <td><strong>Position</strong></td>
    <td><?php echo $tbl['position']; ?></td>
    </tr>
  <tr>
    <td><strong>Department</strong></td>
    <td><?php echo $tbl['department']; ?></td>
    </tr>
  <tr>
    <td><strong>Grade</strong></td>
    <td><?php echo $tbl['grade']; ?></td>
    </tr>
  <tr>
    <td><strong>Years Spent</strong></td>
    <td><?php echo $tbl['years']; ?></td>
    </tr>
  <tr>
    <td><strong>Date Registered</strong></td>
    <td><?php echo $tbl['date_registered']; ?></td>
    </tr>
  <?php } ?>
</table>
</div>
</div>

</body>
</html>