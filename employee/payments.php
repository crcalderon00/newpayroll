<?php
include('../admin/connection.php');  // Make sure this creates $conn as mysqli connection
session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];
$qry = mysqli_query($conn, "SELECT * FROM salary WHERE staff_id = '$staff_id'");
if (!$qry) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  
  <?php while ($tbl = mysqli_fetch_assoc($qry)) { ?>
  <tr>
    <td><?php echo htmlspecialchars($tbl['date_s']); ?></td>
    <td><?php echo htmlspecialchars($tbl['basic']); ?></td>
    <td><?php echo htmlspecialchars($tbl['meal']); ?></td>
    <td><?php echo htmlspecialchars($tbl['housing']); ?></td>
    <td><?php echo htmlspecialchars($tbl['transport']); ?></td>
    <td><?php echo htmlspecialchars($tbl['entertainment']); ?></td>
    <td><?php echo htmlspecialchars($tbl['housing']); ?></td>
    <td><?php echo htmlspecialchars($tbl['long_service']); ?></td>
    <td><?php echo htmlspecialchars($tbl['tax']); ?></td>
    <td><?php echo htmlspecialchars($tbl['totall']); ?></td>
  </tr>
  <?php } ?>
</table>
</div>
</div>
</body>
</html>
