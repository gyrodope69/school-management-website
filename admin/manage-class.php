<?php
include("../config.php");

if (isset($_POST["add_class"])) {
    $standard = strtolower($_POST["standard"]);
    $descr = strtolower($_POST["descr"]);
    $subject_ids = json_encode($_POST["subject_ids"]);

    $find_class = "SELECT * FROM classes WHERE `standard` = '$standard' ";
    $response = mysqli_query($conn, $find_class) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Class already created...";
    } else {
        $add_class = "INSERT INTO classes (standard, description,subject_ids) VALUES ('$standard', '$descr','$subject_ids') ";
        $response = mysqli_query($conn, $add_class) or die(mysqli_error($conn));
        header('Location: admin.php');
    }
}

if (isset($_POST["update_class"])) {
    $class_id = $_GET["class_id"];
    $standard = strtolower($_POST["standard"]);
    $descr = strtolower($_POST["descr"]);
    $subject_ids = json_encode($_POST["subject_ids"]);

    $find_class = "SELECT * FROM classes WHERE class_id = '$class_id'";
    $response = mysqli_query($conn, $find_class) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $update_class = "UPDATE 
            classes
            SET standard = '$standard', description = '$descr', subject_ids = '$subject_ids'
            WHERE class_id = '$class_id'
        ";
        $response = mysqli_query($conn, $update_class) or die(mysqli_error($conn));
        header('Location: ./classes.php?query=manage');
    } else {
        echo "There was some problem finding the class, contact Database Administrator...";
    }
}