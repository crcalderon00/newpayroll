<?php
session_start();
if (!isset($_SESSION['username'])) {
    die(header('Location: ../index.php'));
}

// Database connection
include('connection.php');
include('../sanitise.php');

$staff_id = sanitise($_GET['id']);

// Use MySQLi query
$qry = $conn->query("SELECT * FROM register_staff WHERE staff_id = '$staff_id'");

if (!$qry || $qry->num_rows === 0) {
    die("No staff record found for ID: " . htmlspecialchars($staff_id));
}

$row_update = $qry->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calculate Salary</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function proceed() {
    return confirm('Compute Payroll');
}
</script>
</head>

<body>
<div id="outerwrapper">
<div id="header"></div>
<div id="links">
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="index.php">HOME</a></li>
    <li><a href="reg_staff.php">REGISTER STAFF</a></li>
    <li><a href="view_staff.php">VIEW STAFF</a></li>
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
<form method="post" name="form1" action="salprocessor2.php">
  <table align="center">
    <tr>
      <td nowrap align="right">Staff ID:</td>
      <td><input name="staff_id" type="text" value="<?php echo htmlspecialchars($row_update['staff_id']); ?>" size="32" readonly="readonly"></td>
    </tr>
    <tr>
      <td nowrap align="right">Full Name</td>
      <td><input name="fname" type="text" id="fname" value="<?php echo htmlspecialchars($row_update['fname']); ?>" size="32"></td>
    </tr>
    <tr>
      <td nowrap align="right">Department</td>
      <td><input name="department" type="text" value="<?php echo htmlspecialchars($row_update['department']); ?>" size="32" readonly="readonly"></td>
    </tr>
    <tr>
      <td nowrap align="right">Position</td>
      <td><input name="position" type="text" value="<?php echo htmlspecialchars($row_update['position']); ?>" size="32" readonly="readonly"></td>
    </tr>
    <tr>
      <td nowrap align="right">Years Spent:</td>
      <td><input name="years" type="text" value="<?php echo htmlspecialchars($row_update['years']); ?>" size="32" readonly="readonly"></td>
    </tr>
    <tr>
      <td nowrap align="right">Grade Level:</td>
      <td><input name="grade" type="text" value="<?php echo htmlspecialchars($row_update['grade']); ?>" size="32" readonly="readonly"></td>
    </tr>
    <tr>
      <td nowrap align="right">Basic Salary</td>
      <td><input type="text" name="basic" value="" size="32"></td>
    </tr>
    <tr>
      <td nowrap align="right">Meal Allowance</td>
      <td><input type="text" name="meal" value="" size="32"></td>
    </tr>
    <tr>
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" name="submit" value="Calculate Payroll" onclick="return proceed()"></td>
    </tr>
  </table>
</form>
</div>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {
    imgDown:"../../SpryAssets/SpryMenuBarDownHover.gif",
    imgRight:"../../SpryAssets/SpryMenuBarRightHover.gif"
});
</script>
</body>
</html>
