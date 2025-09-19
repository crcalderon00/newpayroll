<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

// Include your database connection (make sure $conn is defined there)
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Calculate Payroll</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

<style>
  /* Reset & Base */
  * {
    box-sizing: border-box;
  }
  body {
    font-family: 'Poppins', sans-serif;
    background: #f9fafb;
    margin: 0; padding: 40px 20px;
    color: #333;
    min-height: 100vh;
    display: flex; justify-content: center;
  }
  #outerwrapper {
    max-width: 1100px;
    width: 100%;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
    padding: 32px 28px;
  }

  /* Navigation Menu */
  #links {
    margin-bottom: 25px;
  }
  #MenuBar1 {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    background: #1f2937;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 6px rgb(0 0 0 / 0.1);
    font-size: 0.9rem;
    font-weight: 600;
  }
  #MenuBar1 > li {
    position: relative;
  }
  #MenuBar1 > li > a {
    display: block;
    padding: 10px 16px;
    color: #f9fafb;
    text-decoration: none;
    transition: background 0.3s;
    white-space: nowrap;
  }
  #MenuBar1 > li:hover > a,
  #MenuBar1 > li > a:focus {
    background: #2563eb;
    color: #fff;
    outline: none;
  }

  /* Dropdown Menu */
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
    white-space: nowrap;
  }
  #MenuBar1 ul li a:hover {
    background: #2563eb;
    color: white;
  }

  /* Table Styles */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 28px;
    font-size: 0.95rem;
    box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
  }
  th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
  }
  th {
    background: #2563eb;
    color: white;
    font-weight: 600;
  }
  tbody tr:hover {
    background: #eff6ff;
  }

  /* Payroll action button */
  .btn-payroll {
    display: inline-block;
    background-color: #2563eb;
    color: white;
    padding: 6px 14px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.3s ease;
    font-size: 0.9rem;
    white-space: nowrap;
  }
  .btn-payroll:hover,
  .btn-payroll:focus {
    background-color: #1e40af;
    outline: none;
  }

  /* Footer links */
  #body p a {
    display: inline-block;
    margin-right: 20px;
    margin-top: 10px;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
    transition: color 0.3s;
  }
  #body p a:hover {
    color: #1e40af;
  }

  /* Responsive */
  @media (max-width: 900px) {
    table, thead, tbody, th, td, tr {
      display: block;
    }
    thead tr {
      display: none;
    }
    tbody tr {
      margin-bottom: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
      padding: 12px 15px;
      background: white;
    }
    tbody tr td {
      padding-left: 50%;
      position: relative;
      border: none;
      border-bottom: 1px solid #e5e7eb;
    }
    tbody tr td:before {
      position: absolute;
      left: 15px;
      top: 12px;
      width: 45%;
      white-space: nowrap;
      font-weight: 600;
      color: #6b7280;
    }
    tbody tr td:nth-of-type(1):before { content: "Staff ID"; }
    tbody tr td:nth-of-type(2):before { content: "Full Name"; }
    tbody tr td:nth-of-type(3):before { content: "Sex"; }
    tbody tr td:nth-of-type(4):before { content: "Birthday"; }
    tbody tr td:nth-of-type(5):before { content: "Department"; }
    tbody tr td:nth-of-type(6):before { content: "Position"; }
    tbody tr td:nth-of-type(7):before { content: "Grade"; }
    tbody tr td:nth-of-type(8):before { content: "Years"; }
    tbody tr td:nth-of-type(9):before { content: "Date Employed"; }
    tbody tr td:nth-of-type(10):before { content: "Action"; }
  }
</style>

</head>

<body>
<div id="outerwrapper">

  <nav id="links">
    <ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="index.php">HOME</a></li>
      <li><a href="reg_staff.php">REGISTER STAFF</a></li>
      <li><a href="view_staff.php">VIEW STAFF</a></li>
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
  </nav>

  <div id="body">

  <?php
  $qry = mysqli_query($conn, "SELECT * FROM register_staff") or die(mysqli_error($conn));

  if(mysqli_num_rows($qry) > 0){
      echo "<table>";
      echo "<thead>
              <tr>
                <th>Staff ID</th>
                <th>Full Name</th>
                <th>Sex</th>
                <th>Birthday</th>
                <th>Department</th>
                <th>Position</th>
                <th>Grade</th>
                <th>Years</th>
                <th>Date Employed</th>
                <th>Action</th>
              </tr>
            </thead>";
      echo "<tbody>";
      while ($row = mysqli_fetch_assoc($qry)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['staff_id']) . "</td>";
          echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
          echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
          echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
          echo "<td>" . htmlspecialchars($row['department']) . "</td>";
          echo "<td>" . htmlspecialchars($row['position']) . "</td>";
          echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
          echo "<td>" . htmlspecialchars($row['years']) . "</td>";
          echo "<td>" . htmlspecialchars($row['date_registered']) . "</td>";
          echo "<td><a href='pay.php?id=" . urlencode($row['staff_id']) . "' class='btn-payroll'>Payroll</a></td>";
          echo "</tr>";
      }
      echo "</tbody></table>";
  } else {
      echo "<p style='text-align:center; font-weight:600; color:#6b7280;'>No staff records found.</p>";
  }
  ?>

  <p><a href="index.php">Go Home</a></p>
  <p><a href="payroll.php">Calculate Payroll</a></p>

  </div>

</div>

</body>
</html>
