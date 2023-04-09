<?php
session_start();
require_once '../../php/dateThaiTime.fnc.php';

if (isset($_SESSION['id'])) {
    function format_date($data)
    {
        $dayTH = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์");
        $now = time();
        $date = strtotime($data);
        $diff = $now - $date;
        $same_day = date('Y-m-d', $now) === date('Y-m-d', $date);

        if ($same_day) {
            return date('H:i', $date);
        } else {
            $week = date("w", $date);
            $time = date('H:i', $date);
            return "วัน$dayTH[$week]"." "."$time";
        }
    };

    include_once "config.php";
    $outgoing_id = $_SESSION['id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN user ON user.id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                    <small class="text-out-end"> ส่งเมื่อ ' . format_date($row['send_at']) . '</small>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="../img/user_img/' . $row['img_user'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                    <small class="text-in-start"> ส่งเมื่อ ' . format_date($row['send_at']) . '</small>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">ยังไม่มีการสนทนา <br>ส่งข้อความเพื่อเริ่มต้นการสนทนา!</div>';
    }
    echo $output;
} else {
    header("location: ../index");
}
