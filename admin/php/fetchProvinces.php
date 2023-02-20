<?php

function provinces($conn, $id)
{
    $psql = "SELECT cp_postref, cp_name
        FROM category_provinces
        WHERE cp_postref = '$id'";
    $provicesResult = mysqli_query($conn, $psql);

    return $provicesResult;
}
