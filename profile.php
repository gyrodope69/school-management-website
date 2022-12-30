<?php include('./config.php'); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | ERP Model</title>
    <link rel="stylesheet" href="./assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid p-5">
        <?php
        if ($_SESSION["user_category"] == "student" || $_SESSION["user_category"] == "teacher") {
            $email = $_SESSION['user_email'];

            if ($_SESSION["user_category"] == "student") {
                $student_query = "SELECT 
                    students.student_id, students.name, students.phone, students.gender, students.dob, students.address, classes.standard
                    FROM students JOIN classes ON students.class_id = classes.class_id 
                    WHERE students.email = '$email'
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $student_query);
                $student_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow p-2' style='background-color:cadetblue;'>
                        <h3 class='text-center'>Edit Profile</h3>
                        <hr>
                    
                        <form class='card-body' method='POST' action='./account-api.php?student_id={$student_details['student_id']}'>
                            <div class='form-group' style='background-color:#e6e2d3;'>
                                <label>Full Name:</label>
                                <input type='text' class='form-control' name='name' value='{$student_details['name']}' required>
                            </div>

                            <div class='form-group' style='background-color:#e6e2d3;' >
                                <label>Email:</label>
                                <input type='email' class='form-control' name='email' value='{$email}' readonly>
                            </div>
                ";


                if($student_details['gender'] == 'male'){
                    echo "
                        <div class='form-group' style='background-color:#e6e2d3;'>
                            <label>Gender:</label>
                            <select class='form-control' name='gender' required>
                                <option selected value='male'>Male</option>
                                <option value='female'>Female</option>
                                <option value='other'>Other</option>
                            </select>
                        </div>
                    ";

                }else if($student_details['gender'] == 'female'){
                    echo "
                        <div class='form-group' style='background-color:#e6e2d3;'>
                            <label>Gender:</label>
                            <select class='form-control' name='gender' required>
                                <option value='male'>Male</option>
                                <option selected value='female'>Female</option>
                                <option value='other'>Other</option>
                            </select>
                        </div>
                    ";
                }else{
                    echo "
                        <div class='form-group' style='background-color:#e6e2d3;'>
                            <label>Gender:</label>
                            <select class='form-control' name='gender' required>
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                                <option selected value='other'>Other</option>
                            </select>
                        </div>
                    ";
                }

                echo "
                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group' style='background-color:#e6e2d3;'>
                                        <label>Phone:</label>
                                        <input type='number' class='form-control' name='phone' value={$student_details['phone']} required>
                                    </div>
                                </div>

                                <div class='col'>
                                    <div class='form-group' style='background-color:#e6e2d3;'>
                                        <label>D.O.B:</label>
                                        <input type='date' class='form-control' name='dob' value={$student_details['dob']}>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group' style='background-color:#e6e2d3;'>
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
                                <button type='submit' name='update_student' class='btn btn-outline-primary w-50'>Update Profile</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($_SESSION["user_category"] == "teacher") {
                $teacher_query = "SELECT 
                    teacher_id, name, designation, phone, gender, doj, address
                    FROM teachers WHERE email = '$email'
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $teacher_query);
                $teacher_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-2'>
                    <h3 class='text-center'>Update Teacher</h3>
                    <hr>
                
                    <form class='card-body' method='POST' action='./account-api.php?teacher_id={$teacher_details['teacher_id']}'>
                        <div class='form-group'>
                            <label>Full Name:</label>
                            <input type='text' class='form-control' name='name' value='{$teacher_details['name']}' required>
                        </div>

                        <div class='form-group' style='background-color:cadetblue;'>
                            <label>Email:</label>
                            <input type='email' class='form-control' name='email' value='$email' readonly>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                <div class='form-group' style='background-color:#e6e2d3;'>
                                    <label>Designation:</label>
                                    <input type='text' class='form-control' name='designation' value='{$teacher_details['designation']}' readonly>
                                </div>
                            </div>
                ";

                if($teacher_details['gender'] == 'male'){
                    echo "
                            <div class='col'>
                                <div class='form-group' style='background-color:#e6e2d3;'>
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
                                <div class='form-group' style='background-color:#e6e2d3;'>
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
                                <div class='form-group' style='background-color:#e6e2d3;'>
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
                                    <div class='form-group' style='background-color:#e6e2d3;'>
                                        <label>Phone:</label>
                                        <input type='number' class='form-control' name='phone' value={$teacher_details['phone']} required>
                                    </div>
                                </div>

                                <div class='col'>
                                    <div class='form-group' style='background-color:#e6e2d3;'>
                                        <label>D.O.J:</label>
                                        <input type='date' class='form-control' name='doj' value={$teacher_details['doj']} readonly>
                                    </div>
                                </div>

                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group' style='background-color:#e6e2d3;'>
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
        } else {
            include('./page-not-found.php');
        }
        ?>
    </div>
</body>

</html>
