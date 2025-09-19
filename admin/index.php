<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

include('connection.php'); // This provides $conn

// Your queries with aliases
$qry = "SELECT 
            COUNT(*) AS cnt, 
            SUM(basic) AS sum_basic, 
            SUM(meal) AS sum_meal, 
            SUM(housing) AS sum_housing, 
            SUM(transport) AS sum_transport, 
            SUM(entertainment) AS sum_entertainment, 
            SUM(long_service) AS sum_long_service, 
            SUM(tax) AS sum_tax, 
            SUM(totall) AS sum_totall, 
            MONTHNAME(date_s) AS month_name 
        FROM salary 
        GROUP BY MONTH(date_s)";
$run = mysqli_query($conn, $qry) or die(mysqli_error($conn));

$qry2 = "SELECT COUNT(*) AS cnt FROM register_staff";
$run2 = mysqli_query($conn, $qry2) or die(mysqli_error($conn));

$qry3 = "SELECT sex, COUNT(*) AS cnt FROM register_staff GROUP BY sex";
$run3 = mysqli_query($conn, $qry3) or die(mysqli_error($conn));

$qry4 = "SELECT position, COUNT(*) AS cnt FROM register_staff GROUP BY position";
$run4 = mysqli_query($conn, $qry4) or die(mysqli_error($conn));

$qry5 = "SELECT department, COUNT(*) AS cnt FROM register_staff GROUP BY department";
$run5 = mysqli_query($conn, $qry5) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
   /* Reset */
* {
  box-sizing: border-box;
}
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  background: #f9fafb;
  color: #333;
  line-height: 1.4;
  display: flex;
  justify-content: center;
  padding: 40px 20px;
  min-height: 100vh;
}

/* Centered container */
#outerwrapper {
  max-width: 960px;
  width: 100%;
  background: white;
  padding: 25px 30px;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
}

/* Header table */
#outerwrapper > table:first-child {
  width: 100%;
  margin-bottom: 20px;
  font-weight: 600;
  font-size: 1rem;
  color: #4a4a4a;
}

/* Navigation */
#links {
  margin-bottom: 25px;
}
#MenuBar1 {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  background: #1f2937;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 3px 6px rgb(0 0 0 / 0.1);
  font-size: 0.9rem;
}
#MenuBar1 > li > a {
  display: block;
  padding: 10px 16px;
  color: #f9fafb;
  text-decoration: none;
  font-weight: 600;
  transition: background 0.3s;
  white-space: nowrap;
}
#MenuBar1 > li:hover > a,
#MenuBar1 > li > a:focus {
  background: #2563eb;
  color: #fff;
  outline: none;
}
#MenuBar1 ul {
  position: absolute;
  top: 100%;
  left: 0;
  background: #1e293b;
  border-radius: 0 0 8px 8px;
  display: none;
  min-width: 140px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);
  z-index: 1000;
  font-size: 0.85rem;
}
#MenuBar1 li:hover > ul {
  display: block;
}
#MenuBar1 ul li a {
  padding: 8px 12px;
  color: #f3f4f6;
  font-weight: 500;
  display: block;
  transition: background 0.25s;
}
#MenuBar1 ul li a:hover {
  background: #2563eb;
  color: white;
}

/* Tables */
table {
  border-collapse: separate;
  border-spacing: 0 6px;
  width: 100%;
  margin-bottom: 30px;
  background: #fff;
  box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
  border-radius: 8px;
  overflow: hidden;
  font-size: 0.9rem;
}

table tr {
  background: #fefefe;
  border-radius: 8px;
  transition: background 0.25s;
  height: 36px;
}

table tr:hover {
  background: #f1f5f9;
}

table td, table th {
  padding: 8px 14px;
  text-align: left;
  vertical-align: middle;
  border: none;
  color: #374151;
}

table th, table strong {
  color: #111827;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  font-size: 0.8rem;
}

/* Links inside table */
table a {
  color: #2563eb;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s;
}
table a:hover {
  text-decoration: underline;
  color: #1d4ed8;
}

/* Specific small tables */
.small-table {
  width: 100%;
  max-width: 290px;
  margin-bottom: 20px;
}

/* Layout */
.flex-row {
  display: flex;
  gap: 18px;
  justify-content: space-between;
  margin-bottom: 30px;
  flex-wrap: wrap;
}

.flex-col {
  flex: 1 1 280px;
  background: #fff;
  padding: 12px 18px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
  min-width: 280px;
}

