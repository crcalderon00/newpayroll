<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];

// Prepared statement to avoid SQL injection
$stmt = $conn->prepare("SELECT * FROM register_staff WHERE staff_id = ?");
$stmt->bind_param("s", $staff_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Database query failed: " . $conn->error);
}

$staff = $result->fetch_assoc();

$stmt->close();

// Profile image path (assuming you store image filename in DB or else fallback)
$profile_img = '../uploads/profiles/' . ($staff['profile_image'] ?? ''); // adjust field name if different
if (!isset($staff['profile_image']) || empty($staff['profile_image']) || !file_exists($profile_img)) {
    // fallback placeholder image
    $profile_img = '../images/profile-placeholder.png';
}
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
    margin: 0; padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f3f6f8;
    color: #2c3e50;
  }
  #outerwrapper {
    max-width: 800px;
    margin: 40px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
  }
  .profile-image {
    flex: 0 0 220px;
    background: #e1e5ea;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
  }
  .profile-image img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #3498db;
    box-shadow: 0 4px 10px rgba(52, 152, 219, 0.4);
  }
  .profile-details {
    flex: 1;
    padding: 30px 40px;
  }
  .profile-details h1 {
    margin-top: 0;
    color: #2980b9;
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 20px;
  }
  .profile-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .profile-list li {
    padding: 12px 0;
    border-bottom: 1px solid #e0e6ef;
    display: flex;
    justify-content: space-between;
    font-size: 1.1rem;
  }
  .profile-list li:last-child {
    border-bottom: none;
  }
  .profile-list li span.label {
    font-weight: 600;
    color: #34495e;
    min-width: 140px;
  }
  .profile-list li span.value {
    color: #555;
    flex: 1;
    margin-left: 20px;
    text-align: right;
    word-break: break-word;
  }

  /* Responsive */
  @media (max-width: 640px) {
    #outerwrapper {
      flex-direction: column;
      max-width: 95%;
    }
    .profile-image {
      flex: none;
      padding: 20px;
    }
    .profile-image img {
      width: 140px;
      height: 140px;
    }
    .profile-details {
      padding: 20px 25px;
    }
    .profile-list li {
      flex-direction: column;
      align-items: flex-start;
    }
    .profile-list li span.value {
      margin-left: 0;
      margin-top: 5px;
      text-align: left;
    }
  }
</style>
</head>
<body>

<div id="outerwrapper" role="main" aria-label="Staff Profile">
  <div class="profile-image">
    <img src="<?= htmlspecialchars($profile_img) ?>" alt="Profile picture of <?= htmlspecialchars($staff['fname'] ?? 'Staff') ?>" />
  </div>
  <div class="profile-details">
    <h1><?= htmlspecialchars($staff['fname'] ?? 'No Name') ?></h1>
    <?php if ($staff): ?>
    <ul class="profile-list">
      <li><span class="label">Staff ID:</span> <span class="value"><?= htmlspecialchars($staff['staff_id']) ?></span></li>
      <li><span class="label">Sex:</span> <span class="value"><?= htmlspecialchars($staff['sex']) ?></span></li>
      <li><span class="label">Birthday:</span> <span class="value"><?= htmlspecialchars($staff['birthday']) ?></span></li>
      <li><span class="label">Position:</span> <span class="value"><?= htmlspecialchars($staff['position']) ?></span></li>
      <li><span class="label">Department:</span> <span class="value"><?= htmlspecialchars($staff['department']) ?></span></li>
      <li><span class="label">Grade:</span> <span class="value"><?= htmlspecialchars($staff['grade']) ?></span></li>
      <li><span class="label">Years Spent:</span> <span class="value"><?= htmlspecialchars($staff['years']) ?></span></li>
      <li><span class="label">Date Registered:</span> <span class="value"><?= htmlspecialchars($staff['date_registered']) ?></span></li>
    </ul>
    <?php else: ?>
      <p>No staff details found.</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
