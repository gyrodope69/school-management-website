<?php
include("../config.php");

if (isset($_POST["add_announcement"])) {
    $title = strtolower($_POST["title"]);
    $descr = strtolower($_POST["descr"]);
    $resource = $_POST["resource"];

    $find_announcement = "SELECT * FROM announcements WHERE title = '$title'";
    $response = mysqli_query($conn, $find_announcement) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Announcement already announced...";
    } else {
        $add_announcement = "INSERT INTO announcements (title, descr, resource) VALUES ('$title','$descr','$resource') ";
        $response = mysqli_query($conn, $add_announcement) or die(mysqli_error($conn));
        header('Location: ./announcements.php?query=manage');
    }
}

if (isset($_POST["update_announcement"])) {
    $announcement_id = $_GET["announcement_id"];
    $title = strtolower($_POST["title"]);
    $descr = strtolower($_POST["descr"]);
    $active = $_POST["active"];
    $resource = $_POST["resource"];

    $find_announcement = "SELECT * FROM announcements WHERE announcement_id = '$announcement_id'";
    $response = mysqli_query($conn, $find_announcement) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $update_announcement = "UPDATE 
            announcements 
            SET title = '$title', descr = '$descr', active = '$active', resource = '$resource'
            WHERE announcement_id = '$announcement_id'
        ";
        $response = mysqli_query($conn, $update_announcement) or die(mysqli_error($conn));
        header('Location: ./announcements.php?query=manage');
    } else {
        echo "There was some problem finding the anouncement, contact Database Administrator...";
    }
}