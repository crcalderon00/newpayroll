<?php
session_start();
if (!isset($_SESSION['username'])) {
    die(header('Location: ../index.php'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Sent Messages</title>

<style>
  /* Reset & base */
  *, *::before, *::after {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9fafb;
    color: #1f2937;
  }
  a {
    color: #2563eb;
    text-decoration: none;
  }
  a:hover {
    text-decoration: underline;
  }
  
  #outerwrapper {
    max-width: 1100px;
    margin: 0 auto;
    padding: 20px;
  }

  #header {
    text-align: center;
    padding: 20px 0;
    font-size: 2rem;
    font-weight: 700;
    color: #2563eb;
  }

  /* Navigation */
  nav {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
    margin-bottom: 30px;
  }
  nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
  }
  nav li {
    position: relative;
  }
  nav > ul > li {
    flex: 1;
    min-width: 120px;
  }
  nav a {
    display: block;
    padding: 12px 18px;
    font-weight: 600;
    border-right: 1px solid #e5e7eb;
    transition: background-color 0.3s;
  }
  nav a:last-child {
    border-right: none;
  }
  nav a:hover,
  nav li:hover > a {
    background-color: #e0e7ff;
    color: #1e40af;
  }

  /* Dropdown */
  nav li ul {
    display: none;
    position: absolute;
    background: white;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.15);
    border-radius: 6px;
    top: 100%;
    left: 0;
    min-width: 180px;
    z-index: 1000;
  }
  nav li:hover > ul {
    display: block;
  }
  nav li ul li {
    border: none;
  }
  nav li ul a {
    border: none;
    padding: 10px 15px;
    font-weight: 400;
  }

  /* Table styles */
  table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
  }
  thead {
    background: #2563eb;
    color: white;
  }
  th, td {
    text-align: left;
    padding: 12px 15px;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
    font-size: 0.95rem;
  }
  tbody tr:hover {
    background: #f3f4f6;
  }
  td:last-child a {
    margin-right: 10px;
    color: #2563eb;
    font-weight: 600;
  }
  td:last-child a:hover {
    text-decoration: underline;
  }

  /* Message preview truncation with ellipsis */
  .message-preview {
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Responsive */
  @media (max-width: 768px) {
    nav ul {
      flex-direction: column;
    }
    nav > ul > li {
      min-width: auto;
    }
    table, thead, tbody, th, td, tr {
      display: block;
      width: 100%;
    }
    thead tr {
      display: none; /* hide headers on small screens */
    }
    tbody tr {
      margin-bottom: 20px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
      padding: 15px;
    }
    tbody td {
      padding: 10px 12px;
      border: none;
      display: flex;
      justify-content: space-between;
      font-size: 0.9rem;
      white-space: normal;
    }
    tbody td::before {
      content: attr(data-label);
      font-weight: 600;
      color: #374151;
      flex-basis: 40%;
      max-width: 40%;
    }
    tbody td:last-child {
      text-align: right;
      flex-basis: 60%;
    }
  }

  /* Footer links */
  #footer-links {
    margin-top: 25px;
    text-align: center;
  }
  #footer-links a {
    margin: 0 15px;
    font-weight: 600;
    font-size: 1rem;
  }
</style>
</head>

<body>
<div id="outerwrapper">

  <div id="header">Admin Sent Messages</div>

  <nav>
    <ul>
      <li><a href="index.php">HOME</a></li>
      <li><a href="reg_staff.php">REGISTER STAFF</a></li>
      <li><a href="view_staff.php">VIEW STAFF</a></li>
      <li>
        <a href="payroll.php">PAYROLL ▾</a>
        <ul>
          <li><a href="print.php">Print Slip</a></li>
        </ul>
      </li>
      <li>
        <a href="#">MESSAGE ▾</a>
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
include_once('connection.php');

$qry = $conn->query("SELECT * FROM admin_outbox");

if ($qry && $qry->num_rows > 0) {
    echo "<table>";
    echo "<thead>
            <tr>
              <th>Message ID</th>
              <th>Sender</th>
              <th>Recipient ID</th>
              <th>Recipients</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Date sent</th>
              <th>Action</th>
            </tr>
          </thead>";
    echo "<tbody>";
    while ($row = $qry->fetch_assoc()) {
        echo "<tr>";
        echo "<td data-label='Message ID'>" . htmlspecialchars($row['ao_id']) . "</td>";
        echo "<td data-label='Sender'>" . htmlspecialchars($row['sender']) . "</td>";
        echo "<td data-label='Recipient ID'>" . htmlspecialchars($row['staff_id']) . "</td>";
        echo "<td data-label='Recipients'>" . htmlspecialchars($row['receiver']) . "</td>";
        echo "<td data-label='Subject'>" . htmlspecialchars($row['msg_subject']) . "</td>";
        echo "<td data-label='Message' class='message-preview'>" . htmlspecialchars(substr($row['msg_msg'], 0, 50)) . "...</td>";
        echo "<td data-label='Date sent'>" . htmlspecialchars($row['sent_date']) . "</td>";
        echo "<td data-label='Action'>
                <a href='messagedelete.php?staff_id=" . urlencode($row['staff_id']) . "&ao_id=" . urlencode($row['ao_id']) . "'>Delete</a> | 
                <a href='readmessage.php?staff_id=" . urlencode($row['staff_id']) . "&ao_id=" . urlencode($row['ao_id']) . "'>Read</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p style='text-align:center; font-weight:600;'>No sent messages found.</p>";
}
?>

  <div id="footer-links">
    <a href="index.php">Go Home</a>
    <a href="payroll.php">Calculate Payroll</a>
  </div>

  </div> <!-- #body -->
</div> <!-- #outerwrapper -->

</body>
</html>
