<?php
if (isset($_POST['submit'])) {
    // Database connection
    include('connection.php');
    include('../sanitise.php');

    // select housing, transport, tax, entertainment, and long_service values
    $you = $conn->query("SELECT * FROM variables");

    if ($you && $you->num_rows > 0) {
        while ($row = $you->fetch_assoc()) {
            $a = $row['housing'];
            $b = $row['transport'];
            $c = $row['tax'];
            $d = $row['entertainment'];
            $e = $row['long_service'];
        }
    } else {
        die("Error fetching variables: " . $conn->error);
    }

    $staff_id   = sanitise($_POST['staff_id']);
    $fname      = sanitise($_POST['fname']);
    $department = sanitise($_POST['department']);
    $position   = sanitise($_POST['position']);
    $grade      = sanitise($_POST['grade']);
    $years      = sanitise($_POST['years']);
    $basic      = sanitise($_POST['basic']);
    $meal       = sanitise($_POST['meal']);

    // Housing allowance is % of basic
    $housing = ($a * $basic);

    // Transport allowance
    $transport = ($b * $basic);

    // Tax
    $tax = ($c * $basic);

    // Entertainment
    $entertainment = ($grade > 7) ? ($d * $basic) : 0;

    // Long service
    $long_service = ($years >= 15) ? ($e * $basic) : 0;

    // Total salary calculation
    $totall = ($basic + $housing + $meal + $transport + $entertainment + $long_service - $tax);

    // check if salary already computed for this month
    $query  = "SELECT * FROM salary WHERE staff_id = '$staff_id' AND MONTH(date_s) = MONTH(NOW())";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        echo "Salary has already been computed for this month";
        echo "<br />";
        echo "<a href=payroll.php>Back</a>";
    } else {
        $qry = "INSERT INTO salary 
        (staff_id, fname, department, position, years, grade, basic, meal, housing, transport, entertainment, long_service, tax, totall) 
        VALUES 
        ('$staff_id', '$fname', '$department', '$position', '$years', '$grade', '$basic', '$meal', '$housing', '$transport', '$entertainment', '$long_service', '$tax', '$totall')";

        if ($conn->query($qry) === TRUE) {
            header('Location: print.php');
            exit;
        } else {
            die("Error inserting salary: " . $conn->error);
        }
    }
}
?>
