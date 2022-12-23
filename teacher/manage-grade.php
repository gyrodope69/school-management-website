<?php
include("../config.php");

if(isset($_POST["submit_class_info"])){
    $class_id = $_POST["class_id"];
    header("Location: ./grade.php?class_id=$class_id");
}

if(isset($_POST["submit_subject_info"])){
    $class_id = $_POST["class_id"];
    $subject_id = $_POST["subject_id"];
    header("Location: ./grade.php?class_id=$class_id&subject_id=$subject_id");
}

if (isset($_POST["update_grade"])) {
    $class_id = $_GET["class_id"];
    $subject_id = $_GET["subject_id"];
    $student_id_mid_term_1 = $_POST["mid_term_1"];
    $student_id_mid_term_2 = $_POST["mid_term_2"];
    $student_id_end_term = $_POST["end_term"];
    $student_id_other = $_POST["other"];

    foreach ($student_id_mid_term_1 as $student_id => $mid_term_1) {
        $mid_term_1 = $student_id_mid_term_1[$student_id];
        $mid_term_2 = $student_id_mid_term_2[$student_id];
        $end_term = $student_id_end_term[$student_id];
        $other = $student_id_other[$student_id];

        $grades = "SELECT * FROM grades WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'";
        $response = mysqli_query($conn, $grades) or die(mysqli_error($conn));

        if (mysqli_num_rows($response) == 0) {
            $insert = "INSERT INTO grades (student_id, class_id, subject_id, mid_term_1, mid_term_2, end_term, other) VALUES ('$student_id', '$class_id', '$subject_id', '$mid_term_1','$mid_term_2','$end_term','$other')";
            $response = mysqli_query($conn, $insert) or die(mysqli_error($conn));
        } else {
            $update = "UPDATE grades SET mid_term_1 = '$mid_term_1', mid_term_2 = '$mid_term_2', end_term = '$end_term', other = '$other' WHERE student_id = '$student_id' AND `class_id` = '$class_id' AND `subject_id` = '$subject_id'";
            $response = mysqli_query($conn, $update) or die(mysqli_error($conn));
        }
    }
    header('Location: ../index.php');
}