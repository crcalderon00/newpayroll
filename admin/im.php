<?php
include('../sanitise.php');
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}
//database connection
include('connection.php');
$admin = $_SESSION['username'];
$staff_id = sanitise($_GET['staff_id']);
$qry =("SELECT * FROM register_staff WHERE staff_id = '$staff_id'");
$update = mysql_query($qry) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Send Message</title>
<script src="../../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
 	function proceed() 
	{
	  return confirm('Do u want to send message to Staff Id<?php echo $staff_id?>');
 	}
 </script>
<link href="../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form method="post" action="impro.php">
<table width="563" border="1" align="center">
  <tr>
    <td>From</td>
    <td><input name="from" type="text" value="<?php echo $admin?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td width="95">Staff ID</td>
    <td width="452"><span id="sprytextfield2">
      <label for="staff_id"></label>
      <input name="staff_id" type="text" id="staff_id" value="<?php echo $row_update['staff_id']; ?>" readonly="readonly"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td>To:</td>
    <td><span id="sprytextfield3">
      <label for="fname"></label>
      <input name="fname" type="text" id="fname" value="<?php echo $row_update['fname']; ?>" readonly="readonly"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td>Subject</td>
    <td><span id="sprytextfield1">
      <label for="subject"></label>
      <input type="text" name="subject" id="subject" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td>Message</td>
    <td><span id="sprytextarea1">
      <label for="message"></label>
      <textarea name="message" id="message" cols="45" rows="5"></textarea>
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Submit" onclick="proceed()"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Go <a href="view_staff.php">Back</a></td>
  </tr>
</table>

</form>
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>
</html>