<?php
include("config.php");

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $category = $_POST["category"];

    if ($category == "student") {
        $find_user = "SELECT * FROM students WHERE email = '$email' and active = '1'";
    } else if($category == "teacher"){
        $find_user = "SELECT * FROM teachers WHERE email = '$email' and active = '1'";
    }else{
        $find_user = "SELECT * FROM miscellaneous WHERE email = '$email' and active = '1'";
    }

    $response = mysqli_query($conn, $find_user) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $user_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
        if ($user_details["password"] == sha1($password)) {
            $_SESSION["user_email"] = $user_details["email"];
            $_SESSION["user_category"] = $category;
            if($_SESSION["user_category"] == "admin"){
                header('Location: ./admin/admin.php');
            }else{
                header('Location: ./index.php');
            }
        } else {
            echo "Password was incorrect, please try with a different password...";
        }
    } else {
        echo "There was some problem finding your account, report here at admin.org@gmail.com...";
    }
}


if (isset($_POST["update_student"])) {
    $student_id = $_GET["student_id"];
    $name = strtolower($_POST["name"]);
    $gender = strtolower($_POST["gender"]);
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $address = strtolower($_POST["address"]);
    $password = $_POST["password"];


    $find_student = "SELECT * FROM students WHERE student_id = '$student_id' ";
    $response = mysqli_query($conn, $find_student) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        if ($password == NULL) {
            $update_profile = "UPDATE 
                students 
                SET name = '$name', gender = '$gender', phone = '$phone', dob = '$dob', address = '$address' 
                WHERE student_id = '$student_id' ";
        } else {
            $password = sha1($password);
            $update_profile = "UPDATE 
            students 
            SET name = '$name', gender = '$gender', phone = '$phone', dob = '$dob', address = '$address', password = '$password' 
            WHERE student_id = '$student_id' ";
        }
        $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));
        header('Location: ./logout.php');
    } else {
        echo "There was some problem updating your account, report here at admin.org@gmail.com...";
    }
}


if (isset($_POST["update_teacher"])) {
    $teacher_id = $_GET["teacher_id"];
    $name = strtolower($_POST["name"]);
    $gender = strtolower($_POST["gender"]);
    $phone = $_POST["phone"];
    $address = strtolower($_POST["address"]);
    $password = $_POST["password"];


    $find_teacher = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
    $response = mysqli_query($conn, $find_teacher) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        if ($password == NULL) {
            $update_profile = "UPDATE 
                teachers 
                SET name = '$name', gender = '$gender', phone = '$phone', address = '$address' 
                WHERE teacher_id = '$teacher_id'
            ";
        } else {
            $password = sha1($password);
            $update_profile = "UPDATE 
                teachers 
                SET name = '$name', gender = '$gender', phone = '$phone', address = '$address', password = '$password' 
                WHERE teacher_id = '$teacher_id'
            ";
        }
        $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));
        header('Location: ./logout.php');
    } else {
        echo "There was some problem updating your account, report here at admin.org@gmail.com...";
    }
}
?>