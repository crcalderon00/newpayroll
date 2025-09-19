<?php
include('../admin/connection.php'); // Make sure this sets $conn as mysqli connection
session_start();

if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];
$qry = mysqli_query($conn, "SELECT * FROM staff_outbox WHERE sender = '$staff_id'");

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
<table width="100%" border="1" align="center">
  <tr>
    <td>&nbsp;</td>
    <td><a href="inbox.php">Back to Inbox</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="119"><strong>Recipient ID</strong></td>
    <td width="112"><strong>Sent to</strong></td>
    <td width="100"><strong>Subject</strong></td>
    <td width="128"><strong>Message</strong></td>
    <td width="128"><strong>Date Sent</strong></td>
    <td width="128">&nbsp;</td>
    <td width="133">&nbsp;</td>
  </tr>

  <?php while ($tbl = mysqli_fetch_assoc($qry)) { ?>
  <tr>
    <td>&nbsp;<?php echo htmlspecialchars($tbl['staff_id']); ?></td>
    <td>&nbsp;<?php echo htmlspecialchars($tbl['receiver']); ?></td>
    <td>&nbsp;<?php echo htmlspecialchars($tbl['msg_subject']); ?></td>
    <td><?php echo htmlspecialchars(substr($tbl['msg_msg'], 0, 50)); ?></td>
    <td><?php echo htmlspecialchars($tbl['date_sent']); ?></td>
    <td><a href="outboxmore.php?so_id=<?php echo urlencode($tbl['so_id']); ?>">Read</a></td>
    <td><a href="delete.php?so_id=<?php echo urlencode($tbl['so_id']); ?>">Delete</a></td>
  </tr>
  <?php } ?>
</table>
</div>
</div>

</body>
</html>
