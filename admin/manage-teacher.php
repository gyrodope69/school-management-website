<?php
include("../config.php");

if (isset($_POST["add_teacher"])) {
    $name = strtolower($_POST["name"]);
    $email = $_POST["email"];
    $gender = strtolower($_POST["gender"]);
    $designation = strtolower($_POST["designation"]);
    $phone = $_POST["phone"];
    $doj = $_POST["doj"];
    $address = strtolower($_POST["address"]);
    $password = $_POST["password"];

    $find_teacher = "SELECT * FROM teachers WHERE email = '$email'";
    $response = mysqli_query($conn, $find_teacher) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Teacher already registered...";
    } else {
        $password = sha1($password);
        $add_teacher = "INSERT INTO teachers (name,email,designation,gender,phone,doj,address,password) VALUES ('$name','$email','$designation','$gender','$phone','$doj','$address','$password') ";
        $response = mysqli_query($conn, $add_teacher) or die(mysqli_error($conn));
        header('Location: admin.php');
    }
}

if (isset($_POST["update_teacher"])) {
    $teacher_id = $_GET["teacher_id"];
    $name = strtolower($_POST["name"]);
    $email = $_POST["email"];
    $gender = strtolower($_POST["gender"]);
    $designation = strtolower($_POST["designation"]);
    $phone = $_POST["phone"];
    $doj = $_POST["doj"];
    $active = $_POST["active"];
    $address = strtolower($_POST["address"]);
    $password = $_POST["password"];


    $find_teacher = "SELECT * FROM teachers WHERE email = '$email'";
    $response = mysqli_query($conn, $find_teacher) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        if ($password == NULL) {
            $update_profile = "UPDATE 
                teachers 
                SET name = '$name', email = '$email', designation = '$designation', gender = '$gender', phone = '$phone', doj = '$doj', address = '$address', active = '$active'
                WHERE teacher_id = '$teacher_id'
            ";
        } else {
            $password = sha1($password);
            $update_profile = "UPDATE 
                teachers 
                SET name = '$name', email = '$email', designation = '$designation', gender = '$gender', phone = '$phone', doj = '$doj', address = '$address', password = '$password', active = '$active' 
                WHERE teacher_id = '$teacher_id'
            ";
        }
        $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));
        header('Location: ./teachers.php?query=manage');
    } else {
        echo "There was some problem finding the teacher's account, contact Database Administrator...";
    }
}