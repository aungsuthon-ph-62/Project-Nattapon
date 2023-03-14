<?php

if (isset($_POST['search'])) {
    $input = $_POST['search'];
    header("Location: ../index?page=search&search=$input");
    exit;
}

function fetchUser($conn, $id)
{
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $user = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    return $user;
}

function fetchMainPost($conn, $start, $perpage)
{
    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref, 
u.fname, u.lname, u.status, p.post_view, p.post_rating
FROM post_tbl as p 
INNER JOIN user as u ON u.id = p.post_by 
WHERE p.post_rating < '4'
ORDER BY p.id DESC 
LIMIT {$start}, {$perpage}";
    $post = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));


    return $post;
}

function fetchStarPost($conn, $start, $perpage)
{
    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref, 
u.fname, u.lname, u.status, p.post_view, p.post_rating
FROM post_tbl as p 
INNER JOIN user as u ON u.id = p.post_by 
WHERE p.post_rating >= '4'
ORDER BY p.id DESC 
LIMIT {$start}, {$perpage}";
    $post = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));


    return $post;
}

function fetchPost($conn, $limit)
{
    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref, 
u.fname, u.lname, u.status, p.post_view, p.post_rating
FROM post_tbl as p 
INNER JOIN user as u ON u.id = p.post_by 
ORDER BY p.id DESC 
LIMIT {$limit}";
    $post = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));


    return $post;
}

function post($conn, $unid)
{
    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref, 
u.fname, u.lname, u.status, p.post_view, p.post_rating
FROM post_tbl as p 
INNER JOIN user as u ON u.id = p.post_by 
WHERE p.post_unid = '$unid'";
    $post = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

    return $post;
}

function fetchCatFaculty($conn)
{
    $sql = "SELECT * FROM faculty ORDER BY faculty_name DESC";
    $catFaculty = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

    return $catFaculty;
}

function fetchCatProvinces()
{
    require_once "admin/assets/vendor/province-db/conn.php";
    $provSql = "SELECT * FROM provinces ORDER BY name_th ASC";
    $queryProv = mysqli_query($connProvinces, $provSql) or die("database error:" . mysqli_error($connProvinces));

    return $queryProv;
}

function fetchComment($conn, $id)
{
    $sql = "SELECT c.comment_id, c.post_ref, c.comment, c.comment_by, c.comment_at, c.user_rating, u.id, u.fname, u.lname, u.img_user, u.status
    FROM comment as c
    INNER JOIN user as u ON u.id = c.comment_by
    WHERE c.post_ref = '$id' ORDER BY c.comment_id DESC";
    $comment = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

    return $comment;
}

function catFaculty($conn, $id)
{
    $sql = "SELECT cf.cf_postref, cf.cf_name, fac.id, fac.faculty_name
    FROM category_faculty as cf 
    INNER JOIN faculty as fac ON fac.id = cf.cf_name
    WHERE cf.cf_postref = '$id'";
    $faculty = mysqli_query($conn, $sql);

    return $faculty;
}

function catProvinces($conn, $id)
{
    $psql = "SELECT cp_postref, cp_name
        FROM category_provinces
        WHERE cp_postref = '$id'";
    $provicesResult = mysqli_query($conn, $psql);

    return $provicesResult;
}

function pagination($conn, $perpage)
{

    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref, 
u.fname, u.lname, u.status
FROM post_tbl as p 
INNER JOIN user as u ON u.id = p.post_by";
    $post = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

    $total_record = mysqli_num_rows($post);
    $total_page = ceil($total_record / $perpage);

    return $total_page;
}

function recommendPagination($conn, $perpage)
{

    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref, 
u.fname, u.lname, u.status
FROM post_tbl as p 
INNER JOIN user as u ON u.id = p.post_by
WHERE p.post_rating >= '4'";
    $post = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

    $total_record = mysqli_num_rows($post);
    $total_page = ceil($total_record / $perpage);

    return $total_page;
}

function search($conn, $input)
{
    $inp = $input;
    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref, 
    u.fname, u.lname, u.status, fac.faculty_name, cp.cp_name, p.post_view, p.post_rating, cp.cp_name
    FROM post_tbl as p
    INNER JOIN user as u ON u.id = p.post_by
    INNER JOIN category_provinces as cp ON cp.cp_postref = p.provinces_ref
    INNER JOIN category_faculty as cf ON cf.cf_postref = p.faculty_ref
    INNER JOIN faculty as fac ON fac.id = cf.cf_name
    WHERE cp.cp_name LIKE '%" . $inp . "%' OR fac.faculty_name LIKE '%" . $inp . "%' OR p.post_content LIKE '%" . $inp . "%' OR p.post_topic LIKE '%" . $inp . "%'
    GROUP BY p.id
    ORDER BY p.id DESC";
    $result = mysqli_query($conn, $sql);

    return $result;
}
