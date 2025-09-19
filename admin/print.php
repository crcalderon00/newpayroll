<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

// Database connection
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Print PaySlip</title>

<style>
  /* Reset */
  *, *::before, *::after {
    box-sizing: border-box;
  }
  body, html {
    margin: 0; padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9fafb;
    min-height: 100vh;
    display: flex;
    justify-content: center; /* horizontally center wrapper */
    align-items: flex-start;
  }
  
  /* Outer wrapper */
  #outerwrapper {
    width: 100%;
    max-width: 1200px;
    margin: 30px 20px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center; /* center content inside */
  }

  /* Header */
  #header {
    width: 100%;
    height: 60px;
    background-color: #2563eb;
    border-radius: 10px 10px 0 0;
    margin-bottom: 25px;
  }

  /* Navigation */
  #links {
    width: 100%;
    margin-bottom: 30px;
  }
  ul#MenuBar1 {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center; /* center nav horizontally */
    gap: 25px;
    background: #e0e7ff;
    border-radius: 10px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
  }
  ul#MenuBar1 li {
    position: relative;
  }
  ul#MenuBar1 > li > a {
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    color: #2563eb;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  ul#MenuBar1 > li > a:hover,
  ul#MenuBar1 > li > a:focus {
    background-color: #2563eb;
    color: #fff;
    outline: none;
  }

  /* Dropdown submenu */
  ul.MenuBarItemSubmenu > ul {
    display: none;
    position: absolute;
    top: 110%;
    left: 0;
    background: #2563eb;
    border-radius: 8px;
    min-width: 160px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    z-index: 1000;
  }
  ul.MenuBarItemSubmenu:hover > ul,
  ul.MenuBarItemSubmenu:focus-within > ul {
    display: block;
  }
  ul.MenuBarItemSubmenu > ul > li > a {
    padding: 10px 18px;
    font-weight: 500;
    color: white;
    display: block;
    border-radius: 6px;
  }
  ul.MenuBarItemSubmenu > ul > li > a:hover,
  ul.MenuBarItemSubmenu > ul > li > a:focus {
    background: #1e40af;
    outline: none;
  }

  /* Main body content */
  #body {
    width: 100%;
    overflow-x: auto; /* horizontal scroll if needed */
  }

  /* Table styling */
  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
  }
  thead tr {
    background-color: #2563eb;
    color: #fff;
    font-weight: 600;
  }
  th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
    vertical-align: middle;
  }
  tbody tr:hover {
    background-color: #f3f6ff;
  }
  a {
    color: #2563eb;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.25s;
  }
  a:hover {
    color: #1e40af;
    text-decoration: underline;
  }

  /* Responsive adjustments */
  @media (max-width: 900px) {
    ul#MenuBar1 {
      flex-wrap: wrap;
      gap: 15px;
    }
    th, td {
      padding: 10px 12px;
      font-size: 0.85rem;
    }
  }
  @media (max-width: 600px) {
    body, html {
      align-items: flex-start;
      padding: 10px;
    }
    #outerwrapper {
      margin: 15px 10px;
      padding: 20px 15px;
    }
    table {
      font-size: 0.8rem;
    }
  }
</style>

<script type="text/javascript">
  var MenuBar1;
  window.onload = function() {
    if(typeof Spry !== 'undefined' && Spry.Widget && Spry.Widget.MenuBar) {
      MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {
        imgDown:"../../SpryAssets/SpryMenuBarDownHover.gif",
        imgRight:"../../SpryAssets/SpryMenuBarRightHover.gif"
      });
    }
  };
</script>
</head>
<body>
  <div id="outerwrapper">
    <div id="header"></div>

    <nav id="links">
      <ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="index.php">HOME</a></li>
        <li><a href="reg_staff.php">REGISTER STAFF</a></li>
        <li><a href="view_staff.php">VIEW STAFF</a></li>
        <li class="MenuBarItemSubmenu"><a href="payroll.php">PAYROLL</a>
          <ul>
            <li><a href="print.php">Print Slip</a></li>
          </ul>
        </li>
        <li class="MenuBarItemSubmenu"><a href="#">MESSAGE</a>
          <ul>
            <li><a href="inbox.php">Inbox</a></li>
            <li><a href="sentmessages.php">Sent</a></li>
          </ul>
        </li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>

    <main id="body">
      <?php
      $qry = mysqli_query($conn, "SELECT * FROM salary") or die(mysqli_error($conn));

      if (mysqli_num_rows($qry) > 0) {
          echo "<table>
          <thead>
            <tr>
              <th>SID</th>
              <th>ID</th>
              <th>Full Name</th>
              <th>Dept</th>
              <th>Position</th>
              <th>Grade</th>
              <th>Years</th>
              <th>Basic</th>
              <th>Meal All.</th>
              <th>Housing All.</th>
              <th>Transport All.</th>
              <th>Ent. All</th>
              <th>LS All</th>
              <th>Tax</th>
              <th>Total</th>
              <th>Date</th>
              <th>Delete</th>
              <th>Print</th>
            </tr>
          </thead>
          <tbody>";

          while ($row = mysqli_fetch_assoc($qry)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['salary_id']) . "</td>";
              echo "<td>" . htmlspecialchars($row['staff_id']) . "</td>";
              echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
              echo "<td>" . htmlspecialchars($row['department']) . "</td>";
              echo "<td>" . htmlspecialchars($row['position']) . "</td>";
              echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
              echo "<td>" . htmlspecialchars($row['years']) . "</td>";
              echo "<td>" . round($row['basic']) . "</td>";
              echo "<td>" . round($row['meal']) . "</td>";
              echo "<td>" . round($row['housing']) . "</td>";
              echo "<td>" . round($row['transport']) . "</td>";
              echo "<td>" . round($row['entertainment']) . "</td>";
              echo "<td>" . round($row['long_service']) . "</td>";
              echo "<td>" . round($row['tax']) . "</td>";
              echo "<td>" . round($row['totall']) . "</td>";
              echo "<td>" . htmlspecialchars($row['date_s']) . "</td>";
              echo "<td><a href='salary_delete.php?salary_id=" . urlencode($row['salary_id']) . "&staff_id=" . urlencode($row['staff_id']) . "'>Delete</a></td>";
              echo "<td><a href='payslip.php?staff_id=" . urlencode($row['staff_id']) . "&salary_id=" . urlencode($row['salary_id']) . "'>Print</a></td>";
              echo "</tr>";
          }

          echo "</tbody></table>";
      } else {
          echo "<p style='text-align:center; color:#6b7280; font-weight:600;'>No salary records found.</p>";
      }
      ?>
    </main>
  </div>
</body>
</html>
