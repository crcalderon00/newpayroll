<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Staff</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/tcal.css" type="text/css" />
<script type="text/javascript" src="../css/tcal.js"></script>
<script type="text/javascript">
 	function proceed() 
	{
	  return confirm('Click to confirm registration');
 	}
 </script>
</head>

<body><div id="outerwrapper">
<div id="header"></div>
<div id="links">
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="index.php">HOME</a>      </li>
    <li><a href="reg_staff.php">REGISTER STAFF</a></li>
    <li><a href="view_staff.php">VIEW STAFF</a>      </li>
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

<form name="register" action="reg.php" method="post">
<table width="400" border="1" align="center">
  <tr>
    <td width="221"><strong>Full Name</strong></td>
    <td width="163"><span id="sprytextfield1">
          <input type="text" name="fname" id="email" />
    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>Sex</strong></td>
    <td><span id="spryselect1">
  <select name="sex" id="sex">
  <option value="" selected>Select sex</option>
  <option value="Male" >Male</option>
  <option value="Female" >Female</option>
  </select>
      <span class="selectRequiredMsg">Please select an item.</span></span></td>
  </tr>
  <tr>
    <td><strong>Birthday</strong></td>
    <td>
      <input type="text" name="birthday" id="birthday" class="tcal"/>
</td>
  </tr>
  <tr>
    <td><strong>Department</strong></td>
    <td><span id="spryselect3">
<select name="department" id="department">
<option value="" selected>Select Department</option>
<option value="Human Resources" >Human Resources</option>
<option value="I.T." >I.T.</option>
<option value="Accounting">Accounting</option>
<option value="Research">Research &amp; Development</option>
<option value="Administration">Administration</option>
<option value="Marketing">Marketing</option>
<option value="Production">Production</option>

</select>      
</select>
      <span class="selectRequiredMsg">Please select an item.</span></span></td>
  </tr>
  <tr>
    <td><strong>Position</strong></td>
    <td><span id="spryselect2">
<select name="position" id="position">
<option value="" selected>Select Position</option>
<option value="Director">Director</option>
<option value="As. Director">As. Director</option>
<option value="Manager">Manager</option>
<option value="As.Manager">As. Manager</option>
<option value="Supervisor">Supervisor</option>
<option value="Head">Head</option>
<option value="Ass. Head">Ass. Head</option>
<option value="Clerk">Clerk</option>
</select>
      <span class="selectRequiredMsg">Please select an item.</span></span></td>
  </tr>
  <tr>
    <td><strong>Grade Level</strong></td>
    <td><span id="sprytextfield5">
      <input type="text" name="grade" id="grade" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>Years Spent</strong></td>
    <td><span id="sprytextfield6">
      <input type="text" name="years" id="years" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>Username</strong></td>
    <td><span id="sprytextfield4">
      <label for="username"></label>
      <input type="text" name="username" id="username" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>Password</strong></td>
    <td><span id="sprypassword1">
    <label for="password"></label>
    <input type="password" name="password" id="password" />
    <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Register Staff" /></td>
  </tr>
</table>

</form>
</div>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur"], minChars:7});
</script>
</body>
