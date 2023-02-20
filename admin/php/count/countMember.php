<?php

function countMember($conn)
{

    $memberQuery = "SELECT COUNT(id) AS noMember FROM user";
    $memberResult = mysqli_query($conn, $memberQuery) or die("database error:" . mysqli_error($conn));
    
    return $memberResult;
}
