<?php 
include("./config.php");

if(isset($_POST["find_timetable"])){
    $class_id = $_POST["class_id"];
    $find_file = "SELECT file FROM timetables WHERE class_id = '$class_id'";
    $response = mysqli_query($conn, $find_file) or die(mysqli_error($conn));
    $timetable_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
    header("Location: ./timetable.php?file={$timetable_details['file']}");
}
      
if(isset($_POST["find_syllabus"])){
    $class_id = $_POST["class_id"];
    $find_file = "SELECT file FROM syllabuses WHERE class_id = '$class_id'";
    $response = mysqli_query($conn, $find_file) or die(mysqli_error($conn));
    $syllabus_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
    header("Location: ./syllabus.php?file={$syllabus_details['file']}");
}