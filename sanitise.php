<?php
function sanitise($str, $conn) {
    $str = trim($str);
    return mysqli_real_escape_string($conn, $str);
}
?>
