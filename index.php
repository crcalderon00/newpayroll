<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login to your account</title>

<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

<style>
body
{
	background-image:url(images/konferenz.jpg);
	background-position:center;
	background-repeat:no-repeat;
	margin:0;
	padding:0;
	font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size:11px;
}
#login 
{
	margin:auto;
	margin-top:220px;
	width:312px;
	height:182px;
	margin-left:950px;
}

</style>
</head>

<body>
<div id="login">
  <div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Administrator Login</li>
      <li class="TabbedPanelsTab" tabindex="0">Staff Login</li>
    </ul>
    <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent"><form id="form1" name="form1" method="post" action="login.php">
          <table width="300" border="0">
            <tr>
              <td>&nbsp;</td>
              <td><h4>ADMINISTRATOR LOGIN</h4></td>
            </tr>
            <tr>
              <td width="70">Username</td>
              <td width="220"><input type="text" name="username" id="username" /></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><label for="password"></label>
                <input type="password" name="password" id="password" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="submit" id="login2" value="Login" /></td>
            </tr>
          </table>
      </form></div>
      <div class="TabbedPanelsContent"><form id="form1" name="form1" method="post" action="stafflog.php">
          <table width="302" border="0">
            <tr>
              <td>&nbsp;</td>
              <td><h4>STAFF LOGIN</h4></td>
            </tr>
            <tr>
              <td width="77">Staff ID</td>
              <td width="209"><label for="staff_id"><span id="sprytextfield1">
              <input type="text" name="staff_id" id="staff_id2" />
              </span></label></td>
            </tr>
            <tr>
              <td>Username</td>
              <td><span id="sprytextfield2">
                <label for="username"></label>
                <input type="text" name="username" id="username" /> 
              </span></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><label for="password2"><span id="sprytextfield3">
              <input type="password" name="password" id="password" />
              </span></label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="submit" id="submit" value="Login" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a href="resetpassword.php" class="bx2" rel="470-250">Reset password</a></td>
            </tr>
          </table>
</form></div>
    </div>
  </div>
 
</div>
<script type="text/javascript" src="css/mootools.js"></script> 
<script type="text/javascript" src="css/bumpbox-2.0.1.js" ></script> 
<script type="text/javascript">
//names,inSpeed,outSpeed,boxColor,backColor,bgOpacity,bRadius,borderWeight,borderColor,boxShadowSize,boxShadowColor,iconSet,effectsIn,effectsOut
doBump('.bx2',850, 500, 'FFF', '6b7477', 0.7, 7, 2 ,'333', 15,'000', 2, Fx.Transitions.Back.easeOut, Fx.Transitions.linear);
</script>

<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html>