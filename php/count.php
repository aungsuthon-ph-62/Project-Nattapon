<?php

function countComments($conn, $id)
{

    $sql = "SELECT COUNT(post_ref) AS noComments FROM comment WHERE post_ref = '$id'";

    $result = mysqli_query($conn, $sql);

    return $result;
}

function countView($conn, $page)
{
    $sql = "UPDATE post_tbl SET post_view=post_view + 1 WHERE post_unid = '$page'";
    mysqli_query($conn, $sql);
}

function countRating($rating)
{

    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    
    foreach ($rating as $row) {


        if ($row["user_rating"] == '5') {
            $five_star_review++;
        }

        if ($row["user_rating"] == '4') {
            $four_star_review++;
        }

        if ($row["user_rating"] == '3') {
            $three_star_review++;
        }

        if ($row["user_rating"] == '2') {
            $two_star_review++;
        }

        if ($row["user_rating"] == '1') {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row["user_rating"];
    }

    $average_rating = $total_user_rating / $total_review;
}
