<?php include("../../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles | Admin</title>
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
						<h3 class='text-center'>Add Vehicle</h3>
						<hr>
						<form class='card-body' method='POST' action='./manage-vehicle.php'>
							<div class='form-group'>
								<label>Vehicle Type:</label>
								<input type='text' class='form-control' name='type' required>
							</div>
							<div class='form-group'>
								<label>Vehicle Number:</label>
								<input type='text' class='form-control' name='plate' required>
							</div>
							<div class='text-center'>
								<button type='submit' name='add_vehicle' class='btn btn-outline-primary w-50'>ADD</button>
							</div>
						</form>
					</div>
				";
                
            }

            if ($query == "manage") {
                $vehicles_query = "SELECT * FROM vehicles";
                $response = mysqli_query($conn, $vehicles_query);
                $vehicles_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
		<div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Vehicle List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Type</th>
                                <th>Vehicle No.</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
		</div>
                ";

                foreach ($vehicles_details as $attribute => $vehicle_details) {
                    echo "
                        <tr>
                            <td>{$vehicle_details['vehicle_type']}</td>
                            <td>{$vehicle_details['vehicle_number']}</td>
                    ";

                    if ($vehicle_details['active'] == 1) {
                        echo "<td>Active</td>";
                    } else {
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./vehicles.php?query=delete&vehicle_id={$vehicle_details['vehicle_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./vehicles.php?query=update&vehicle_id={$vehicle_details['vehicle_id']}' class='text-primary'>Update</a>
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
                $vehicle_id = $_GET["vehicle_id"];
                $vehicle_query = "SELECT 
                    *
                    FROM vehicles WHERE vehicle_id = $vehicle_id
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $vehicle_query);
                $vehicle_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-4 p-3'>
                        <h3 class='text-center'>Update Vehicle</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-vehicle.php?vehicle_id=$vehicle_id'>
                            <div class='form-group'>
                                <label>Vehicle Type:</label>
                                <input type='text' class='form-control' name='type' value='{$vehicle_details['vehicle_type']}' required>
                            </div>
                            <div class='form-group'>
                                <label>Vehicle Number:</label>
                                <input type='text' class='form-control' name='plate' value='{$vehicle_details['vehicle_number']}' required>
                            </div>
                ";


                if ($vehicle_details['active'] == '1') {
                    echo "
                        <div class='form-group'>
                            <label>Status:</label>
                            <select class='form-control' name='active' required>
                                <option selected value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                    ";
                } else {
                    echo "
                        <div class='form-group'>
                            <label>Status:</label>
                            <select class='form-control' name='active' required>
                                <option value='1'>Active</option>
                                <option selected value='0'>Inactive</option>
                            </select>
                        </div>
                    ";
                }

                echo "
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_vehicle' class='btn btn-outline-primary w-50'>Update Vehicle</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "delete") {
                $vehicle_id = $_GET["vehicle_id"];
                $vehicle_query = "DELETE FROM vehicles WHERE vehicle_id = $vehicle_id";
                mysqli_query($conn, $vehicle_query) or die(mysqli_errno($conn));
                header('Location: ./vehicles.php?query=manage');
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
