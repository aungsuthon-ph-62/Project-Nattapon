<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['id'];
    $role = $_SESSION['role'];

    if ($role != 'Member')
    {
        $search_role = 'Member';
    }else {
        $search_role = 'Admin';
    }

    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM user WHERE NOT id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') AND status = '$search_role'";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'ไม่พบผู้ใช้ที่คุณค้นหา!';
    }
    echo $output;
?>