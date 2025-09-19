<?php

//database connection
include('connection.php');
include('../sanitise.php');
$staff_id = sanitise($_GET['staff_id']);
$qry =("SELECT * FROM register_staff WHERE staff_id = '$staff_id'");
$update = mysql_query($qry) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
?>

<html>
<head>
<title>Update Staff Info</title>
</head>

<body>

<form method="post" name="form1" action="up2.php">
  <table align="center">
    <tr>
      <td nowrap align="right">Staff ID:</td>
      <td><input name="staff_id" type="text" value="<?php echo $row_update['staff_id']; ?>" size="32" readonly="readonly"></td>
    </tr>
    <tr>
      <td nowrap align="right">Full Name:</td>
      <td><input name="fname" type="text" value="<?php echo $row_update['fname']; ?>" size="32"></td>
    </tr>
    <tr>
      <td nowrap align="right">Department</td>
      <td><input name="department" type="text" value="<?php echo $row_update['department']; ?>" size="32"></td>
    </tr>
 	<tr>
      <td nowrap align="right">	Position</td>
      <td><input name="position" type="text" value="<?php echo $row_update['position']; ?>" size="32"></td>
    </tr>
    <tr>
      <td nowrap align="right">Years Spent:</td>
      <td><input name="years" type="text" value="<?php echo $row_update['years']; ?>" size="32"></td>
    </tr>
    <tr>
      <td nowrap align="right">Grade Level:</td>
      <td><input name="grade" type="text" value="<?php echo $row_update['grade']; ?>" size="32"></td>
    </tr>
    <tr>
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" class="linkers" value="Update"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>