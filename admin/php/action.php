<?php
require_once 'conn.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $action = stripslashes($action);
    if ($action == 'addPost') {
        addPost();
        exit;
    } elseif ($action == 'editPost') {
        editPost();
        exit;
    } elseif ($action == 'addMember') {
        addMember();
        exit;
    } elseif ($action == 'editMember') {
        editMember();
        exit;
    } elseif ($action == 'addFaculty') {
        addFaculty();
        exit;
    } elseif ($action == 'editFaculty') {
        editFaculty();
        exit;
    }
}

if (isset($_GET['deletePost'])) {
    session_start();
    global $conn;
    $unid = $_GET['deletePost'];

    $sql = "SELECT * FROM post_tbl WHERE post_unid = '$unid' LIMIT 1";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $banner = $row['post_banner'];
    $id = $row['id'];

    $sql = "DELETE FROM post_tbl WHERE id = '$id'";
    $query = $conn->query($sql);

    if ($query) {

        unlink("../assets/img/postBanner/$banner");
        $_SESSION['success'] = "ลบรายการสำเร็จ!";
        echo "<script> window.location.href='../../admin?p=viewPost';</script>";
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.history.back()</script>";
        exit;
    }
}

function addPost()
{
    session_start();
    global $conn;
    $rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'), 0, 10);
    $uniqid = "POST_" . $rand;
    $qP = "SELECT p.post_unid
    FROM post_tbl as p
    WHERE p.post_unid = '$uniqid'";
    $rP =  mysqli_query($conn, $qP);
    $rS =  mysqli_fetch_assoc($rP);

    if ($rS) {
        $rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'), 0, 10);
        $uniqid = "POST_" . $rand;
    }

    mysqli_free_result($rP);

    $n = 10;
    $ref = randomNumber($n);

    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d");

    $user = mysqli_real_escape_string($conn, $_POST['uid']);
    $postOffice = mysqli_real_escape_string($conn, $_POST['postOffice']);
    $postAddress = mysqli_real_escape_string($conn, $_POST['postAddress']);
    $postContent = mysqli_real_escape_string($conn, $_POST['postContent']);

    $postProvinces = [];

    foreach ($_POST['postProvinces'] as $val) {
        $postProvinces[] = mysqli_real_escape_string($conn, $val);
    }

    $postFaculty = [];

    foreach ($_POST['postFaculty'] as $items) {
        $postFaculty[] = mysqli_real_escape_string($conn, $items);
    }

    if (empty($postProvinces) || empty($postFaculty)) {
        $_SESSION['error'] = "กรุณากรอกเลือกหมวดหมู่ให้ครบถ้วน!";
        echo "<script> window.history.back()</script>";
        exit;
    }

    if (empty($postContent)) {
        $_SESSION['error'] = "กรุณากรอกเนื้อหา!";
        echo "<script> window.history.back()</script>";
        exit;
    }

    $imageName = $_FILES["postBanner"]["name"];
    $tmpName = $_FILES["postBanner"]["tmp_name"];

    if ($tmpName) {
        // Image extension valid
        $validImgExt = ['jpg', 'jpeg', 'png', 'gif'];
        $imgExt = explode('.', $imageName);

        $name = $imgExt[0];
        $imgExt = strtolower(end($imgExt));

        if (!in_array($imgExt, $validImgExt)) {
            $_SESSION['error'] = "นามสกุลของไฟล์ไม่ถูกต้อง!";
            echo "<script> window.history.back()</script>";
            exit;
        } else {
            $newImgName = $name . "-" . uniqid(); // Gen new img name
            $newImgName .= "." . $imgExt;

            move_uploaded_file($tmpName, '../assets/img/postBanner/' . $newImgName);
        }
    }

    $query = "INSERT INTO post_tbl (post_unid, post_by, post_date, post_topic, post_content, post_banner, post_address, provinces_ref, faculty_ref)
        VALUES ('$uniqid', '$user', '$date', '$postOffice', '$postContent', '$newImgName', '$postAddress', '$ref', '$ref')";
    $result_query =  mysqli_query($conn, $query);


    foreach ($postProvinces as $i) {
        $provincesSql = "INSERT INTO category_provinces (cp_postref, cp_name) VALUES ('$ref', '$i')";
        $provincesQuery =  mysqli_query($conn, $provincesSql);
    }

    foreach ($postFaculty as $k) {
        $facultySql = "INSERT INTO category_faculty (cf_postref, cf_name) VALUES ('$ref', '$k')";
        $facultyQuery =  mysqli_query($conn, $facultySql);
    }


    if ($result_query && $facultyQuery && $provincesQuery) {
        $_SESSION['success'] = "เพิ่มรายการสำเร็จ!";
        header("Location: ../../admin?p=viewPost");
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.history.back()</script>";
        mysqli_close($conn);
        exit;
    }
}

