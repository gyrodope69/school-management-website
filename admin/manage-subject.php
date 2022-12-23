<?php
include("../config.php");

if (isset($_POST["add_subject"])) {
    $title = strtolower($_POST["title"]);
    $descr = strtolower($_POST["descr"]);
    $code = strtoupper($_POST["code"]);
    $credit = $_POST["credit"];
    $teacher_id = $_POST["teacher_id"];

    $find_subject = "SELECT * FROM subjects WHERE code = '$code'";
    $response = mysqli_query($conn, $find_subject) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Subject already registered...";
    } else {
        $add_subject = "INSERT INTO subjects (title, descr, code, credit, teacher_id) VALUES ('$title','$descr','$code','$credit','$teacher_id') ";
        $response = mysqli_query($conn, $add_subject) or die(mysqli_error($conn));
        header('Location: admin.php');
    }
}

if (isset($_POST["update_subject"])) {
    $subject_id = $_GET["subject_id"];
    $title = strtolower($_POST["title"]);
    $descr = strtolower($_POST["descr"]);
    $code = strtoupper($_POST["code"]);
    $credit = $_POST["credit"];
    $active = $_POST["active"];
    $teacher_id = $_POST["teacher_id"];

    $find_subject = "SELECT * FROM subjects WHERE subject_id = '$subject_id'";
    $response = mysqli_query($conn, $find_subject) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $update_subject = "UPDATE 
            subjects 
            SET title = '$title', descr = '$descr', code = '$code', credit = '$credit', active = '$active', teacher_id = '$teacher_id'
            WHERE subject_id = '$subject_id'
        ";
        $response = mysqli_query($conn, $update_subject) or die(mysqli_error($conn));
        header('Location: ./subjects.php?query=manage');
    } else {
        echo "There was some problem finding the subject, contact Database Administrator...";
    }
}