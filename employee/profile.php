<?php
include('../admin/connection.php'); // make sure $conn is defined here as your mysqli connection
session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];

// Use mysqli_query with $conn as first param
$qry = mysqli_query($conn, "SELECT * FROM register_staff WHERE staff_id = '$staff_id'");

// Check for query error
if (!$qry) {
    die("Database query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Staff Profile</title>
<link rel="stylesheet" href="../css/staff.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="outerwrapper">
<div id="header"><img src="../images/staffhead.jpg" alt="Staff Header" /></div>
<div id="links">
  <?php include('link.php'); ?>
</div>
<div id="body">
  <table width="410" border="1" align="center" cellpadding="5" cellspacing="3">
    <?php while ($tbl = mysqli_fetch_assoc($qry)) { ?>
    <tr>
      <td width="120"><strong>Staff ID</strong></td>
      <td width="271"><?php echo htmlspecialchars($tbl['staff_id']); ?></td>
    </tr>
    <tr>
      <td><strong>Name</strong></td>
      <td><?php echo htmlspecialchars($tbl['fname']); ?></td>
    </tr>
    <tr>
      <td><strong>Sex</strong></td>
      <td><?php echo htmlspecialchars($tbl['sex']); ?></td>
    </tr>
    <tr>
      <td><strong>Birthday</strong></td>
      <td><?php echo htmlspecialchars($tbl['birthday']); ?></td>
    </tr>
    <tr>
      <td><strong>Position</strong></td>
      <td><?php echo htmlspecialchars($tbl['position']); ?></td>
    </tr>
    <tr>
      <td><strong>Department</strong></td>
      <td><?php echo htmlspecialchars($tbl['department']); ?></td>
    </tr>
    <tr>
      <td><strong>Grade</strong></td>
      <td><?php echo htmlspecialchars($tbl['grade']); ?></td>
    </tr>
    <tr>
      <td><strong>Years Spent</strong></td>
      <td><?php echo htmlspecialchars($tbl['years']); ?></td>
    </tr>
    <tr>
      <td><strong>Date Registered</strong></td>
      <td><?php echo htmlspecialchars($tbl['date_registered']); ?></td>
    </tr>
    <?php } ?>
  </table>
</div>
</div>

</body>
</html>
