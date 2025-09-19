<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Staff</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

  <style>
    /* Reset and base */
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
      background: #fff;
      max-width: 700px;      /* Wider container */
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
      padding: 32px 28px;
      box-sizing: border-box;
    }

    h1 {
      font-weight: 700;
      font-size: 1.75rem;
      margin-bottom: 24px;
      color: #111827;
      text-align: center;
    }

    form {
      width: 100%;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #374151;
      font-size: 0.9rem;
    }

    input[type="text"],
    input[type="password"],
    input[type="date"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px 14px;
      font-size: 1rem;
      border: 1.5px solid #d1d5db;
      border-radius: 8px;
      transition: border-color 0.2s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="date"]:focus,
    input[type="number"]:focus,
    select:focus {
      border-color: #2563eb;
      outline: none;
      box-shadow: 0 0 6px #93c5fd;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .submit-btn {
      width: 100%;
      background-color: #2563eb;
      color: white;
      padding: 12px 0;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background-color 0.3s;
      user-select: none;
    }

    .submit-btn:hover {
      background-color: #1e40af;
    }

    /* Navigation menu styled like Home page */
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
    /* Dropdown style if you want to add submenus */
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

    /* Responsive */
    @media (max-width: 700px) {
      #outerwrapper {
        max-width: 100%;
        padding: 24px 16px;
      }
      #MenuBar1 {
        flex-wrap: wrap;
      }
    }
  </style>

  <script>
    function confirmRegister() {
      return confirm('Click to confirm registration');
    }
  </script>
</head>

<body>
  <div id="outerwrapper">
    <nav id="links">
      <ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="index.php">HOME</a></li>
        <li><a href="reg_staff.php" aria-current="page">REGISTER STAFF</a></li>
        <li><a href="view_staff.php">VIEW STAFF</a></li>
        <li><a href="payroll.php">PAYROLL</a></li>
        <li><a href="inbox.php">MESSAGE</a></li>
        <li><a href="../logout.php">LOGOUT</a></li>
      </ul>
    </nav>

    <h1>Register Staff</h1>

    <form name="register" action="reg.php" method="post" onsubmit="return confirmRegister()">
      
      <div class="form-group">
        <label for="fname">Full Name *</label>
        <input type="text" name="fname" id="fname" required placeholder="Enter full name" autocomplete="name" />
      </div>

      <div class="form-group">
        <label for="sex">Sex *</label>
        <select name="sex" id="sex" required>
          <option value="" disabled selected>Select sex</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>

      <div class="form-group">
        <label for="birthday">Birthday *</label>
        <input type="date" name="birthday" id="birthday" required />
      </div>

      <div class="form-group">
        <label for="department">Department *</label>
        <select name="department" id="department" required>
          <option value="" disabled selected>Select Department</option>
          <option value="Human Resources">Human Resources</option>
          <option value="I.T.">I.T.</option>
          <option value="Accounting">Accounting</option>
          <option value="Research & Development">Research & Development</option>
          <option value="Administration">Administration</option>
          <option value="Marketing">Marketing</option>
          <option value="Production">Production</option>
        </select>
      </div>

      <div class="form-group">
        <label for="position">Position *</label>
        <select name="position" id="position" required>
          <option value="" disabled selected>Select Position</option>
          <option value="Director">Director</option>
          <option value="As. Director">As. Director</option>
          <option value="Manager">Manager</option>
          <option value="As.Manager">As. Manager</option>
          <option value="Supervisor">Supervisor</option>
          <option value="Head">Head</option>
          <option value="Ass. Head">Ass. Head</option>
          <option value="Clerk">Clerk</option>
        </select>
      </div>

      <div class="form-group">
        <label for="grade">Grade Level *</label>
        <input type="text" name="grade" id="grade" required placeholder="Enter grade level" />
      </div>

      <div class="form-group">
        <label for="years">Years Spent *</label>
        <input type="number" name="years" id="years" required min="0" placeholder="Years spent in position" />
      </div>

      <div class="form-group">
        <label for="username">Username *</label>
        <input type="text" name="username" id="username" required placeholder="Choose username" autocomplete="username" />
      </div>

      <div class="form-group">
        <label for="password">Password * (min 7 chars)</label>
        <input type="password" name="password" id="password" required minlength="7" placeholder="Create a password" autocomplete="new-password" />
      </div>

      <button type="submit" class="submit-btn">Register Staff</button>
    </form>
  </div>
</body>
</html>
