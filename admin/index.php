<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

include('connection.php'); 

$qry = "SELECT count(*) AS cnt, sum(basic) AS sum_basic, sum(meal) AS sum_meal, sum(housing) AS sum_housing, sum(transport) AS sum_transport, sum(entertainment) AS sum_entertainment, sum(long_service) AS sum_long_service, sum(tax) AS sum_tax, sum(totall) AS sum_totall, monthname(date_s) AS month_name FROM salary GROUP BY month(date_s)";
$run = mysqli_query($conn, $qry) or die(mysqli_error($conn));

$qry2 = "SELECT count(*) AS cnt FROM register_staff";
$run2 = mysqli_query($conn, $qry2) or die(mysqli_error($conn));

$qry3 = "SELECT sex, count(*) AS cnt FROM register_staff GROUP BY sex";
$run3 = mysqli_query($conn, $qry3) or die(mysqli_error($conn));

$qry4 = "SELECT position, count(*) AS cnt FROM register_staff GROUP BY position";
$run4 = mysqli_query($conn, $qry4) or die(mysqli_error($conn));

$qry5 = "SELECT department, count(*) AS cnt FROM register_staff GROUP BY department";
$run5 = mysqli_query($conn, $qry5) or die(mysqli_error($conn));
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 	function proceed() 
	{
	  return confirm('Compute Payroll');
 	}
 </script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body><div id="outerwrapper">
<table width="1023" border="0">
  <tr>
    <td width="182">Welcome <?php echo $_SESSION['username'];?></td>
    <td width="473">&nbsp;</td>
  </tr>
</table>

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
<table width="100%" border="1">
  <tr>
    <td width="878" height="280" valign="top"><table width="840" border="1">
      <tr>
        <td width="253" valign="top"><table width="195" border="1">
      <tr><?php while ($rows = mysql_fetch_array($run2)) {?>
          <td width="127">No of Registered Staffs</td>
          <td width="52"><?php echo $rows['count(*)']; ?></td>
          </tr><?php }?>
   
        
      <tr><?php  while($rowsb = mysql_fetch_array($run3)) {?>
        <td><?php echo $rowsb['sex']; ?></td>
        <td><?php echo $rowsb['count(*)']; ?></td>
        </tr>
      <?php }?>
    </table></td>
        <td width="292" valign="top"><table width="244" border="1">
          <tr>
            <td colspan="2"><strong>Staff Breakdown  by Position</strong></td>
            </tr>
          <tr>
            <td><strong>Position</strong></td>
            <td><strong>Number of Staffs</strong></td>
            </tr>
          <tr><?php  while($rb = mysql_fetch_array($run4)) {?>
            <td width="104"><a href="position.php?position=<?php echo $rb['position'];?>"> <?php echo $rb['position'];?></a></td>
            <td width="124"><?php echo $rb['count(*)']; ?>&nbsp;</td>
            </tr><?php }?>
</table></td>
        <td width="273" valign="top"><table width="264" border="1">
          <tr>
            <td colspan="2"><strong>Staff Breakdown by Departments</strong></td>
            </tr>
          <tr>
            <td width="131"><strong>Department</strong></td>
            <td width="117"><strong>Number of Staffs</strong></td>
          </tr>
          <tr><?php  while($r = mysql_fetch_array($run5)) {?>
            <td><a href="department.php?department=<?php echo $r['department']; ?>"> <?php echo $r['department'];?></a></td>
            <td><?php echo $r['count(*)']; ?></td>
          </tr><?php }?>
        </table></td>
        </tr>
    </table>
      
      <br />

      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
<br />

	  
<table width="836" border="1">
  <tr>        
        <td width="121"><strong>No of Salaries Paid</strong></td>
        <td width="124"><strong>Sum of Basic Salary</strong></td>
        <td width="62"><strong>Meal</strong></td>
        <td width="73"><strong>Housing</strong></td>
        <td width="72"><strong>Transport</strong></td>
        <td width="102"><strong>Entertainment</strong></td>
        <td width="89"><strong>Long Service</strong></td>
        <td width="68"><strong>Tax</strong></td>
        <td width="67"><strong>Total</strong></td>
        <td width="67"><strong>Month</strong></td>		
		</tr>
		<?php while ($row = mysql_fetch_array($run)) {?>
      	<tr>
        <td><?php echo $row['count(*)']; ?></td>
        <td>N<?php echo round($row['sum(basic)']); ?></td>
        <td>N<?php echo round($row['sum(meal)']); ?></td>
        <td>N<?php echo round($row['sum(housing)']); ?></td>
        <td>N<?php echo round($row['sum(transport)']); ?></td>
        <td>N<?php echo round($row['sum(entertainment)']); ?></td>
        <td>N<?php echo round($row['sum(long_service)']); ?></td>
        <td>N<?php echo round($row['sum(tax)']); ?></td>
        <td>N<?php echo round($row['sum(totall)']); ?></td>
        <td><a href="view_month.php?month=<?php echo $row['monthname(date_s)'];?>"><?php echo $row['monthname(date_s)'];?></a> </td>
     	</tr><?php }?>
	 	 
</table>
        

</td>
    <td width="236" valign="top"><form name="variables" action="varia.php" method="post">
    <table width="213" border="1">
      <tr>
        <td colspan="2"><strong>Update payment Variables</strong></td>
        </tr>
      <tr>
        <td width="89">Housing</td>
        <td width="108"><span id="sprytextfield1">
        <input type="text" name="housing" id="housing" />
        <span class="textfieldRequiredMsg"> </span></span></td>
      </tr>
      <tr>
        <td>Transport</td>
        <td><span id="sprytextfield2">
        <input type="text" name="transport" id="transport" />
        <span class="textfieldRequiredMsg"> </span></span></td>
      </tr>
      <tr>
        <td>Entertainment</td>
        <td><span id="sprytextfield3">
        <input type="text" name="entertainment" id="entertainment" />
        <span class="textfieldRequiredMsg"> </span></span></td>
      </tr>
      <tr>
        <td>Long Service</td>
        <td><span id="sprytextfield4">
        <input type="text" name="long_service" id="long_service" />
        <span class="textfieldRequiredMsg"> </span></span></td>
      </tr>
      <tr>
        <td>Tax</td>
        <td><span id="sprytextfield5">
          <input type="text" name="tax" id="tax" />
</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" id="submit" value="Submit" onclick="proceed()"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></form></td>
  </tr>
  </table>

</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../../SpryAssets/SpryMenuBarRightHover.gif"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
</script>
</body>
</html>