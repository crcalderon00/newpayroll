<?php
include('admin/connection.php');
include('sanitise.php');

// Sanitize input using the correct connection
$username = sanitise($_POST['username'], $conn);
$password = sanitise($_POST['password'], $conn);

// Query the database
$qry = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

if (!$qry) {
    die("Query failed: " . mysqli_error($conn));
}

$count = mysqli_num_rows($qry);

if ($count == 1) {
    session_start();
    $_SESSION['username'] = $username;
    header('Location: admin/index.php');
    exit();
} else {
    echo "Invalid username or password";
}
?>
