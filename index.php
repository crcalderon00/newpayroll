<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login to your account</title>

<style>
  /* Reset & base */
  * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-size: cover;
    color: #333;
  }
  #login {
    max-width: 380px;
    margin: 100px auto;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    overflow: hidden;
  }
  
  /* Tabs container */
  .tabs {
    display: flex;
    background: #2c3e50;
  }
  .tab {
    flex: 1;
    padding: 15px;
    text-align: center;
    cursor: pointer;
    color: #ecf0f1;
    font-weight: 600;
    user-select: none;
    transition: background 0.3s;
  }
  .tab:hover {
    background: #34495e;
  }
  .tab.active {
    background: #ecf0f1;
    color: #2c3e50;
  }
  
  /* Content areas */
  .tab-content {
    padding: 25px 30px 35px;
  }
  
  /* Forms */
  form {
    display: flex;
    flex-direction: column;
  }
  h4 {
    margin-top: 0;
    margin-bottom: 20px;
    font-weight: 700;
    color: #2c3e50;
    text-align: center;
  }
  
  label {
    margin-bottom: 5px;
    font-weight: 600;
  }
  input[type="text"],
  input[type="password"] {
    padding: 10px;
    margin-bottom: 15px;
    border: 1.8px solid #bdc3c7;
    border-radius: 5px;
    font-size: 15px;
    transition: border-color 0.3s;
  }
  input[type="text"]:focus,
  input[type="password"]:focus {
    border-color: #2980b9;
    outline: none;
  }
  
  input[type="submit"] {
    background: #2980b9;
    color: white;
    font-weight: 700;
    padding: 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s;
  }
  input[type="submit"]:hover {
    background: #1f6391;
  }
  
  /* Reset password link */
  .reset-link {
    margin-top: 10px;
    text-align: right;
  }
  .reset-link a {
    color: #2980b9;
    text-decoration: none;
    font-size: 14px;
  }
  .reset-link a:hover {
    text-decoration: underline;
  }
  
  /* Responsive */
  @media (max-width: 450px) {
    #login {
      margin: 50px 10px;
    }
  }
</style>
</head>
<body>

<div id="login">
  <div class="tabs">
    <div class="tab active" data-tab="admin">Administrator Login</div>
    <div class="tab" data-tab="staff">Staff Login</div>
  </div>
  
  <div class="tab-content" id="admin" style="display: block;">
    <form method="post" action="login.php">
      <h4>ADMINISTRATOR LOGIN</h4>
      <label for="admin-username">Username</label>
      <input type="text" name="username" id="admin-username" required />
      
      <label for="admin-password">Password</label>
      <input type="password" name="password" id="admin-password" required />
      
      <input type="submit" name="submit" value="Login" />
    </form>
  </div>
  
  <div class="tab-content" id="staff" style="display: none;">
    <form method="post" action="stafflog.php">
      <h4>STAFF LOGIN</h4>
      
      <label for="staff-id">Staff ID</label>
      <input type="text" name="staff_id" id="staff-id" required />
      
      <label for="staff-username">Username</label>
      <input type="text" name="username" id="staff-username" required />
      
      <label for="staff-password">Password</label>
      <input type="password" name="password" id="staff-password" required />
      
      <input type="submit" name="submit" value="Login" />
      
      <div class="reset-link">
        <a href="resetpassword.php">Reset password</a>
      </div>
    </form>
  </div>
</div>

<script>
  // Simple tabs logic
  const tabs = document.querySelectorAll('.tab');
  const contents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // Remove active class from all tabs
      tabs.forEach(t => t.classList.remove('active'));
      // Hide all contents
      contents.forEach(c => (c.style.display = 'none'));

      // Activate clicked tab and corresponding content
      tab.classList.add('active');
      document.getElementById(tab.getAttribute('data-tab')).style.display = 'block';
    });
  });
</script>

</body>
</html>
