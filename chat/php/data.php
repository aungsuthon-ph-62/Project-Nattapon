<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['id']}
                OR outgoing_msg_id = {$row['id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "ยังไม่มีการสนทนา";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 50) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "คุณ: " : $you = "";
    } else {
        $you = "";
    }
    ($row['chat_status'] == "ไม่ได้ใช้งานในขณะนี้") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['id']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="chat?user_id=' . $row['id'] . '">
                    <div class="content">
                    <img src="../img/user_img/' . $row['img_user'] . '" alt="' . $row['img_user'] . '" loading="lazy">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
