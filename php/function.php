<?php 
    require_once "php/conn.php";

    function user($id) {
        global $conn;

        $query = "SELECT * FROM user WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        return $user;
    }

?>