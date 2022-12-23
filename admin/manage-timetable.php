<?php
include("../config.php");

if (isset($_POST["add_timetable"])) {
    $class_id = $_POST["class_id"];

    $find_timetable = "SELECT * FROM timetables WHERE class_id = '$class_id'";
    $response = mysqli_query($conn, $find_timetable) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Timetable already added...";
    } else {
        $target_dir = "../assets/vendor/timetable/";
        $base_name = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $base_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $add_timetable = "INSERT INTO timetables (class_id, file) VALUES ('$class_id', '$base_name') ";
                $response = mysqli_query($conn, $add_timetable) or die(mysqli_error($conn));
                header('Location: ./timetables.php?query=manage');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

if (isset($_POST["update_timetable"])) {
    $timetable_id = $_GET["timetable_id"];

    $find_timetable = "SELECT * FROM timetables WHERE timetable_id = '$timetable_id'";
    $response = mysqli_query($conn, $find_timetable) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $target_dir = "../assets/vendor/timetable/";
        $base_name = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $base_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
            echo "Only PDF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $update_timetable = "UPDATE 
                    timetables 
                    SET file = '$base_name'
                    WHERE timetable_id = '$timetable_id'
                ";
                $response = mysqli_query($conn, $update_timetable) or die(mysqli_error($conn));
                header('Location: ./timetables.php?query=manage');
            } else {
                echo "There was an error uploading your file.";
            }
        }
    } else {
        echo "There was some problem updating timetable, contact Database Administrator...";
    }
}
