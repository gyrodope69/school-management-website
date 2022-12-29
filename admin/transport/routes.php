<?php include("../../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes | Admin</title>
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
						<h3 class='text-center'>Create Route</h3>
						<hr>
						<form class='card-body' method='POST' action='manage-route.php'>
							<div class='form-group'>
								<label>Start:</label>
								<input type='text' class='form-control' name='start' required>
							</div>
							<div class='form-group'>
								<label>Destination:</label>
								<input type='text' class='form-control' name='finish' required>
							</div>
							<div class='form-group'>
								<label>Fair:</label>
								<input type='number' class='form-control' name='fair' required>
							</div>
							<br>
							<div class='text-center'>
								<button type='submit' name='add_route' class='btn btn-outline-primary w-50'>ADD</button>
							</div>
						</form>
					</div>
				";
            }

            if ($query == "manage") {
                $routes_query = "SELECT * FROM routes";
                $response = mysqli_query($conn, $routes_query);
                $routes_details = mysqli_fetch_all($response, MYSQLI_ASSOC);
                echo "
		<div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Route List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Start</th>
                                <th>Finish</th>
                                <th>Fair</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
		<div>
                ";

                foreach ($routes_details as $attribute => $route_details) {
                    echo "
                        <tr>
                            <td>{$route_details['start']}</td>
                            <td>{$route_details['finish']}</td>
                            <td>{$route_details['fair']}</td>
                    ";

                    if($route_details['active'] == 1){
                        echo "<td>Active</td>";
                    }else{
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./routes.php?query=delete&route_id={$route_details['route_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./routes.php?query=update&route_id={$route_details['route_id']}' class='text-primary'>Update</a>
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
                $route_id = $_GET["route_id"];
                $route_query = "SELECT 
                    *
                    FROM routes WHERE route_id = $route_id
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $route_query);
                $route_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
					<div class='card account custom-shadow mt-4 p-3'>
						<h3 class='text-center'>Update Route</h3>
						<hr>
						<form class='card-body' method='POST' action='manage-route.php?route_id=$route_id'>
							<div class='form-group'>
								<label>Start:</label>
								<input type='text' class='form-control' name='start' value='{$route_details['start']}' required>
							</div>
							<div class='form-group'>
								<label>Destination:</label>
								<input type='text' class='form-control' name='finish' value='{$route_details['finish']}' required>
							</div>
                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Fair:</label>
                                        <input type='number' class='form-control' name='fair' value='{$route_details['fair']}' required>
                                    </div>
                                </div>
				";

                if ($route_details['active'] == '1') {
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
                        </div>
                    ";
                }

                echo "
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_route' class='btn btn-outline-primary w-50'>Update Route</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "delete") {
                $route_id = $_GET["route_id"];
                $route_query = "DELETE FROM routes WHERE route_id = $route_id";
                mysqli_query($conn, $route_query) or die(mysqli_errno($conn));
                header('Location: ./routes.php?query=manage');
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
