<?php
include('../admin/connection.php');
session_start();

if (!isset($_SESSION['staff_id'])) {
    header('Location: ../index.php');
    exit();
}

$staff_id = $_SESSION['staff_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Reset Password</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f7f8;
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
  }
  form {
    background: #fff;
    padding: 30px 40px;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
  }
  h2 {
    margin-top: 0;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
  }
  label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #444;
  }
  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }
  input[type="text"]:focus,
  input[type="password"]:focus {
    border-color: #3498db;
    outline: none;
  }
  input[type="submit"] {
    background-color: #3498db;
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
    border: none;
    padding: 12px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
  }
  input[type="submit"]:hover {
    background-color: #2980b9;
  }
  .info-text {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 15px;
    text-align: center;
  }
</style>
</head>
<body>

<form action="reset.php" method="post" autocomplete="off" aria-label="Reset Password Form">
  <h2>Reset Password</h2>

  <label for="staff_id">Staff ID</label>
  <input 
    type="text" 
    id="staff_id" 
    name="staff_id" 
    value="<?= htmlspecialchars($staff_id) ?>" 
    readonly 
    aria-readonly="true"
  />

  <label for="password">New Password</label>
  <input 
    type="password" 
    id="password" 
    name="password" 
    required 
    minlength="6" 
    placeholder="Enter your new password"
    aria-describedby="passwordHelp"
  />
  <div id="passwordHelp" class="info-text">Password must be at least 6 characters</div>

  <input type="submit" value="Reset Password" />
</form>

</body>
</html>
