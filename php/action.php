<?php
session_start();
require_once 'conn.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'register') {
        register();
        exit;
    } elseif ($_POST['action'] == 'login') {
        login();
        exit;
    } elseif ($_POST['action'] == 'editMember') {
        editMember();
        exit;
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        logout();
        exit;
    }
}

function register()
{
    global $conn;

    $fname = mysqli_real_escape_string($conn, $_POST['inputFname']);
    $lname = mysqli_real_escape_string($conn, $_POST['inputLname']);
    $email = mysqli_real_escape_string($conn, $_POST['inputEmail']);
    $password = mysqli_real_escape_string($conn, $_POST['inputPassword']);
    $std_id = mysqli_real_escape_string($conn, $_POST['inputStd_id']);
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");

    $password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    if (!empty($fname)) {
        if (!empty($lname)) {
            if (!empty($email)) {
                if (!empty($std_id)) {
                    if (!empty($password)) {


                        // check duplicate data
                        $user_check_query = "SELECT * FROM user WHERE email = '$email' AND std_no = '$std_id'";
                        $query = mysqli_query($conn, $user_check_query);
                        $check = mysqli_fetch_assoc($query);

                        if ($check) {
                            $_SESSION['error'] = "อีเมลล์หรือรหัสนักศึกษานี้มีในระบบแล้ว!";
                            echo "<script> window.location.href='../index';</script>";
                            exit;
                        } else {
                            $query = "INSERT INTO user (email, pass, fname, lname, std_no, reg_date, status)
                    VALUES ('$email', '$password_hash', '$fname', '$lname', '$std_id', '$date', 'Member')";
                            $result_query =  mysqli_query($conn, $query);
                            if ($result_query) {
                                $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
                                header("Location: ../login");
                                exit;
                            } else {
                                $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
                                echo "<script> window.history.back()</script>";
                                exit;
                            }
                        }
                    } else {
                        $_SESSION['error'] = "กรุณากรอกพาสเวิร์ด";
                        echo "<script> window.history.back()</script>";
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "กรุณากรอกรหัสนักศึกษา";
                    echo "<script> window.history.back()</script>";
                    exit;
                }
            } else {
                $_SESSION['error'] = "กรุณากรอกอีเมลล์";
                echo "<script> window.history.back()</script>";
                exit;
            }
        } else {
            $_SESSION['error'] = "กรุณากรอกนามสกุล";
            echo "<script> window.history.back()</script>";
            exit;
        }
    } else {
        $_SESSION['error'] = "กรุณากรอกชื่อจริง";
        echo "<script> window.history.back()</script>";
        exit;
    }
}

function login()
{
    global $conn;
    date_default_timezone_set('Asia/Bangkok');

    $email = mysqli_real_escape_string($conn, $_POST['inputEmail']);
    $password = mysqli_real_escape_string($conn, $_POST['inputPassword']);

    if (!empty($email)) {
        if (!empty($password)) {
            $user = "SELECT * FROM user WHERE email = '$email'";
            $query = mysqli_query($conn, $user);
            $result = mysqli_fetch_assoc($query);

            if ($result > 0) {
                $stored_pass = $result['pass'];
                if (password_verify($password, $stored_pass)) {
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['role'] = $result['status'];
                    $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ!";
                    header('location: ../index');
                    exit;
                } else {
                    $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
                    header('location: ../login');
                    exit;
                }
            } else {
                $_SESSION['error'] = "อีเมลล์ไม่ถูกต้อง";
                header('location: ../login');
                exit;
            }
        } else {
            $_SESSION['error'] = "กรุณากรอกพาสเวิร์ด";
            header('location: ../login');
            exit;
        }
    } else {
        $_SESSION['error'] = "กรุณากรอกอีเมลล์";
        header('location: ../login');
        exit;
    }
}

function logout()
{
    header("Location: ../login?success=ออกจากระบบสำเร็จ!");
    session_unset();
    session_destroy();
    exit;
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
            $unlink = unlink('../img/user_img/' . $oldImage);
            if (!$unlink) {
                $_SESSION['error'] = "ลบไฟล์ไม่สำเร็จ!";
                echo "<script> window.history.back()</script>";
                exit;
            }
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

            $moveImg = move_uploaded_file($tmpName, '../img/user_img/' . $newImgName);

            if (!$moveImg) {
                $_SESSION['error'] = "ย้ายไฟล์ไม่สำเร็จ!";
                echo "<script> window.history.back()</script>";
                exit;
            }
        }
    } else {
        $newImgName = $oldImage;
    }

    $query = "UPDATE user SET fname='$inputFname', lname='$inputLname', std_no='$inputStdID', email='$inputEmail', pass='$password', img_user='$newImgName' WHERE id = '$user'";
    $result_query =  mysqli_query($conn, $query);
    if ($result_query) {
        $_SESSION['success'] = "แก้ไขรายการสำเร็จ!";
        header("Location: ../profile#blog");
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        echo "<script> window.history.back()</script>";
        mysqli_close($conn);
        exit;
    }
}

if (isset($_POST['edit_row'])) {
    global $conn;

    $edit_row = mysqli_real_escape_string($conn, $_POST['edit_row']);
    $edit_review = mysqli_real_escape_string($conn, $_POST['edit_userReview']);
    $new_rating_data = $_POST['new_rating_data'];

    $query = "UPDATE comment SET comment='$edit_review', user_rating='$new_rating_data' WHERE comment_id = '$edit_row'";
    $result_query =  mysqli_query($conn, $query);

    echo "แก้ไขรายการสำเร็จ!";
}

if (isset($_GET['deleteReview']) && isset($_GET['post_data'])) {
    global $conn;
    $id = $_GET['deleteReview'];
    $post = $_GET['post_data'];

    $sql = "DELETE FROM comment WHERE comment_id = '$id'";
    $query = $conn->query($sql);

    if ($query) {
        $_SESSION['success'] = "ลบรายการสำเร็จ!";
        mysqli_close($conn);
        echo "<script> window.history.back()</script>";
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด! กรุณาลองอีกครั้ง";
        mysqli_close($conn);
        echo "<script> window.history.back()</script>";
        exit;
    }
}