function editPost()
{
    session_start();
    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H-i-s");

    $user = mysqli_real_escape_string($conn, $_POST['uid']);
    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $oldBanner = $_POST['oldBanner'];
    $postOffice = mysqli_real_escape_string($conn, $_POST['postOffice']);
    $postAddress = mysqli_real_escape_string($conn, $_POST['postAddress']);
    $postContent = mysqli_real_escape_string($conn, $_POST['postContent']);
    $provincesRef = mysqli_real_escape_string($conn, $_POST['provinces']);
    $facultyRef = mysqli_real_escape_string($conn, $_POST['faculty']);

    $postProvinces = [];

    foreach ($_POST['postProvinces'] as $val) {
        $postProvinces[] = mysqli_real_escape_string($conn, $val);
    }

    $postFaculty = [];

    foreach ($_POST['postFaculty'] as $items) {
        $postFaculty[] = mysqli_real_escape_string($conn, $items);
    }

    if (empty($postProvinces) || empty($postFaculty)) {
        $_SESSION['error'] = "กรุณากรอกเลือกหมวดหมู่ให้ครบถ้วน!";
        echo "<script> window.history.back()</script>";
        exit;
    }

    if (empty($postContent)) {
        $_SESSION['error'] = "กรุณากรอกเนื้อหา!";
        echo "<script> window.history.back()</script>";
        exit;
    }

    $imageName = $_FILES["postBanner"]["name"];
    $tmpName = $_FILES["postBanner"]["tmp_name"];

    if ($tmpName) {
        if ($oldBanner != '') {
            // Delete the old picture
            unlink('../assets/img/postBanner/' . $oldBanner);
        }
        // Image extension valid
        $validImgExt = ['jpg', 'jpeg', 'png', 'gif'];
        $imgExt = explode('.', $imageName);

        $name = $imgExt[0];
        $imgExt = strtolower(end($imgExt));

        if (!in_array($imgExt, $validImgExt)) {
            $_SESSION['error'] = "นามสกุลของไฟล์ไม่ถูกต้อง!";
            echo "<script> window.history.back()</script>";
            exit;
        } else {
            $newImgName = $name . "-" . uniqid(); // Gen new img name
            $newImgName .= "." . $imgExt;

            move_uploaded_file($tmpName, '../assets/img/postBanner/' . $newImgName);
        }
    } else {
        $newImgName = $oldBanner;
    }

    $query = "UPDATE post_tbl SET post_by='$user', post_edit='$date', post_topic='$postOffice', post_content='$postContent', post_banner='$newImgName', post_address='$postAddress' WHERE id = '$pid'";
    $result_query =  mysqli_query($conn, $query);

    // Provinces category
    require_once "fetchProvinces.php";
    $provinces = provinces($conn, $provincesRef);
    $provincesArray = [];

    foreach ($provinces as $provincesRow) {
        $provincesArray[] = $provincesRow['cp_name'];
    }
    // Insert
    foreach ($postProvinces as $inputProvinces) {
        if (!in_array($inputProvinces, $provincesArray)) {
            $provincesSql = "INSERT INTO category_provinces (cp_postref, cp_name) VALUES ('$provincesRef','$inputProvinces')";
            $provincesQuery =  mysqli_query($conn, $provincesSql);
        }
    }
    // Delete
    foreach ($provincesArray as $fetchProvinces) {
        if (!in_array($fetchProvinces, $postProvinces)) {
            $provincesSql = "DELETE FROM category_provinces WHERE cp_postref='$provincesRef' AND cp_name='$fetchProvinces'";
            $provincesQuery =  mysqli_query($conn, $provincesSql);
        }
    }

    // Faculty category
    require_once "fetchFaculty.php";
    $faculty = faculty($conn, $facultyRef);
    $facultyArray = [];

    foreach ($faculty as $facultyRow) {
        $facultyArray[] = $facultyRow['cf_name'];
    }
    // Insert
    foreach ($postFaculty as $inputFaculty) {
        if (!in_array($inputFaculty, $facultyArray)) {
            $facultySql = "INSERT INTO category_faculty (cf_postref, cf_name) VALUES ('$facultyRef','$inputFaculty')";
            $facultyQuery =  mysqli_query($conn, $facultySql);
        }
    }
    // Delete
    foreach ($facultyArray as $fetchFaculty) {
        if (!in_array($fetchFaculty, $postFaculty)) {
            $facultySql = "DELETE FROM category_faculty WHERE cf_postref='$facultyRef' AND cf_name='$fetchFaculty'";
            $facultyQuery =  mysqli_query($conn, $facultySql);
        }
    }

    if ($result_query) {
        $_SESSION['success'] = "แก้ไขรายการสำเร็จ!";
        header("Location: ../../admin?p=viewPost");
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.history.back()</script>";
        mysqli_close($conn);
        exit;
    }
}


