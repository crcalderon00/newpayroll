<?php
function sanitise($str, $conn = null) {
    // Use global $conn if not provided
    if ($conn === null) {
        global $conn;
    }

    $str = trim($str);
    return mysqli_real_escape_string($conn, $str);
}
?>
