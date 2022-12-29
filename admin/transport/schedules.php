<?php include("../../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedules | Admin</title>
    <link rel="stylesheet" href="../../assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid p-4">
        <?php
        if ($_SESSION["user_category"] == "admin") {
            $query = $_GET["query"];

            if ($query == "add") {
                echo "
                    <div class='card account custom-shadow mt-4 p-3'>
                        <h3 class='text-center'>Add Schedule</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-schedule.php'>
                            <div class='form-group'>
                                <label>Select Vehicle:</label>
                                <select class='form-control' name='vehicle_id' required>
                ";

                $vehicles_query = "SELECT vehicle_id, vehicle_number, vehicle_type FROM vehicles WHERE active = '1'";
                $response = mysqli_query($conn, $vehicles_query);
                $active_vehicles_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($active_vehicles_details as $key => $vehicle) {
                    echo "<option value='{$vehicle['vehicle_id']}'>{$vehicle['vehicle_number']} {$vehicle['vehicle_type']}</option>";
                }

                echo "
                        </select>
                    </div>
                    <div class='form-group'>
                        <label>Select Day:</label>
                        <select class='form-control' name='day' required>
                            <option value='sunday'>Sunday</option>
                            <option value='monday'>Monday</option>
                            <option value='tuesday'>Tuesday</option>
                            <option value='wednesday'>Wednesday</option>
                            <option value='thrusday'>Thrusday</option>
                            <option value='friday'>Friday</option>
                            <option value='saturday'>Saturday</option>
                        </select>
                    </div>
                ";

                echo "
                    <div class='row'>
                        <div class='col'>
                            <div class='form-group'>
                                <label>Departure time:</label>
                                <input type='time' class='form-control' name='departure' required>
                            </div>
                        </div>

                        <div class='col'>
                            <div class='form-group'>
                                <label>Arrival time:</label>
                                <input type='time' class='form-control' name='arrival' required>
                            </div>
                        </div>
                    </div>
                ";

                echo "
                    <div class='form-group'>
                        <label>Select Driver:</label>
                        <select class='form-control' name='driver_id' required>
                ";

                $drivers_query = "SELECT * FROM miscellaneous WHERE category = 'driver' AND active = '1'";
                $response = mysqli_query($conn, $drivers_query) or die(mysqli_error($conn));
                $active_drivers = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($active_drivers as $key => $driver) {
                    echo "<option value='{$driver['miscellaneous_id']}'>{$driver['name']}</option>";
                }

                echo "
                        </select>
                    </div>
                    <div class='form-group'>
                        <label>Select Round Trip:</label>
                        <select class='form-control' name='route_id' required>
                ";

                $routes_query = "SELECT * FROM routes WHERE active = '1'";
                $response = mysqli_query($conn, $routes_query);
                $active_routes = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($active_routes as $key => $route) {
                    echo "<option value='{$route['route_id']}'>{$route['start']} to {$route['finish']}</option>";
                }

                echo "
                                </select>
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='add_schedule' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                $schedules_query = "SELECT * FROM vehicles_schedule ORDER BY day";
                $response = mysqli_query($conn, $schedules_query);
                $schedules_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
                <div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Schedule List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Vehicle No.</th>
                                <th>Day</th>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th>Route</th>
                                <th>Driver</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
                  </div>
                ";

                foreach ($schedules_details as $attribute => $schedule_details) {
                    $driver_query = "SELECT * FROM miscellaneous WHERE miscellaneous_id = '{$schedule_details['driver_id']}' ";
                    $response = mysqli_query($conn, $driver_query) or die(mysqli_error($conn));
                    $driver_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                    $route_query = "SELECT * FROM routes WHERE route_id = '{$schedule_details['route_id']}' ";
                    $response = mysqli_query($conn, $route_query);
                    $route_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                    $vehicle_query = "SELECT * FROM vehicles WHERE vehicle_id = '{$schedule_details['vehicle_id']}' ";
                    $response = mysqli_query($conn, $vehicle_query);
                    $vehicle_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                    echo "
                        <tr>
                            <td>{$vehicle_details['vehicle_number']}</td>
                            <td>{$schedule_details['day']}</td>
                            <td>{$schedule_details['departure']}</td>
                            <td>{$schedule_details['arrival']}</td>
                            <td>{$route_details['start']} to {$route_details['finish']}</td>
                            <td>{$driver_details['name']}</td>
                    ";

                    if ($schedule_details['active'] == 1) {
                        echo "<td>Active</td>";
                    } else {
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./schedules.php?query=delete&schedule_id={$schedule_details['schedule_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./schedules.php?query=update&schedule_id={$schedule_details['schedule_id']}' class='text-primary'>Update</a>
                            </td>
                        </tr>
                    ";
                }

                echo "
                        </tbody>
                    </table>
                ";
            }

            if ($query == "update") {
                $schedule_id = $_GET["schedule_id"];
                $schedule_query = "SELECT 
                    *
                    FROM vehicles_schedule WHERE schedule_id = $schedule_id
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $schedule_query);
                $schedule_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-4 p-3'>
                        <h3 class='text-center'>Update Schedule</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-schedule.php?schedule_id=$schedule_id'>
                            <div class='form-group'>
                                <label>Select Vehicle:</label>
                                <select class='form-control' name='vehicle_id' required>
                ";

                $vehicles_query = "SELECT vehicle_id, vehicle_number, vehicle_type FROM vehicles WHERE active = '1'";
                $response = mysqli_query($conn, $vehicles_query);
                $active_vehicles_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($active_vehicles_details as $key => $vehicle) {
                    if($schedule_details['vehicle_id'] == $vehicle['vehicle_id']){
                        echo "<option value='{$vehicle['vehicle_id']}' selected>{$vehicle['vehicle_number']} {$vehicle['vehicle_type']}</option>";
                    }else{
                        echo "<option value='{$vehicle['vehicle_id']}'>{$vehicle['vehicle_number']} {$vehicle['vehicle_type']}</option>";
                    }
                }

                echo "
                        </select>
                    </div>
                    <div class='form-group'>
                        <label>Select Day:</label>
                        <select class='form-control' name='day' required>
                ";

                $days = array("sunday", "monday", "tuesday", "wednesday", "thrusday", "friday", "saturday");
                for ($i=0; $i < sizeof($days); $i++) { 
                    if($schedule_details['day'] == $days[$i]){
                        echo "<option value='{$days[$i]}' selected>{$days[$i]}</option>";
                    }else{
                        echo "<option value='{$days[$i]}'>{$days[$i]}</option>";
                    }
                }


                echo "
                        </select>
                    </div>
                ";

                echo "
                    <div class='row'>
                        <div class='col'>
                            <div class='form-group'>
                                <label>Departure time:</label>
                                <input type='time' class='form-control' name='departure' value='{$schedule_details['departure']}' required>
                            </div>
                        </div>

                        <div class='col'>
                            <div class='form-group'>
                                <label>Arrival time:</label>
                                <input type='time' class='form-control' name='arrival' value='{$schedule_details['arrival']}' required>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                ";

                if ($schedule_details['active'] == '1') {
                    echo "
                        <div class='col'>
                            <div class='form-group'>
                                <label>Status:</label>
                                <select class='form-control' name='active' required>
                                    <option selected value='1'>Active</option>
                                    <option value='0'>Inactive</option>
                                </select>
                            </div>
                        </div>
                    ";
                } else {
                    echo "
                        <div class='col'>
                            <div class='form-group'>
                                <label>Status:</label>
                                <select class='form-control' name='active' required>
                                    <option value='1'>Active</option>
                                    <option selected value='0'>Inactive</option>
                                </select>
                            </div>
                        </div>
                    ";
                }

                echo "
                    <div class='col'>
                        <div class='form-group'>
                            <label>Select Driver:</label>
                            <select class='form-control' name='driver_id' required>
                ";

                $drivers_query = "SELECT * FROM miscellaneous WHERE category = 'driver' AND active = '1'";
                $response = mysqli_query($conn, $drivers_query) or die(mysqli_error($conn));
                $active_drivers = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($active_drivers as $key => $driver) {
                    if($schedule_details['driver_id'] == $driver['miscellaneous_id']){
                        echo "<option value='{$driver['miscellaneous_id']}' selected>{$driver['name']}</option>";
                    }else{
                        echo "<option value='{$driver['miscellaneous_id']}'>{$driver['name']}</option>";
                    }
                }

                echo "
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label>Select Round Trip:</label>
                        <select class='form-control' name='route_id' required>
                ";

                $routes_query = "SELECT * FROM routes WHERE active = '1'";
                $response = mysqli_query($conn, $routes_query);
                $active_routes = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($active_routes as $key => $route) {
                    if($schedule_details['route_id'] == $route['route_id']){
                        echo "<option value='{$route['route_id']}' selected>{$route['start']} to {$route['finish']}</option>";
                    }else{
                        echo "<option value='{$route['route_id']}'>{$route['start']} to {$route['finish']}</option>";
                    }
                }

                echo "
                            </select>
                        </div>
                ";


                echo "
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_schedule' class='btn btn-outline-primary w-50'>Update Schedule</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "delete") {
                $schedule_id = $_GET["schedule_id"];
                $schedule_query = "DELETE FROM vehicles_schedule WHERE schedule_id = $schedule_id";
                mysqli_query($conn, $schedule_query) or die(mysqli_errno($conn));
                header('Location: ./schedules.php?query=manage');
            }
        } else {
            include("../page-not-found.php");
        }
        ?>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</html>
