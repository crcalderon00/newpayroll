<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];
// Use mysqli_query and pass $conn (from connection.php)
$qry = mysqli_query($conn, "SELECT * FROM staff_inbox WHERE staff_id = '$staff_id'");

if (!$qry) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inbox</title>
<link rel="stylesheet" href="../css/staff.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="outerwrapper">
<div id="header"><img src="../images/staffhead.jpg" alt="Header Image" /></div>
<div id="links">
  <?php include('link.php'); ?>
</div>
<div id="body">
<table width="100%" border="1" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>
      <table width="100%" border="1">
        <tr>
          <td><a href="compose2.php">Compose</a></td>
          <td><a href="outbox.php">Outbox</a></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="127"><strong>Received Date</strong></td>
    <td width="253"><strong>Sender</strong></td>
    <td width="113"><strong>Subject</strong></td>
    <td width="76">&nbsp;</td>
    <td width="49">&nbsp;</td>
  </tr>
  <?php while ($tbl = mysqli_fetch_assoc($qry)) { ?>
  <tr>
    <td><?php echo htmlspecialchars($tbl['received_date']); ?></td>
    <td><?php echo htmlspecialchars($tbl['sender']); ?></td>
    <td><?php echo htmlspecialchars($tbl['msg_subject']); ?></td>
    <td><a href="more.php?id=<?php echo urlencode($tbl['id']); ?>">Read More</a></td>
    <td><a href="inboxdelete.php?id=<?php echo urlencode($tbl['id']); ?>">Delete</a></td>
  </tr>
  <?php } ?>
</table>
</div>
</div>

</body>
</html>
