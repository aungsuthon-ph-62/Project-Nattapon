<?php 

function countComments($conn, $id)
{

    $sql = "SELECT COUNT(post_ref) AS noComments FROM comment WHERE post_ref = '$id'";

    $result = mysqli_query($conn, $sql);

    return $result;
}