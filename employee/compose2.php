<?php
include('../admin/connection.php');
include('../sanitise.php');
session_start();

if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];

// Use mysqli_query and pass $conn (from connection.php)
$qry1 = mysqli_query($conn, "SELECT * FROM register_staff");
$qry2 = mysqli_query($conn, "SELECT * FROM register_staff WHERE staff_id = '$staff_id'");

if (!$qry1 || !$qry2) {
    die("Query failed: " . mysqli_error($conn));
}

$sender = '';
while ($row = mysqli_fetch_assoc($qry2)) {
    $sender = $row['fname'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Compose Message</title>
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
<form action="msgcomp.php" method="post">
<table width="100%" border="1" align="center">
  <tr>
    <td width="74">&nbsp;</td>
    <td width="127"><a href="inbox.php">Back to Inbox</a></td>
    <td width="95">&nbsp;</td>
    <td width="271">&nbsp;</td>
    <td width="262">&nbsp;</td>
    <td width="76">&nbsp;</td>
    <td width="49">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      <input name="sender" type="hidden" id="sender" value ="<?php echo htmlspecialchars($staff_id); ?>" readonly="readonly"/>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Recipient ID</td>
    <td><input type="text" name="rid" id="rid" /></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>To</td>
    <td>
<?php
if (mysqli_num_rows($qry1) > 0) {
    echo '<select name="recipient">';
    while ($rs = mysqli_fetch_assoc($qry1)) {
        echo '<option value="' . htmlspecialchars($rs['fname']) . '">' . htmlspecialchars($rs['fname']) . '</option>';
    }
    echo '</select>';
}
?>
    </td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Subject</td>
    <td><input type="text" name="subject" id="subject" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Message</td>
    <td><textarea name="message" id="message" cols="45" rows="5"></textarea></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Submit" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>
</div>

</body>
</html>
