<?php
include("../../config.php");
if (isset($_POST["add_vehicle"])) {
    $vehicle_type = strtolower($_POST["type"]);
    $vehicle_number = $_POST["plate"];

    $find_vehicle = "SELECT * FROM vehicles WHERE `vehicle_number` = '$vehicle_number'";
    $response = mysqli_query($conn, $find_vehicle) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Vehicle already added...";
    } else {
        $add_vehicle = "INSERT INTO vehicles (vehicle_type, vehicle_number) VALUES ('$vehicle_type','$vehicle_number') ";
        $response = mysqli_query($conn, $add_vehicle) or die(mysqli_error($conn));
        header('Location: ../../admin/transport/vehicles.php?query=manage');
    }
}

if (isset($_POST["update_vehicle"])) {
    $vehicle_id = $_GET["vehicle_id"];
    $vehicle_type = strtolower($_POST["type"]);
    $vehicle_number = $_POST["plate"];
    $active = $_POST["active"];

    $find_vehicle = "SELECT * FROM vehicles WHERE vehicle_id = '$vehicle_id'";
    $response = mysqli_query($conn, $find_vehicle) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $update_vehicle = "UPDATE vehicles SET vehicle_type = '$vehicle_type', vehicle_number = '$vehicle_number', active = '$active' WHERE vehicle_id = '$vehicle_id'";
        $response = mysqli_query($conn, $update_vehicle) or die(mysqli_error($conn));
        header('Location: ../../admin/transport/vehicles.php?query=manage');
    } else {
        echo "There was some problem finding the vehicle details, contact database administrator...";
    }
}