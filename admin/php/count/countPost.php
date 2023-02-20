<?php

function countPost($conn)
{

    $postQuery = "SELECT COUNT(id) AS noPosts FROM post_tbl";
    $postsResult = mysqli_query($conn, $postQuery) or die("database error:" . mysqli_error($conn));
    
    return $postsResult;
}
