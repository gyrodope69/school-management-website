<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher | Admin</title>
    <link rel="stylesheet" href="../assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style type="text/css">

    .btn {
    border-color: white;
    color: #3AB4F2;
    background-color:white;
    }
    .btn-outline-primary {
    color: #3AB4F2;
    border-color: white;
}
    </style>
    </head>

<body>
    <div class="container-fluid p-4">
        <?php
        if ($_SESSION["user_category"] == "admin") {
            $query = $_GET["query"];
            
            if ($query == "add") {
                echo "
                   <div class='card account custom-shadow mt-5 p-2' style='background-color:#3AB4F2;color:white;border-radius: 1rem 0 0 1rem';>
                        <h3 class='text-center'>Add Teacher</h3>
                        <hr>
                
                        <form class='card-body' method='POST' action='./manage-teacher.php'>
                            <div class='form-group'>
                                <label>Full Name:</label>
                                <input type='text' class='form-control' name='name' required>
                            </div>

                            <div class='form-group'>
                                <label>Email:</label>
                                <input type='email' class='form-control' name='email' required>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Gender:</label>
                                        <select class='form-control' name='gender' required>
                                            <option value='male'>Male</option>
                                            <option value='female'>Female</option>
                                            <option value='other'>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Designation:</label>
                                        <input type='text' class='form-control' name='designation' required>
                                    </div>
                                </div>
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
                                        <input type='date' class='form-control' name='doj' required>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Address:</label>
                                        <textarea type='text' class='form-control' name='address' cols='6' rows='2' required></textarea>
                                    </div>
                                </div>
                                <div class='col'>
                                    <label>Password:</label>
                                    <input type='password' class='form-control'name='password' required>
                                </div>
                            </div>

                            <br>
                            <div class='text-center'>
                                <button type='submit' name='add_teacher' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                $teachers_query = "SELECT 
                    teacher_id, name, email, designation, phone, gender, doj, address, active
                    FROM teachers ORDER BY teacher_id ASC
                ";
                $response = mysqli_query($conn, $teachers_query);
                $teachers_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
                <div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Teacher List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Designation</th>
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

                foreach ($teachers_details as $attribute => $teacher_details) {
                    echo "
                        <tr>
                            <td>{$teacher_details['name']}</td>
                            <td>{$teacher_details['email']}</td>
                            <td>{$teacher_details['designation']}</td>
                            <td>{$teacher_details['phone']}</td>
                            <td>{$teacher_details['gender']}</td>
                            <td>{$teacher_details['doj']}</td>
                            <td>{$teacher_details['address']}</td>
                    ";

                    if($teacher_details['active'] == '1'){
                        echo "<td>Active</td>";
                    }else{
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./teachers.php?query=delete&teacher_id={$teacher_details['teacher_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./teachers.php?query=update&teacher_id={$teacher_details['teacher_id']}' class='text-primary'>Update</a>
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
                $teacher_id = $_GET["teacher_id"];
                $teacher_query = "SELECT 
                    name, email, designation, phone, gender, doj, address, active
                    FROM teachers WHERE teacher_id = $teacher_id
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $teacher_query);
                $teacher_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-2'>
                    <h3 class='text-center'>Update Teacher</h3>
                    <hr>
                
                    <form class='card-body' method='POST' action='./manage-teacher.php?teacher_id=$teacher_id'>
                        <div class='form-group'>
                            <label>Full Name:</label>
                            <input type='text' class='form-control' name='name' value='{$teacher_details['name']}' required>
                        </div>

                        <div class='form-group'>
                            <label>Email:</label>
                            <input type='email' class='form-control' name='email' value='{$teacher_details['email']}' required>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                <div class='form-group'>
                                    <label>Designation:</label>
                                    <input type='text' class='form-control' name='designation' value='{$teacher_details['designation']}' required>
                                </div>
                            </div>
                ";

                if($teacher_details['gender'] == 'male'){
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

                }else if($teacher_details['gender'] == 'female'){
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

                if($teacher_details['active'] == '1'){
                    echo "
                        <div class='form-group'>
                            <label>Status:</label>
                            <select class='form-control' name='active' required>
                                <option selected value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                    ";
                }else{
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
                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Phone:</label>
                                        <input type='number' class='form-control' name='phone' value={$teacher_details['phone']} required>
                                    </div>
                                </div>

                                <div class='col'>
                                    <div class='form-group'>
                                        <label>D.O.J:</label>
                                        <input type='date' class='form-control' name='doj' value={$teacher_details['doj']}>
                                    </div>
                                </div>

                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Address:</label>
                                        <textarea type='text' class='form-control' name='address' cols='6' rows='2' required>{$teacher_details['address']}</textarea>
                                    </div>
                                </div>
                                <div class='col'>
                                    <label>New Password:</label>
                                    <input type='password' class='form-control'name='password'>
                                </div>
                            </div>

                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_teacher' class='btn btn-outline-primary w-50'>Update Profile</button>
                            </div>
                            

                        </form>
                    </div>
                ";
            }

            if($query == "delete"){
                $teacher_id = $_GET["teacher_id"];
                $teacher_query = "DELETE FROM teachers WHERE teacher_id = $teacher_id AND active = 1";
                mysqli_query($conn, $teacher_query) or die(mysqli_errno($conn));
                header('Location: ./teachers.php?query=manage');
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