// Member
function addMember()
{
    session_start();
    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d");

    $inputFname = mysqli_real_escape_string($conn, $_POST['inputFname']);
    $inputLname = mysqli_real_escape_string($conn, $_POST['inputLname']);
    $inputStdID = mysqli_real_escape_string($conn, $_POST['inputStdID']);
    $inputEmail = mysqli_real_escape_string($conn, $_POST['inputEmail']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['inputPassword']);
    $inputStatus = mysqli_real_escape_string($conn, $_POST['inputStatus']);

    $enc_pass = password_hash($inputPassword, PASSWORD_DEFAULT);

    $imageName = $_FILES["inputImage"]["name"];
    $tmpName = $_FILES["inputImage"]["tmp_name"];

    if ($tmpName) {
        // Image extension valid
        $validImgExt = ['jpg', 'jpeg', 'png', 'gif'];
        $imgExt = explode('.', $imageName);

        $name = $imgExt[0];
        $imgExt = strtolower(end($imgExt));

        if (!in_array($imgExt, $validImgExt)) {
            $_SESSION['error'] = "นามสกุลของไฟล์ไม่ถูกต้อง!";
            echo "<script> window.history.back()</script>";
            exit;
        } else {
            $newImgName = $name . "-" . uniqid(); // Gen new img name
            $newImgName .= "." . $imgExt;

            $move = move_uploaded_file($tmpName, '../../img/user_img/' . $newImgName);
        }
    }

    $qP = "SELECT * FROM user WHERE email = '$inputEmail'";
    $rQ =  mysqli_query($conn, $qP);
    $rS = mysqli_fetch_assoc($rQ);
    if ($rS) {
        $_SESSION['error'] = "มีอีเมลล์นี้ในระบบแล้ว!";
        echo "<script> window.history.back()</script>";
        mysqli_close($conn);
        exit;
    } else {
        $query = "INSERT INTO user (fname, lname, std_no, email, pass, img_user, status, reg_date)
        VALUES ('$inputFname', '$inputLname', '$inputStdID', '$inputEmail', '$enc_pass', '$newImgName', '$inputStatus', '$date')";
        $result_query =  mysqli_query($conn, $query);
        if ($result_query) {
            $_SESSION['success'] = "เพิ่มรายการสำเร็จ!";
            header("Location: ../../admin?p=viewMember");
            mysqli_close($conn);
            exit;
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
            echo "<script> window.history.back()</script>";
            mysqli_close($conn);
            exit;
        }
    }
}

