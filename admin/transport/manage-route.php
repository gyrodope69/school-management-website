<?php
include("../../config.php");
if (isset($_POST["add_route"])) {
    $start = strtolower($_POST["start"]);
    $finish = strtolower($_POST["finish"]);
    $fair = $_POST["fair"];

    $find_route = "SELECT * FROM routes WHERE `start` = '$start' AND `finish` = '$finish'";
    $response = mysqli_query($conn, $find_route) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Route already added...";
    } else {
        $add_route = "INSERT INTO routes (start, finish, fair) VALUES ('$start', '$finish', '$fair') ";
        $response = mysqli_query($conn, $add_route) or die(mysqli_error($conn));
        header('Location: ../../admin/transport/routes.php?query=manage');
    }
}

if (isset($_POST["update_route"])) {
    $route_id = $_GET["route_id"];
    $start = strtolower($_POST["start"]);
    $finish = strtolower($_POST["finish"]);
    $fair = $_POST["fair"];
    $active = $_POST["active"];


    $update_route = "UPDATE routes SET start = '$start', finish = '$finish', fair = '$fair', active = '$active' WHERE `route_id` = '$route_id'";
    $response = mysqli_query($conn, $update_route) or die(mysqli_error($conn));
    header('Location: ../../admin/transport/routes.php?query=manage');
}