<?php
include("../../config.php");
if (isset($_POST["add_schedule"])) {
    $vehicle_id = $_POST["vehicle_id"];
    $day = strtolower($_POST["day"]);
    $arrival = $_POST["arrival"];
    $departure = $_POST["departure"];
    $route_id = $_POST["route_id"];
    $driver_id = $_POST["driver_id"];

    $find_schedule = "SELECT * FROM vehicles_schedule WHERE vehicle_id = '$vehicle_id' AND arrival = '$arrival' AND departure = '$departure' AND route_id = '$route_id' AND day = '$day'";
    $response = mysqli_query($conn, $find_schedule) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Schedule already added...";
    } else {
        $add_schedule = "INSERT INTO vehicles_schedule (vehicle_id, day, arrival, departure, route_id, driver_id) VALUES ('$vehicle_id', '$day', '$arrival', '$departure', '$route_id', '$driver_id') ";
        $response = mysqli_query($conn, $add_schedule) or die(mysqli_error($conn));
        header('Location: ../../admin/transport/schedules.php?query=manage');
    }
}

if (isset($_POST["update_schedule"])) {
    $schedule_id = $_GET["schedule_id"];
    $vehicle_id = $_POST["vehicle_id"];
    $day = strtolower($_POST["day"]);
    $arrival = $_POST["arrival"];
    $departure = $_POST["departure"];
    $active = $_POST["active"];
    $route_id = $_POST["route_id"];
    $driver_id = $_POST["driver_id"];

    $find_schedule = "SELECT * FROM vehicles_schedule WHERE schedule_id = '$schedule_id'";
    $response = mysqli_query($conn, $find_schedule) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $update_schedule = "UPDATE vehicles_schedule SET vehicle_id = '$vehicle_id', day = '$day', arrival = '$arrival', departure = '$departure', route_id = '$route_id', driver_id = '$driver_id', active = '$active' WHERE schedule_id = '$schedule_id'";
        $response = mysqli_query($conn, $update_schedule) or die(mysqli_error($conn));
        header('Location: ../../admin/transport/schedules.php?query=manage');
    } else {
        echo "There was some problem finding the schedule details, contact database administrator...";
    }
}