/* Wrapper for the big salaries table */
.salary-table-wrapper {
  max-width: 900px;      /* max width */
  margin: 0 auto 40px;   /* center horizontally and add bottom margin */
  overflow-x: auto;      /* scroll if too wide */
}

/* Reduce padding and prevent line breaks in big table cells */
.salary-table-wrapper table td,
.salary-table-wrapper table th {
  padding: 6px 10px;
  white-space: nowrap;
}

/* Responsive */
@media (max-width: 700px) {
  .flex-row {
    flex-direction: column;
  }
  .flex-col {
    min-width: 100%;
  }
}
  </style>
</head>

<body>
  <div id="outerwrapper">

    <table>
      <tr>
        <td>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></td>
        <td></td>
      </tr>
    </table>

    <div id="header"></div>

    <nav id="links">
      <ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="index.php">HOME</a></li>
        <li><a href="reg_staff.php">REGISTER STAFF</a></li>
        <li><a href="view_staff.php">VIEW STAFF</a></li>
        <li>
          <a href="payroll.php" class="MenuBarItemSubmenu">PAYROLL</a>
          <ul>
            <li><a href="print.php">Print Slip</a></li>
          </ul>
        </li>
        <li>
          <a href="#" class="MenuBarItemSubmenu">MESSAGE</a>
          <ul>
            <li><a href="inbox.php">Inbox</a></li>
            <li><a href="sentmessages.php">Sent</a></li>
          </ul>
        </li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>

    <div class="flex-row">
      <div class="flex-col">
        <table class="small-table">
          <?php while ($rows = mysqli_fetch_assoc($run2)) { ?>
          <tr>
            <td>No of Registered Staffs</td>
            <td><?php echo $rows['cnt']; ?></td>
          </tr>
          <?php } ?>

          <?php while($rowsb = mysqli_fetch_assoc($run3)) { ?>
          <tr>
            <td><?php echo htmlspecialchars($rowsb['sex']); ?></td>
            <td><?php echo $rowsb['cnt']; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>

      <div class="flex-col">
        <table class="small-table">
          <thead>
            <tr><th colspan="2">Staff Breakdown by Position</th></tr>
            <tr>
              <th>Position</th>
              <th>Number of Staffs</th>
            </tr>
          </thead>
          <tbody>
          <?php while($rb = mysqli_fetch_assoc($run4)) { ?>
          <tr>
            <td><a href="position.php?position=<?php echo urlencode($rb['position']); ?>">
              <?php echo htmlspecialchars($rb['position']); ?></a></td>
            <td><?php echo $rb['cnt']; ?></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="flex-col">
        <table class="small-table">
          <thead>
            <tr><th colspan="2">Staff Breakdown by Departments</th></tr>
            <tr>
              <th>Department</th>
              <th>Number of Staffs</th>
            </tr>
          </thead>
          <tbody>
          <?php while($r = mysqli_fetch_assoc($run5)) { ?>
          <tr>
            <td><a href="department.php?department=<?php echo urlencode($r['department']); ?>">
              <?php echo htmlspecialchars($r['department']); ?></a></td>
            <td><?php echo $r['cnt']; ?></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Wrap the big salaries table in a wrapper -->
    <div class="salary-table-wrapper">
      <table>
        <thead>
          <tr>
            <th>No of Salaries Paid</th>
            <th>Sum of Basic Salary</th>
            <th>Meal</th>
            <th>Housing</th>
            <th>Transport</th>
            <th>Entertainment</th>
            <th>Long Service</th>
            <th>Tax</th>
            <th>Total</th>
            <th>Month</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($run)) { ?>
        <tr>
          <td><?php echo $row['cnt']; ?></td>
          <td>N<?php echo round($row['sum_basic']); ?></td>
          <td>N<?php echo round($row['sum_meal']); ?></td>
          <td>N<?php echo round($row['sum_housing']); ?></td>
          <td>N<?php echo round($row['sum_transport']); ?></td>
          <td>N<?php echo round($row['sum_entertainment']); ?></td>
          <td>N<?php echo round($row['sum_long_service']); ?></td>
          <td>N<?php echo round($row['sum_tax']); ?></td>
          <td>N<?php echo round($row['sum_totall']); ?></td>
          <td><a href="view_month.php?month=<?php echo urlencode($row['month_name']); ?>">
            <?php echo htmlspecialchars($row['month_name']); ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

  </div>

  <script type="text/javascript">
  var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {
    imgDown:"../../SpryAssets/SpryMenuBarDownHover.gif", 
    imgRight:"../../SpryAssets/SpryMenuBarRightHover.gif"
  });
  </script>

</body>
</html>
