<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}


$staff_id = $_SESSION['staff_id'];
$qry = mysql_query("SELECT * FROM salary WHERE staff_id = '$staff_id'");

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
<table width="1000" border="1" align="center">
  <tr>
    <td width="121"><strong>Month</strong></td>
    <td width="92"><strong>Basic</strong></td>
    <td width="77"><strong>Meal</strong></td>
    <td width="87"><strong>Housing</strong></td>
    <td width="112"><strong>Transport</strong></td>
    <td width="100"><strong>Entertainment</strong></td>
    <td width="102"><strong>Housing</strong></td>
    <td width="96"><strong>Long Service</strong></td>
    <td width="76"><strong>Tax</strong></td>
    <td width="73"><strong>Net Pay</strong></td>
    </tr>
  <tr><?php while ($tbl = mysql_fetch_array($qry)) { ?>
    <td><?php echo $tbl['date_s'];?></td>
    <td>&nbsp;<?php echo $tbl['basic']; ?></td>
    <td>&nbsp;<?php echo $tbl['meal']; ?></td>
    <td>&nbsp;<?php echo $tbl['housing']; ?></td>
    <td>&nbsp;<?php echo $tbl['transport']; ?></td>
    <td>&nbsp;<?php echo $tbl['entertainment']; ?></td>
    <td>&nbsp;<?php echo $tbl['housing']; ?></td>
    <td>&nbsp;<?php echo $tbl['long_service']; ?></td>
    <td>&nbsp;<?php echo $tbl['tax']; ?></td>
    <td>&nbsp;<?php echo $tbl['totall']; ?></td>
    </tr>
  <?php } ?>
</table>
</div>
</div>
</body>
</html>