<?php
if (isset($_POST['submit'])) {
    include('connection.php');
    include('../sanitise.php');

    // Admin name
    $sender = sanitise($_POST['from']);
    // Sent to staff id & receiver
    $staff_id = sanitise($_POST['staff_id']);
    $receiver = sanitise($_POST['fname']);
    // Message subject
    $subject = sanitise($_POST['subject']);
    // Message body
    $message = sanitise($_POST['message']);

    // Insert into admin_outbox
    $insert = "INSERT INTO admin_outbox (staff_id, sender, receiver, msg_subject, msg_msg) 
               VALUES ('$staff_id', '$sender', '$receiver', '$subject', '$message')";
    $insert2 = $conn->query($insert);

    // Insert into staff_inbox
    $insert3 = "INSERT INTO staff_inbox (staff_id, sender, receiver, msg_subject, msg_msg) 
                VALUES ('$staff_id', '$sender', '$receiver', '$subject', '$message')";
    $insert4 = $conn->query($insert3);

    if ($insert2 && $insert4) {
        echo "Message sent";
        header('Location: sentmessages.php');
        exit();
    } else {
        echo "Message not sent: " . $conn->error;
    }
}
?>
