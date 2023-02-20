<?php

function faculty($conn, $id)
{
    $sql = "SELECT cf.cf_postref, cf.cf_name, fac.id, fac.faculty_name
    FROM category_faculty as cf 
    INNER JOIN faculty as fac ON fac.id = cf.cf_name
    WHERE cf.cf_postref = '$id'";
    $faculty = mysqli_query($conn, $sql);
    
    return $faculty;
}
