<?php
include("../../config.php");
if (isset($_POST["add_driver"])) {
    $name = strtolower($_POST["name"]);
    $email = $_POST["email"];
    $gender = strtolower($_POST["gender"]);
    $phone = $_POST["phone"];
    $doj = $_POST["doj"];
    $address = strtolower($_POST["address"]);

    $find_driver = "SELECT * FROM miscellaneous WHERE email = '$email' OR phone = '$phone'";
    $response = mysqli_query($conn, $find_driver) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        echo "Driver already registered...";
    } else {
        $add_driver = "INSERT INTO miscellaneous (name, email, gender, phone, category, address, doj) VALUES ('$name','$email','$gender','$phone','driver','$address','$doj') ";
        $response = mysqli_query($conn, $add_driver) or die(mysqli_error($conn));
        header('Location: ../../admin/transport/drivers.php?query=manage');
    }
}

if (isset($_POST["update_driver"])) {
    $miscellaneous_id = $_GET["miscellaneous_id"];
    $name = strtolower($_POST["name"]);
    $email = $_POST["email"];
    $gender = strtolower($_POST["gender"]);
    $phone = $_POST["phone"];
    $doj = $_POST["doj"];
    $active = $_POST["active"];
    $address = strtolower($_POST["address"]);


    $find_driver = "SELECT * FROM miscellaneous WHERE miscellaneous_id = '$miscellaneous_id'";
    $response = mysqli_query($conn, $find_driver) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $update_profile = "UPDATE miscellaneous SET name = '$name', email = '$email', gender = '$gender', phone = '$phone', doj = '$doj', address = '$address', active = '$active' WHERE `miscellaneous_id` = '$miscellaneous_id'";
        $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));
        header('Location: ../../admin/transport/drivers.php?query=manage');
    } else {
        echo "There was some problem finding driver's details, contact database administrator...";
    }
}