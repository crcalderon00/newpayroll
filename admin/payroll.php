<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

// Include your database connection (make sure $conn is defined there)
include('connection.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Calculate Payroll</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
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

<?php
// Fetch records with mysqli
$qry = mysqli_query($conn, "SELECT * FROM register_staff") or die(mysqli_error($conn));

echo "<table border='1' align='center' cellpadding='5' cellspacing='0'>
<tr>
<th>Staff ID</th>
<th>Full Name</th>
<th>Sex</th>
<th>Birthday</th>
<th>Department</th>
<th>Position</th>
<th>Grade</th>
<th>Years</th>
<th>Date Employed</th>
<th>Action</th>
</tr>";

while ($row = mysqli_fetch_assoc($qry)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['staff_id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
    echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
    echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
    echo "<td>" . htmlspecialchars($row['department']) . "</td>";
    echo "<td>" . htmlspecialchars($row['position']) . "</td>";
    echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
    echo "<td>" . htmlspecialchars($row['years']) . "</td>";
    echo "<td>" . htmlspecialchars($row['date_registered']) . "</td>";
    echo "<td><a href='pay.php?id=" . urlencode($row['staff_id']) . "'>Payroll</a></td>";
    echo "</tr>";
}
echo "</table>";

echo "<p><a href='index.php'>Go Home</a></p>";
echo "<p><a href='payroll.php'>Calculate Payroll</a></p>";
?>

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
