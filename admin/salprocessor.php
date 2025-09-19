<?php
//database connection
include_once('connection.php');
$staff_id = $_POST['staff_id'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$department = $_POST['department'];
$position = $_POST['position'];
$grade = $_POST['grade'];
$years = $_POST['years'];
$basic = $_POST['basic'];
$meal = $_POST['meal'];
//$submit = $_POST['submit'];
//housing allowance is 15% of basic salary
$housing = (0.15 * $basic);

//transport allowance is 8% of basic salary
$transport = (0.08 * $basic);

//tax is 9% of basic salary
$tax = (0.09 * $basic);

//staff who is above grade level 7, gets 2% of his/her salary has entertainment, if not, gets nothing
if ($grade > 7)
	{
		$entertainment = 0.02 * $basic;
	}
else
	{
		$entertainment = 0;
	}

//staff who has spent 15years and above gets 1.75% of his/her basic salary aslong service allowance, if not, gets nothing
if ($years >= 15)
	{
		$long_service = 0.0175 * $basic;
	}
else 
	{
		$long_service = 0;
	}
//addition of all alowances
$totall = ($basic + $housing + $meal + $transport + $entertainment + $long_service - $tax);

//insert salary information into salary table of database.
//if(isset($_POST['submit']))
{
	$query = "SELECT * FROM salary WHERE staff_id = '$staff_id' AND month(date_s) = month(now())";
	$result = mysql_query($query);
	//$row_usercheck = mysql_fetch_assoc($result);
	$num = mysql_num_rows($result);
	if($num>0)
		{
			echo "salary has been computed for this month";
			echo "<br />";
			echo "<a href=payroll.php>Back</a>";
		}
	
	else
	
		{
			$qry = "INSERT INTO salary (staff_id, lname, fname, department, position, years, grade, basic, meal, housing, transport, entertainment, 						long_service, tax, totall) VALUES ('$staff_id', '$lname', '$fname', '$department', '$position', '$years', '$grade', 		'$basic', '$meal', '$housing', '$transport', '$entertainment', '$long_service', '$tax', $totall)";
			mysql_query($qry) or die(mysql_error());
			header('Location:print.php');

		}

}

?>