function editMember()
{
    session_start();
    global $conn;

    $user = mysqli_real_escape_string($conn, $_POST['uid']);
    $oldImage = mysqli_real_escape_string($conn, $_POST['oldImage']);
    $oldPass = mysqli_real_escape_string($conn, $_POST['oldPassword']);
    $inputFname = mysqli_real_escape_string($conn, $_POST['inputFname']);
    $inputLname = mysqli_real_escape_string($conn, $_POST['inputLname']);
    $inputStdID = mysqli_real_escape_string($conn, $_POST['inputStdID']);
    $inputEmail = mysqli_real_escape_string($conn, $_POST['inputEmail']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['inputPassword']);
    $inputStatus = mysqli_real_escape_string($conn, $_POST['inputStatus']);

    if ($inputPassword != '') {
        $password = password_hash($inputPassword, PASSWORD_DEFAULT);
    } else {
        $password = $oldPass;
    }

    $imageName = $_FILES["inputImage"]["name"];
    $tmpName = $_FILES["inputImage"]["tmp_name"];

    if ($tmpName) {
        if ($oldImage != '') {
            // Delete the old picture
            unlink('../../img/user_img/' . $oldImage);
        }
        // Image extension valid
        $validImgExt = ['jpg', 'jpeg', 'png', 'gif'];
        $imgExt = explode('.', $imageName);

        $name = $imgExt[0];
        $imgExt = strtolower(end($imgExt));

        if (!in_array($imgExt, $validImgExt)) {
            $_SESSION['error'] = "นามสกุลของไฟล์ไม่ถูกต้อง!";
            echo "<script> window.history.back()</script>";
            exit;
        } else {
            $newImgName = $name . "-" . uniqid(); // Gen new img name
            $newImgName .= "." . $imgExt;

            move_uploaded_file($tmpName, '../../img/user_img/' . $newImgName);
        }
    } else {
        $newImgName = $oldImage;
    }

    $query = "UPDATE user SET fname='$inputFname', lname='$inputLname', std_no='$inputStdID', email='$inputEmail', pass='$password', img_user='$newImgName', status='$inputStatus' WHERE id = '$user'";
    $result_query =  mysqli_query($conn, $query);
    if ($result_query) {
        $_SESSION['success'] = "แก้ไขรายการสำเร็จ!";
        header("Location: ../../admin?p=viewMember");
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.history.back()</script>";
        mysqli_close($conn);
        exit;
    }
}

if (isset($_GET['deleteMember'])) {
    session_start();
    global $conn;
    $unid = $_GET['deleteMember'];

    $sql = "SELECT * FROM user WHERE std_no = '$unid' LIMIT 1";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $user_img = $row['img_user'];
    $id = $row['id'];

    $sql = "DELETE FROM user WHERE id = '$id'";
    $query = $conn->query($sql);

    if ($query) {

        unlink("../../img/user_img/$user_img");
        $_SESSION['success'] = "ลบรายการสำเร็จ!";
        mysqli_close($conn);
        echo "<script> window.location.href='../../admin?p=viewMember';</script>";
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        mysqli_close($conn);
        echo "<script> window.history.back()</script>";
        exit;
    }
}


// Faculty
function addFaculty()
{
    session_start();
    global $conn;
    $inputFaculty = mysqli_real_escape_string($conn, $_POST['inputFaculty']);

    $query = "INSERT INTO faculty (faculty_name)
        VALUES ('$inputFaculty')";
    $result_query =  mysqli_query($conn, $query);
    if ($result_query) {
        $_SESSION['success'] = "เพิ่มรายการสำเร็จ!";
        header("Location: ../../admin?p=viewFaculty");
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.history.back()</script>";
        mysqli_close($conn);
        exit;
    }
}

function editFaculty()
{
    session_start();
    global $conn;

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $faculty = mysqli_real_escape_string($conn, $_POST['inputFaculty']);

    $query = "UPDATE faculty SET faculty_name='$faculty' WHERE id = '$id'";
    $result_query =  mysqli_query($conn, $query);
    if ($result_query) {
        $_SESSION['success'] = "แก้ไขรายการสำเร็จ!";
        header("Location: ../../admin?p=viewFaculty");
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.history.back()</script>";
        mysqli_close($conn);
        exit;
    }
}

if (isset($_GET['deleteFaculty'])) {
    session_start();
    global $conn;
    $unid = $_GET['deleteFaculty'];

    $sql = "DELETE FROM faculty WHERE id = '$unid'";
    $query = $conn->query($sql);

    if ($query) {
        $_SESSION['success'] = "ลบรายการสำเร็จ!";
        mysqli_close($conn);
        echo "<script> window.location.href='../../admin?p=viewFaculty';</script>";
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        mysqli_close($conn);
        echo "<script> window.history.back()</script>";
        exit;
    }
}

// Random Number
function randomNumber($n)
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}


if (isset($_GET['deleteReview'])) {
    session_start();
    global $conn;
    $id = $_GET['deleteReview'];

    $sql = "DELETE FROM comment WHERE comment_id = '$id'";
    $query = $conn->query($sql);

    if ($query) {
        $_SESSION['success'] = "ลบรายการสำเร็จ!";
        mysqli_close($conn);
        echo "<script> window.location.href='../../admin?p=viewReview';</script>";
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        mysqli_close($conn);
        echo "<script> window.history.back()</script>";
        exit;
    }
}
