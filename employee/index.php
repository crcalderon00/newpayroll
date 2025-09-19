<?php
include('../admin/connection.php');

session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];

// Use prepared statement to fetch staff details
$stmt = $conn->prepare("SELECT * FROM register_staff WHERE staff_id = ?");
$stmt->bind_param("s", $staff_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die('Database error: ' . $conn->error);
}

$staff = $result->fetch_assoc();

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Staff Profile</title>
  <style>
    /* Reset */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    body {
      margin: 0; 
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      color: #333;
      line-height: 1.6;
    }
    a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 600;
    }
    a:hover, a:focus {
      text-decoration: underline;
      outline: none;
    }

    /* Container */
    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    /* Header image */
    .header-image {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 30px;
      object-fit: cover;
    }

    /* Navigation placeholder */
    nav {
      margin-bottom: 30px;
      text-align: center;
    }
    nav a {
      margin: 0 15px;
      font-size: 1.1rem;
      padding: 8px 15px;
      background-color: #e0e7ff;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }
    nav a:hover {
      background-color: #c7d2fe;
    }

    /* Flex layout for main content */
    .profile-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      justify-content: center;
      align-items: flex-start;
    }

    /* Sidebar */
    .sidebar {
      flex: 0 0 220px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }
    .sidebar img {
      width: 180px;
      height: 180px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border: 3px solid #2563eb;
    }
    .sidebar a {
      display: block;
      width: 100%;
      padding: 12px 0;
      text-align: center;
      background-color: #2563eb;
      color: white;
      border-radius: 8px;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
      transition: background-color 0.25s ease;
    }
    .sidebar a:hover, .sidebar a:focus {
      background-color: #1d4ed8;
      box-shadow: 0 6px 15px rgba(29, 78, 216, 0.5);
    }

    /* Staff info card */
    .info-card {
      flex: 1 1 400px;
      background: #f9fafb;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .info-card h2 {
      margin-top: 0;
      margin-bottom: 20px;
      font-weight: 700;
      color: #1e293b;
      border-bottom: 2px solid #2563eb;
      padding-bottom: 8px;
    }
    .info-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .info-list li {
      margin-bottom: 14px;
      font-size: 1.1rem;
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding-bottom: 8px;
      color: #475569;
    }
    .info-list li strong {
      color: #334155;
      min-width: 130px;
      font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 720px) {
      .profile-wrapper {
        flex-direction: column;
        align-items: center;
      }
      .sidebar, .info-card {
        width: 100%;
        max-width: 400px;
      }
    }
  </style>
</head>
<body>

  <div class="container">

    <img src="../images/staffhead.jpg" alt="Staff Header Banner" class="header-image" />

    <nav aria-label="Main navigation">
      <!-- Replace these links with your own navigation -->
      <a href="index.php">Home</a>
      <a href="profile.php">Profile</a>
      <a href="resetpassword.php">Change Password</a>
      <a href="../logout.php">Logout</a>
    </nav>

    <div class="profile-wrapper">

      <aside class="sidebar" aria-label="Staff actions">
        <img src="../images/UlIqmHJn-SK.gif" alt="Staff Profile Photo" />
        <a href="profile.php" tabindex="0">View Complete Profile</a>
        <a href="resetpassword.php" class="bx2" rel="470-200" tabindex="0">Change Password</a>
      </aside>

      <section class="info-card" aria-labelledby="profile-title">
        <h2 id="profile-title">Staff Profile Details</h2>
        <?php if ($staff): ?>
        <ul class="info-list">
          <li><strong>Staff ID:</strong> <span><?=htmlspecialchars($staff['staff_id'])?></span></li>
          <li><strong>Full Name:</strong> <span><?=htmlspecialchars($staff['fname'])?></span></li>
          <li><strong>Department:</strong> <span><?=htmlspecialchars($staff['department'])?></span></li>
          <li><strong>Position:</strong> <span><?=htmlspecialchars($staff['position'])?></span></li>
          <li><strong>Date Joined:</strong> <span><?=htmlspecialchars($staff['date_registered'])?></span></li>
        </ul>
        <?php else: ?>
          <p style="text-align:center; color:#888;">Staff details not found.</p>
        <?php endif; ?>
      </section>

    </div>

  </div>

  <script src="../css/mootools.js"></script> 
  <script src="../css/bumpbox-2.0.1.js"></script> 
  <script>
    doBump('.bx2', 850, 500, 'FFF', '6b7477', 0.7, 7, 2, '333', 15, '000', 2, Fx.Transitions.Back.easeOut, Fx.Transitions.linear);
  </script>

</body>
</html>
