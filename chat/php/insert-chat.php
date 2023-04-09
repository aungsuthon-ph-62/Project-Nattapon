<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['id'];
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, send_at)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$date}')") or die();
    }
} else {
    header("location: ../index");
}
