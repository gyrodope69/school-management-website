<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student | Admin</title>
    <link rel="stylesheet" href="../assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <h3 class='text-center'>Add Student</h3>
                        <hr>
                    
                
                    <form class='card-body' method='POST' action='./manage-student.php'>
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
                                    <label>Class:</label>         
                                    <select class='form-control' name='class_id' required>
                             
                ";

                $classes_query = "SELECT class_id, standard FROM classes WHERE active = 1 ORDER BY class_id ASC";
                $response = mysqli_query($conn, $classes_query) or die(mysqli_errno($conn));
                $classes_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($classes_details as $attribute => $value) {
                    echo "
                        <option value={$value['class_id']}>{$value['standard']}</option>
                    ";
                }


                echo "
                            </select>
                        </div>
                    </div>
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
                                        <label>D.O.B:</label>
                                        <input type='date' class='form-control' name='dob'>
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
                                <button type='submit' name='add_student' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>

                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                $students_query = "SELECT 
                    students.student_id, students.name, students.email, students.phone, students.gender, students.dob, students.address, students.active, classes.standard 
                    FROM students JOIN classes ON students.class_id = classes.class_id ORDER BY classes.class_id ASC
                ";
                $response = mysqli_query($conn, $students_query);
                $students_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
                    <h2>Student List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Standard</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>D.O.B</th>
                                <th>Address</th>
                             
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
                ";

                foreach ($students_details as $attribute => $student_details) {
                    echo "
                        <tr>
                            <td>{$student_details['name']}</td>
                            <td>{$student_details['email']}</td>
                            <td>{$student_details['standard']}</td>
                            <td>{$student_details['phone']}</td>
                            <td>{$student_details['gender']}</td>
                            <td>{$student_details['dob']}</td>
                            <td>{$student_details['address']}</td>
                    ";

                    // if($student_details['active'] == '1'){
                    //     echo "<td>Active</td>";
                    // }else{
                    //     echo "<td>Inactive</td>";
                    // }

                    echo "
                            <td>
                                <a href='./students.php?query=delete&student_id={$student_details['student_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./students.php?query=update&student_id={$student_details['student_id']}' class='text-primary'>Update</a>
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
                $student_id = $_GET["student_id"];
                $student_query = "SELECT 
                    students.name, students.email, students.phone, students.gender, students.dob, students.address, classes.class_id, students.active, classes.standard
                    FROM students JOIN classes ON students.class_id = classes.class_id WHERE students.student_id = $student_id AND classes.active = 1   AND students.active = 1
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $student_query);
                $student_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-2'>
                    <h3 class='text-center'>Update Student</h3>
                    <hr>
                
                    <form class='card-body' method='POST' action='./manage-student.php?student_id=$student_id'>
                        <div class='form-group'>
                            <label>Full Name:</label>
                            <input type='text' class='form-control' name='name' value='{$student_details['name']}' required>
                        </div>

                        <div class='form-group'>
                            <label>Email:</label>
                            <input type='email' class='form-control' name='email' value='{$student_details['email']}' required>
                        </div>

                        <div class='row'>
                            <div class='col'>
                                <div class='form-group'>
                                    <label>Class:</label>
                                    <select class='form-control' name='class_id' required>
                ";

                $classes_query = "SELECT class_id, standard FROM classes WHERE active = 1 ORDER BY class_id ASC";
                $response = mysqli_query($conn, $classes_query) or die(mysqli_errno($conn));
                $classes_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($classes_details as $attribute => $value) {
                    if ($student_details['class_id'] == $value['class_id']) {
                        echo "<option selected value={$value['class_id']}>{$value['standard']}</option>";
                    } else {
                        echo "<option value={$value['class_id']}>{$value['standard']}</option>";
                    }
                }

                echo "
                            </select>
                        </div>
                    </div>
                ";

                if($student_details['gender'] == 'male'){
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

                }else if($student_details['gender'] == 'female'){
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

                // if($student_details['active'] == '1'){
                //     echo "
                //     <div class='form-group'>
                //         <label>Status:</label>
                //             <select class='form-control' name='active' required>
                //                 <option selected value='1'>Active</option>
                //                 <option value='0'>Inactive</option>
                //             </select>
                //      </div>
                //     ";
                // }else{
                //     echo "
                //     <div class='form-group'>
                //         <label>Status:</label>
                //             <select class='form-control' name='active' required>
                //                 <option value='1'>Active</option>
                //                 <option selected value='0'>Inactive</option>
                //             </select>
                // </div>
                //     ";
                // }


                echo "
                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Phone:</label>
                                        <input type='number' class='form-control' name='phone' value={$student_details['phone']} required>
                                    </div>
                                </div>

                                <div class='col'>
                                    <div class='form-group'>
                                        <label>D.O.B:</label>
                                        <input type='date' class='form-control' name='dob' value={$student_details['dob']}>
                                    </div>
                                </div>

                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Address:</label>
                                        <textarea type='text' class='form-control' name='address' cols='6' rows='2' required>{$student_details['address']}</textarea>
                                    </div>
                                </div>
                                <div class='col'>
                                    <label>New Password:</label>
                                    <input type='password' class='form-control'name='password'>
                                </div>
                            </div>

                            <br>
                            <div class='text-center'>
                                    <button type='submit' name='update_student' class='btn btn-outline-light w-50'>Update Profile</button>
                                </div>

                        </form>
                    </div>
                ";
            }

            if($query == "delete"){
                $student_id = $_GET["student_id"];
                $student_query = "DELETE FROM students WHERE student_id = $student_id AND active = 1";
                mysqli_query($conn, $student_query) or die(mysqli_errno($conn));
                header('Location: ./students.php?query=manage');
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
