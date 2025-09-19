<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body
{
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#000;
}
#spryconfirm1 {
	font-size: small;
}
#spryconfirm1 .confirmRequiredMsg {
	font-size: x-small;
}
</style>
</head>

<body><form action="reset.php" method="post">
<table width="409" border="1" align="center">
  <tr>
    <td width="118">Staff_id</td>
    <td width="275"><input type="text" name="staff_id" id="staff_id" /></td>
  </tr>
  <tr>
    <td>New password</td>
    <td><span id="sprypassword1">
      <label for="password"></label>
      <input type="password" name="password" id="password" />
      <span class="passwordRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td>Confirm new password</td>
    <td><label for="conewpassword"></label>      <label for="newpassword"><span id="spryconfirm1">
      <input type="password" name="newpassword" id="newpassword2" />
      <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg" id="spryconfirm1">passwords dont match.</span></span></label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Reset Password" /></td>
  </tr>
</table>
</form>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur"]});
</script>
</body>
</html>