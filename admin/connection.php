<?php
$host = "localhost";
$username = "root";
$password = ""; // Empty string for default XAMPP setup
$db_name = "newsalary";

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
