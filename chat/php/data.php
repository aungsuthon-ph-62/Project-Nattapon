<?php
function format_date($data) {
    date_default_timezone_set('Asia/Bangkok');
    $date1 = date_create_from_format('Y-m-d H:i:s', $data);
    $date2 = date_create(date('Y-m-d H:i:s'));
    $diff = date_diff($date1, $date2);



    if ($diff->y > 0) {
        return " · " . $diff->format('%y year' . ($diff->y > 1 ? '' : ''));
    } else if ($diff->m > 0) {
        return " · " . $diff->format('%m month' . ($diff->m > 1 ? '' : ''));
    } else if ($diff->d > 0) {
        return " · " . $diff->format('%d วัน' . ($diff->d > 1 ? '' : ''));
    } else if ($diff->h > 0) {
        return " · " . $diff->format('%h ชั่วโมง' . ($diff->h > 1 ? '' : ''));
    } else if ($diff->i > 0) {
        return " · " . $diff->format('%i นาที' . ($diff->h > 1 ? '' : ''));
    } else {
        return " · " . "เมื่อสักครู่";
    }
}
;

while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['id']}
                OR outgoing_msg_id = {$row['id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "ยังไม่มีการสนทนา";
    (strlen($result) > 48) ? $msg =  substr($result, 0, 48) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "คุณ: " : $you = "";
    } else {
        $you = "";
    }
    if (isset($row2['incoming_msg_id'])) {
        ($outgoing_id == $row2['incoming_msg_id']) ? $opp = "opp" : $opp = "";
    } else {
        $opp = "";
    }
    ($row['chat_status'] == "ไม่ได้ใช้งานในขณะนี้") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['id']) ? $hid_me = "hide" : $hid_me = "";

    if (isset($row2['send_at'])) {
        $date_time = Format_date($row2['send_at']);
        $last_msg = "" . "" . $date_time;
    } else {
        $last_msg = "";
    };

    $output .= '<a href="chat?user_id=' . $row['id'] . '">
                    <div class="content">
                    <img src="../img/user_img/' . $row['img_user'] . '" alt="' . $row['img_user'] . '" loading="lazy">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p class='.$opp.'>' . $you . $msg . '<span>' . $last_msg . '</span></p>                                          
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
