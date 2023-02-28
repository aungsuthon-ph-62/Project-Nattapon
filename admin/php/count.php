<?php

function countPost($conn)
{

    $postQuery = "SELECT COUNT(id) AS noPosts FROM post_tbl";
    $postsResult = mysqli_query($conn, $postQuery) or die("database error:" . mysqli_error($conn));
    
    return $postsResult;
}


function countMember($conn)
{

    $memberQuery = "SELECT COUNT(id) AS noMember FROM user";
    $memberResult = mysqli_query($conn, $memberQuery) or die("database error:" . mysqli_error($conn));
    
    return $memberResult;
}


function countReview($conn)
{

    $sql = "SELECT COUNT(comment_id) AS noReview FROM comment";
    $result = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    
    return $result;
}
