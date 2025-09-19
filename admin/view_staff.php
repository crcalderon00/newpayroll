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
<title>View Staff</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

<style>
  /* Base and Reset */
  * {
    box-sizing: border-box;
  }
  body {
    font-family: 'Poppins', sans-serif;
    background: #f9fafb;
    margin: 0;
    padding: 40px 20px;
    color: #333;
    min-height: 100vh;
    display: flex;
    justify-content: center;
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
    padding: 0;
    margin: 0;
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

  /* Dropdown */
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

  /* Page Heading */
  h1 {
    font-weight: 700;
    font-size: 1.75rem;
    margin-bottom: 20px;
    color: #111827;
    text-align: center;
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

  /* Action Icons Container */
  .action-links {
    display: flex;
    align-items: center;
  }
  .action-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2563eb;
    text-decoration: none;
    padding: 6px 8px;
    cursor: pointer;
    transition: color 0.3s;
  }
  .action-links a:hover {
    color: #1e40af;
  }

  /* Separator between icons */
  .action-links a + a {
    position: relative;
    margin-left: 12px;
  }
  .action-links a + a::before {
    content: "";
    position: absolute;
    left: -6px;
    top: 50%;
    transform: translateY(-50%);
    width: 1px;
    height: 18px;
    background-color: #cbd5e1; /* light separator */
  }

  /* SVG icon size */
  .action-links svg {
    width: 18px;
    height: 18px;
    fill: currentColor;
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
    tbody tr td:nth-of-type(10):before { content: "Actions"; }
    .action-links {
      justify-content: flex-start;
    }
  }
</style>

</head>

<body>
<div id="outerwrapper">

  <nav id="links">
    <ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="index.php">HOME</a></li>
      <li><a href="reg_staff.php">REGISTER STAFF</a></li>
      <li><a href="view_staff.php" aria-current="page">VIEW STAFF</a></li>
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
      <li><a href="../logout.php">LOGOUT</a></li>
    </ul>
  </nav>

  <h1>View Staff</h1>

  <div id="body">
  <?php
  // Query to fetch staff records
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
                  <th>Actions</th>
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
          echo "<td class='action-links'>
                  <a href='delete.php?staff_id=" . urlencode($row['staff_id']) . "' title='Delete' onclick=\"return confirm('Are you sure you want to delete this staff?');\">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                      <polyline points='3 6 5 6 21 6'></polyline>
                      <path d='M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6'></path>
                      <line x1='10' y1='11' x2='10' y2='17'></line>
                      <line x1='14' y1='11' x2='14' y2='17'></line>
                      <path d='M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2'></path>
                    </svg>
                  </a>
                  <a href='up_staff.php?staff_id=" . urlencode($row['staff_id']) . "' title='Update'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                      <path d='M12 20h9'></path>
                      <path d='M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z'></path>
                    </svg>
                  </a>
                  <a href='im.php?staff_id=" . urlencode($row['staff_id']) . "' title='Send Message'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                      <path d='M22 2L11 13'></path>
                      <path d='M22 2L15 22L11 13L2 9L22 2Z'></path>
                    </svg>
                  </a>
                </td>";
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
