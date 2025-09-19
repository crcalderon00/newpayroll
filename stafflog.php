<?php
include('admin/connection.php'); // Make sure this sets $conn (mysqli connection)
include('sanitise.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs with $conn
    $staff_id = sanitise($_POST['staff_id'], $conn);
    $username = sanitise($_POST['username'], $conn);
    $password = sanitise($_POST['password'], $conn);

    // Use mysqli_* functions for query and result
    $qry = mysqli_query($conn, "SELECT * FROM register_staff WHERE staff_id = '$staff_id' AND username = '$username' AND password = '$password'");

    if (!$qry) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $count = mysqli_num_rows($qry);

    if ($count == 1) {
        session_start();
        $_SESSION['staff_id'] = $staff_id;
        header('Location: employee/index.php');
        exit();
    } else {
        echo "Invalid login";
    }
} else {
    echo "Please submit the form.";
}
?>
