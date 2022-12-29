<?php include("../../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver | Admin</title>
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
                        <h3 class='text-center'>Add Driver</h3>
                        <hr>
                        <form class='card-body' method='POST' action='./manage-driver.php'>
                            <div class='form-group'>
                                <label>Full Name:</label>
                                <input type='text' class='form-control' name='name' required>
                            </div>

                            <div class='form-group'>
                                <label>Email:</label>
                                <input type='email' class='form-control' name='email' required>
                            </div>
                ";

                echo "
                    <div class='form-group'>
                        <label>Gender:</label>
                        <select class='form-control' name='gender' required>
                            <option value='male'>Male</option>
                            <option value='female'>Female</option>
                            <option value='other'>Other</option>
                        </select>
                    </div>

                    <div class='row'>
                        <div class='col'>
                            <div class='form-group'>
                                <label>Phone:</label>
                                <input type='number' class='form-control' name='phone' required>
                            </div>
                        </div>

                        <div class='col'>
                            <div class='form-group'>
                                <label>D.O.J:</label>
                                <input type='date' class='form-control' name='doj'>
                            </div>
                        </div>
                    </div>

                            <div class='form-group'>
                                <label>Address:</label>
                                <textarea type='text' class='form-control' name='address' cols='6' rows='2' required></textarea>
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='add_driver' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                $drivers_query = "SELECT 
                    miscellaneous_id, name, email, phone, gender, doj, address, active FROM miscellaneous WHERE category = 'driver'
                ";
                $response = mysqli_query($conn, $drivers_query);
                $drivers_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
                <div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Driver List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>D.O.J</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
                 </div>
                ";

                foreach ($drivers_details as $attribute => $driver_details) {
                    echo "
                        <tr>
                            <td>{$driver_details['name']}</td>
                            <td>{$driver_details['email']}</td>
                            <td>{$driver_details['phone']}</td>
                            <td>{$driver_details['gender']}</td>
                            <td>{$driver_details['doj']}</td>
                            <td>{$driver_details['address']}</td>
                    ";

                    if($driver_details['active'] == 1){
                        echo "<td>Active</td>";
                    }else{
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./drivers.php?query=delete&miscellaneous_id={$driver_details['miscellaneous_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./drivers.php?query=update&miscellaneous_id={$driver_details['miscellaneous_id']}' class='text-primary'>Update</a>
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
                $miscellaneous_id = $_GET["miscellaneous_id"];
                $driver_query = "SELECT 
                    name, email, phone, gender, doj, address, active
                    FROM miscellaneous WHERE miscellaneous_id = $miscellaneous_id
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $driver_query);
                $driver_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-2'>
                    <h3 class='text-center'>Update Driver</h3>
                    <hr>
                
                    <form class='card-body' method='POST' action='./manage-driver.php?miscellaneous_id=$miscellaneous_id'>
                        <div class='form-group'>
                            <label>Full Name:</label>
                            <input type='text' class='form-control' name='name' value='{$driver_details['name']}' required>
                        </div>

                        <div class='form-group'>
                            <label>Email:</label>
                            <input type='email' class='form-control' name='email' value='{$driver_details['email']}' required>
                        </div>
                        <div class='row'>
                ";

                if($driver_details['active'] == '1'){
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
                }else{
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

                if($driver_details['gender'] == 'male'){
                    echo "
                            <div class='col'>
                                <div class='form-group'>
                                    <label>Gender:</label>
                                    <select class='form-control' name='gender' required>
                                        <option selected value='male'>Male</option>
                                        <option value='female'>Female</option>
                                        <option value='other'>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    ";

                }else if($driver_details['gender'] == 'female'){
                    echo "
                            <div class='col'>
                                <div class='form-group'>
                                    <label>Gender:</label>
                                    <select class='form-control' name='gender' required>
                                        <option value='male'>Male</option>
                                        <option selected value='female'>Female</option>
                                        <option value='other'>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    ";
                }else{
                    echo "
                            <div class='col'>
                                <div class='form-group'>
                                    <label>Gender:</label>
                                    <select class='form-control' name='gender' required>
                                        <option value='male'>Male</option>
                                        <option value='female'>Female</option>
                                        <option selected value='other'>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    ";
                }


                echo "
                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Phone:</label>
                                        <input type='number' class='form-control' name='phone' value={$driver_details['phone']} required>
                                    </div>
                                </div>

                                <div class='col'>
                                    <div class='form-group'>
                                        <label>D.O.J:</label>
                                        <input type='date' class='form-control' name='doj' value={$driver_details['doj']}>
                                    </div>
                                </div>

                            </div>

                            <div class='form-group'>
                                <label>Address:</label>
                                <textarea type='text' class='form-control' name='address' cols='6' rows='2' required>{$driver_details['address']}</textarea>
                            </div>

                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_driver' class='btn btn-outline-primary w-50'>Update Profile</button>
                            </div>

                        </form>
                    </div>
                ";
            }

            if($query == "delete"){
                $miscellaneous_id = $_GET["miscellaneous_id"];
                $driver_query = "DELETE FROM miscellaneous WHERE miscellaneous_id = $miscellaneous_id";
                mysqli_query($conn, $driver_query) or die(mysqli_errno($conn));
                header('Location: ./drivers.php?query=manage');
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
