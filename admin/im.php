<?php
include('../sanitise.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

include('connection.php');

$admin = $_SESSION['username'];
$staff_id = isset($_GET['staff_id']) ? sanitise($_GET['staff_id']) : '';

if (!$staff_id) {
    die("Invalid staff ID.");
}

$stmt = $conn->prepare("SELECT staff_id, fname FROM register_staff WHERE staff_id = ?");
$stmt->bind_param("s", $staff_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Staff member not found.");
}

$staff = $result->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Send Message</title>

<style>
  /* Reset & base */
  *, *::before, *::after {
    box-sizing: border-box;
  }
  body {
    margin: 0; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 15px;
    min-height: 100vh;
    color: #1f2937;
  }

  /* Form container */
  form {
    background: #fff;
    padding: 30px 35px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
    max-width: 500px;
    width: 100%;
  }

  /* Heading */
  h1 {
    margin-top: 0;
    margin-bottom: 25px;
    font-weight: 700;
    font-size: 1.8rem;
    color: #111827;
    text-align: center;
  }

  /* Form groups */
  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #374151;
  }

  input[type="text"],
  textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid #d1d5db;
    border-radius: 7px;
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.3s ease;
  }
  
  input[type="text"]:focus,
  textarea:focus {
    border-color: #2563eb;
    outline: none;
  }

  input[readonly] {
    background-color: #e5e7eb;
    cursor: not-allowed;
  }

  textarea {
    min-height: 120px;
    resize: vertical;
  }

  /* Button */
  button[type="submit"] {
    width: 100%;
    background-color: #2563eb;
    color: #fff;
    border: none;
    padding: 14px 0;
    font-size: 1.1rem;
    font-weight: 700;
    border-radius: 7px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button[type="submit"]:hover {
    background-color: #1e40af;
  }

  /* Back link */
  .back-link {
    display: block;
    margin-top: 22px;
    text-align: center;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
    user-select: none;
  }
  .back-link:hover {
    text-decoration: underline;
  }
</style>

<script>
function confirmSend() {
  const staffId = "<?php echo htmlspecialchars($staff_id, ENT_QUOTES); ?>";
  return confirm(`Do you want to send message to Staff Id ${staffId}?`);
}
</script>

</head>
<body>

<form method="post" action="sentmessages.php" onsubmit="return confirmSend();">

  <h1>Send Message</h1>

  <div class="form-group">
    <label for="from">From</label>
    <input type="text" id="from" name="from" value="<?php echo htmlspecialchars($admin); ?>" readonly />
  </div>

  <div class="form-group">
    <label for="staff_id">Staff ID</label>
    <input type="text" id="staff_id" name="staff_id" value="<?php echo htmlspecialchars($staff['staff_id']); ?>" readonly required />
  </div>

  <div class="form-group">
    <label for="fname">To</label>
    <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($staff['fname']); ?>" readonly required />
  </div>

  <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" placeholder="Enter message subject" required />
  </div>

  <div class="form-group">
    <label for="message">Message</label>
    <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>
  </div>

  <button type="submit">Send Message</button>

  <a href="view_staff.php" class="back-link">&larr; Back to Staff List</a>
</form>

</body>
</html>
