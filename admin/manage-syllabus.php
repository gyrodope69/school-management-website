<?php
include("../config.php");

if (isset($_POST["add_syllabus"])) {
    $class_id = $_POST["class_id"];

    $find_syllabus = "SELECT * FROM syllabuses WHERE class_id = '$class_id'";
    $response = mysqli_query($conn, $find_syllabus) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Syllabus already added...";
    } else {
        $target_dir = "../assets/vendor/syllabus/";
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
                $add_syllabus = "INSERT INTO syllabuses (class_id, file) VALUES ('$class_id', '$base_name') ";
                $response = mysqli_query($conn, $add_syllabus) or die(mysqli_error($conn));
                header('Location: ./syllabuses.php?query=manage');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

if (isset($_POST["update_syllabus"])) {
    $syllabus_id = $_GET["syllabus_id"];

    $find_syllabus = "SELECT * FROM syllabuses WHERE syllabus_id = '$syllabus_id'";
    $response = mysqli_query($conn, $find_syllabus) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $target_dir = "../assets/vendor/syllabus/";
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
                $update_syllabus = "UPDATE 
                    syllabuses 
                    SET file = '$base_name'
                    WHERE syllabus_id = '$syllabus_id'
                ";
                $response = mysqli_query($conn, $update_syllabus) or die(mysqli_error($conn));
                header('Location: ./syllabuses.php?query=manage');
            } else {
                echo "There was an error uploading your file.";
            }
        }
    } else {
        echo "There was some problem updating syllabus, contact Database Administrator...";
    }
}
