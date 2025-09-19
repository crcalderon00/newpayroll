<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

//database connection
include('connection.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Print PaySlip</title>
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
// Use mysqli to query salary table
$qry = mysqli_query($conn, "SELECT * FROM salary") or die(mysqli_error($conn));

echo "<table border='1' align='center' cellpadding='5' cellspacing='0'>
<tr>
<th>SID</th>
<th>ID</th>
<th>Full Name</th>
<th>Dept</th>
<th>Position</th>
<th>Grade</th>
<th>Years</th>
<th>Basic</th>
<th>Meal All.</th>
<th>Housing All.</th>
<th>Transport All.</th>
<th>Ent. All</th>
<th>LS All</th>
<th>Tax</th>
<th>Total</th>
<th>Date</th>
<th>Delete</th>
<th>Print</th>
</tr>";

while ($row = mysqli_fetch_assoc($qry)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['salary_id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['staff_id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
    echo "<td>" . htmlspecialchars($row['department']) . "</td>";
    echo "<td>" . htmlspecialchars($row['position']) . "</td>";
    echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
    echo "<td>" . htmlspecialchars($row['years']) . "</td>";
    echo "<td>" . round($row['basic']) . "</td>";
    echo "<td>" . round($row['meal']) . "</td>";
    echo "<td>" . round($row['housing']) . "</td>";
    echo "<td>" . round($row['transport']) . "</td>";
    echo "<td>" . round($row['entertainment']) . "</td>";
    echo "<td>" . round($row['long_service']) . "</td>";
    echo "<td>" . round($row['tax']) . "</td>";
    echo "<td>" . round($row['totall']) . "</td>";
    echo "<td>" . htmlspecialchars($row['date_s']) . "</td>";
    echo "<td><a href='salary_delete.php?salary_id=" . urlencode($row['salary_id']) . "&staff_id=" . urlencode($row['staff_id']) . "'>Delete</a></td>";
    echo "<td><a href='payslip.php?staff_id=" . urlencode($row['staff_id']) . "&salary_id=" . urlencode($row['salary_id']) . "'>Print</a></td>";
    echo "</tr>";
}
echo "</table>";
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
