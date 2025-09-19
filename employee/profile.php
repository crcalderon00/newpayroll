<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];

// Handle photo upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo'])) {
    $targetDir = "../uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $fileName = basename($_FILES["profile_photo"]["name"]);
    $targetFile = $targetDir . $staff_id . "_" . $fileName;

    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
        $relativePath = "uploads/" . $staff_id . "_" . $fileName;
        $update = "UPDATE register_staff SET profile_photo = '$relativePath' WHERE staff_id = '$staff_id'";
        mysqli_query($conn, $update);
    } else {
        echo "Error uploading file.";
    }
}

// Fetch staff data
$qry = mysqli_query($conn, "SELECT * FROM register_staff WHERE staff_id = '$staff_id'");
if (!$qry) {
    die("Query failed: " . mysqli_error($conn));
}
$tbl = mysqli_fetch_assoc($qry);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Staff Profile</title>
<link rel="stylesheet" href="../css/staff.css" type="text/css" />
</head>
<body>
<div id="outerwrapper">
<div id="header"><img src="../images/staffhead.jpg" alt="Staff Header" /></div>
<div id="links"><?php include('link.php'); ?></div>
<div id="body">
  <table border="1" align="center" cellpadding="5" cellspacing="3">
    <tr>
      <td colspan="2" align="center">
        <?php if (!empty($tbl['profile_photo'])) { ?>
          <img src="../<?php echo htmlspecialchars($tbl['profile_photo']); ?>" width="150" height="150" style="border-radius:50%;" />
        <?php } else { ?>
          <img src="../images/default.png" width="150" height="150" style="border-radius:50%;" />
        <?php } ?>
        <form method="post" enctype="multipart/form-data">
          <input type="file" name="profile_photo" required>
          <button type="submit">Upload Photo</button>
        </form>
      </td>
    </tr>
    <tr><td><strong>Staff ID</strong></td><td><?php echo htmlspecialchars($tbl['staff_id']); ?></td></tr>
    <tr><td><strong>Name</strong></td><td><?php echo htmlspecialchars($tbl['fname']); ?></td></tr>
    <tr><td><strong>Sex</strong></td><td><?php echo htmlspecialchars($tbl['sex']); ?></td></tr>
    <tr><td><strong>Birthday</strong></td><td><?php echo htmlspecialchars($tbl['birthday']); ?></td></tr>
    <tr><td><strong>Position</strong></td><td><?php echo htmlspecialchars($tbl['position']); ?></td></tr>
    <tr><td><strong>Department</strong></td><td><?php echo htmlspecialchars($tbl['department']); ?></td></tr>
    <tr><td><strong>Grade</strong></td><td><?php echo htmlspecialchars($tbl['grade']); ?></td></tr>
    <tr><td><strong>Years Spent</strong></td><td><?php echo htmlspecialchars($tbl['years']); ?></td></tr>
    <tr><td><strong>Date Registered</strong></td><td><?php echo htmlspecialchars($tbl['date_registered']); ?></td></tr>
  </table>
</div>
</div>
</body>
</html>
