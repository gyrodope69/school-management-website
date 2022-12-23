<?php
include("../config.php");

if (isset($_POST["add_student"])) {
    $name = strtolower($_POST["name"]);
    $email = $_POST["email"];
    $class_id = $_POST["class_id"];
    $gender = strtolower($_POST["gender"]);
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $address = strtolower($_POST["address"]);
    $password = $_POST["password"];

    $find_student = "SELECT * FROM students WHERE email = '$email'";
    $response = mysqli_query($conn, $find_student) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Student already registered...";
    } else {
        $password = sha1($password);
        $add_student = "INSERT INTO students (name,email,class_id,gender,phone,dob,address,password) VALUES ('$name','$email','$class_id','$gender','$phone','$dob','$address','$password') ";
        $response = mysqli_query($conn, $add_student) or die(mysqli_error($conn));
        header('Location: admin.php');
    }
}

if (isset($_POST["update_student"])) {
    $student_id = $_GET["student_id"];
    $name = strtolower($_POST["name"]);
    $email = $_POST["email"];
    $class_id = $_POST["class_id"];
    $gender = strtolower($_POST["gender"]);
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $address = strtolower($_POST["address"]);
    $password = $_POST["password"];


    $find_student = "SELECT * FROM students WHERE `student_id` = '$student_id'";
    $response = mysqli_query($conn, $find_student) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        if ($password == NULL) {
            $update_profile = "UPDATE 
                students 
                SET name = '$name', email = '$email', class_id = '$class_id', gender = '$gender', phone = '$phone', dob = '$dob', address = '$address' 
                WHERE student_id = '$student_id'
            ";
        } else {
            $password = sha1($password);
            $update_profile = "UPDATE 
                students 
                SET name = '$name', email = '$email', class_id = '$class_id', gender = '$gender', phone = '$phone', dob = '$dob', address = '$address', password = '$password' 
                WHERE student_id = '$student_id'
            ";
        }
        $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));
        header('Location: ./students.php?query=manage');
    } else {
        echo "There was some problem finding the student's account, contact Database Administrator...";
    }
}