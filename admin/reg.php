<?php
if (isset($_POST['submit'])) {
    // Database connection
    include('connection.php');  // This file should create $conn (mysqli connection)
    include('../sanitise.php');

    // Sanitize input with $conn as second argument
    $fname = sanitise($_POST['fname'], $conn);
    $sex = sanitise($_POST['sex'], $conn);
    $birthday = sanitise($_POST['birthday'], $conn);
    $department = sanitise($_POST['department'], $conn);
    $position = sanitise($_POST['position'], $conn);
    $grade = sanitise($_POST['grade'], $conn);
    $years = sanitise($_POST['years'], $conn);
    $username = sanitise($_POST['username'], $conn);
    $password = sanitise($_POST['password'], $conn);

    // Hash the password for security
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Use mysqli_query (not mysql_query, which is deprecated)
    $qry = "INSERT INTO register_staff (fname, sex, birthday, department, position, grade, years, username, password) 
            VALUES ('$fname', '$sex', '$birthday', '$department', '$position', '$grade', '$years', '$username', '$password')";

    $result = mysqli_query($conn, $qry);

    if ($result) {
        echo "Staff has been successfully registered";
        echo "<a href='view_staff.php'> View </a>";
    } else {
        echo "Registration was not completed, please try again";
        echo "<a href='index.php'>Home</a>";
    }

    // Close connection
    mysqli_close($conn);
}
?>
