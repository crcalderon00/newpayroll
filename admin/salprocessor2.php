<?php
if(isset($_POST['submit'])){
//database connection
include('connection.php');
include('../sanitise.php');
//select housing,transport, tax,entertainment and long_service values from variables table in the database. The data can be changed by the admin from the default values inputted by the designer.
$you = mysql_query("SELECT * FROM variables");
while ($row = mysql_fetch_array($you))
{
	$a = $row['housing'];
	$b = $row['transport'];
	$c = $row['tax'];
	$d = $row['entertainment'];
	$e = $row['long_service'];
} 

$staff_id = sanitise($_POST['staff_id']);
$fname = sanitise($_POST['fname']);
$department = sanitise($_POST['department']);
$position = sanitise($_POST['position']);
$grade = sanitise($_POST['grade']);
$years = sanitise($_POST['years']);
$basic = sanitise($_POST['basic']);
$meal = sanitise($_POST['meal']);


//housing allowance is 15% of basic salary
$housing = ($a * $basic);

//transport allowance is 8% of basic salary
$transport = ($b * $basic);

//tax is 9% of basic salary
$tax = ($c * $basic);

//staff who is above grade level 7, gets 2% of his/her salary has entertainment, if not, staff gets nothing
if ($grade > 7)
	{
		$entertainment = $d * $basic;
	}
else
	{
		$entertainment = 0;
	}

//staff who has spent 15years and above gets 1.75% of his/her basic salary as long service allowance, if not, staff gets nothing
if ($years >= 15)
	{
		$long_service = $e * $basic;
	}
else 
	{
		$long_service = 0;
	}
//addition of basic salary and all allowances and subtraction of tax
$totall = ($basic + $housing + $meal + $transport + $entertainment + $long_service - $tax);
//insert salary information into salary table of database.
//code here checks if salary has been computed for the month, it stops multiple submission for a month.
{
	$query = "SELECT * FROM salary WHERE staff_id = '$staff_id' AND month(date_s) = month(now())";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
	if($num>0)
		{
			echo "salary has been computed for this month";
			echo "<br />";
			echo "<a href=payroll.php>Back</a>";
		}
//if nothing is found for a month, salary information is inserted into database.
	else
		{
			$qry = "INSERT INTO salary (staff_id, fname, department, position, years, grade, basic, meal, housing, transport, entertainment, 						long_service, tax, totall) VALUES ('$staff_id','$fname','$department', '$position','$years','$grade','$basic','$meal', '$housing','$transport','$entertainment', '$long_service', '$tax', $totall)";
			mysql_query($qry) or die(mysql_error());
			header('Location:print.php');
		}
} 
}
?>