<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade | Teacher</title>
    <link rel="stylesheet" href="../assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid" style="padding:0;">
        <?php
        if ($_SESSION["user_category"] == "teacher") {
            include("../includes/header2.php");

            $email = $_SESSION["user_email"];
            $teacher_query = "SELECT teacher_id FROM teachers WHERE email = '$email'";
            $response = mysqli_query($conn, $teacher_query);
            $teacher_id = mysqli_fetch_array($response, MYSQLI_ASSOC)["teacher_id"];

            echo '
                <section class="content align-items-center">
            ';

            if (!isset($_GET["class_id"])) {
                echo "
                    <div class='card account custom-shadow mt-4 p-2'>
                        <h3 class='text-center'>Choose Standard</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-grade.php'>
                ";

                echo "
                    <div class='form-group'>
                        <label>Standard:</label>
                        <select class='form-control' name='class_id'>
                ";

                $classes_query = "SELECT * FROM classes WHERE active = 1";
                $response = mysqli_query($conn, $classes_query) or die(mysqli_errno($conn));
                $classes_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($classes_details as $key => $class_details) {
                    echo "
                        <option value='{$class_details['class_id']}'>{$class_details['standard']}</option>
                    ";
                }

                echo "
                        </select>
                    </div>
                ";

                echo "
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='submit_class_info' class='btn btn-outline-primary w-50'>Search Subjects</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if (isset($_GET["class_id"]) && !isset($_GET["subject_id"])) {
                $class_id = $_GET["class_id"];
                $class_query = "SELECT standard, subject_ids FROM classes WHERE class_id = '$class_id'";
                $response = mysqli_query($conn, $class_query) or die(mysqli_errno($conn));
                $class_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                $filter_subjects_query = "SELECT 
                    subject_id, code 
                    FROM subjects WHERE teacher_id = $teacher_id 
                ";
                $response = mysqli_query($conn, $filter_subjects_query) or die(mysqli_errno($conn));
                $assigned_subjects_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                $filtered_subjects = array();
                foreach ($assigned_subjects_details as $key => $assigned_subject_details) {
                    for ($i = 0; $i < sizeof(json_decode($class_details["subject_ids"])); $i++) {
                        if ($assigned_subject_details["subject_id"] == $class_details["subject_ids"][$i]) {
                            array_push($filtered_subjects, $assigned_subject_details);
                        }
                    }
                }

                echo "
                    <div class='card account custom-shadow mt-4 p-1'>
                        <h3 class='text-center'>Choose Subject</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-grade.php'>
                            <div class='form-group'>
                                <label>Standard:</label>
                                <input type='text' class='form-control' name='standard' value='{$class_details['standard']}' readonly required>
                                <input type='number' class='form-control' name='class_id' value='$class_id' readonly hidden>
                            </div>
                            <div class='form-group'>
                                <label>Select Subject:</label>
                                <select class='form-control' name='subject_id' required>
                ";

                for ($i = 0; $i < sizeof($filtered_subjects); $i++) {
                    echo "<option value='{$filtered_subjects[$i]['subject_id']}'>{$filtered_subjects[$i]['code']}</option>";
                }

                echo "
                                </select>
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='submit_subject_info' class='btn btn-outline-primary w-50'>Search Students</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if (isset($_GET["class_id"]) && isset($_GET["subject_id"])) {
                $class_id = $_GET["class_id"];
                $subject_id = $_GET["subject_id"];

                $students_query = "SELECT * FROM students WHERE class_id = '$class_id' AND active = 1";
                $response = mysqli_query($conn, $students_query) or die(mysqli_error($conn));
                $students_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                if (sizeof($students_details) > 0) {
                    echo "
                            <form class='card-body' method='POST' action='manage-grade.php?class_id=$class_id&subject_id=$subject_id'>
                                <div class='table-responsive'>
                                    <table class='table table-hover'>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Mid Term 1 Marks</th>
                                                <th>Mid Term 2 Marks</th>
                                                <th>End Term Marks</th>
                                                <th>Other (Viva + Assignments) Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        ";

                    foreach ($students_details as $key => $student_details) {
                        $student_id = $student_details["student_id"];
                        $find_marks = "SELECT * FROM grades WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'";
                        $response = mysqli_query($conn, $find_marks) or die(mysqli_error($conn));
                        if (mysqli_num_rows($response) == 0) {
                            $mid_term_1 = $mid_term_2 = $end_term = $other = 0;
                        } else {
                            $marks = mysqli_fetch_array($response, MYSQLI_ASSOC);
                            $mid_term_1 = $marks["mid_term_1"];
                            $mid_term_2 = $marks["mid_term_2"];
                            $end_term = $marks["end_term"];
                            $other = $marks["other"];
                        }


                        echo "
                            <tr>
                                <td>{$student_details['name']}</td>
                                <td>{$student_details['email']}</td>
                                <td>{$student_details['phone']}</td>
                                <td><input type='number' class='form-control' name='mid_term_1[$student_id]' min='0' max='25' value='$mid_term_1'></td>
                                <td><input type='number' class='form-control' name='mid_term_2[$student_id]' min='0' max='25' value='$mid_term_2'></td>
                                <td><input type='number' class='form-control' name='end_term[$student_id]' min='0' max='25' value='$end_term'></td>
                                <td><input type='number' class='form-control' name='other[$student_id]' min='0' max='25' value='$other'></td>
                            </tr>
                        ";
                    }

                    echo "          </tbody>
                                    </table>
                                </div>
                                <div class='text-center mt-5'>
                                    <button type='submit' name='update_grade' class='btn btn-success w-50'>Update Grade</button>
                                </div>
                            </form>
                        ";
                } else {
                    echo "
                            <div class='text-center mt-4'>
                                <h3>No students registered yet.</h3>
                            </div>
                        ";
                }
            }

            echo '
                </section>
            ';
        } else {
            include("../page-not-found.php");
        }
        ?>
    </div>
</body>

</html>