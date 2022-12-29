<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject | Admin</title>
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
color: #89C4E1;
background-color:white;
}
.btn-outline-primary {
color: #89C4E1;
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
               <div class='card account custom-shadow mt-5 p-3'  style='background-color:#89C4E1;color:white;border-radius: 1rem 0 0 1rem';>
                        <h3 class='text-center'>Add Subject</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-subject.php'>
                            <div class='form-group'>
                                <label>Subject Title:</label>
                                <input type='text' class='form-control' name='title' required>
                            </div>

                            <div class='form-group'>
                                <label>Description:</label>
                                <textarea type='text' class='form-control' name='descr' cols='6' rows='2' required></textarea>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Code:</label>
                                        <input type='text' class='form-control' name='code' required>
                                    </div>
                                </div>

                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Credit:</label>
                                        <input type='number' class='form-control' name='credit' required>
                                    </div>
                                </div>
                            </div>
                ";

                echo "
                    <div class='form-group'>
                        <label>Teacher:</label>
                        <select class='form-control' name='teacher_id' required>
                ";

                include("../info/teachers.php");
                $teachers_query = "SELECT teacher_id, name FROM teachers WHERE active = 1 ORDER BY teacher_id ASC";
                $response = mysqli_query($conn, $teachers_query) or die(mysqli_error($conn));
                $teachers_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($teachers_details as $key => $teacher_details) {
                    if ($subject_details["teacher_id"] == $teacher_details["teacher_id"]) {
                        echo "<option value={$teacher_details['teacher_id']} selected>{$teacher_details['name']}</option>";
                    } else {
                        echo "<option value={$teacher_details['teacher_id']}>{$teacher_details['name']}</option>";
                    }
                }

                echo "
                                </select>
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='add_subject' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                $subjects_query = "SELECT 
                    subjects.subject_id, subjects.title, subjects.descr, subjects.code, subjects.credit, subjects.active, teachers.name 
                    FROM subjects JOIN teachers ON subjects.teacher_id = teachers.teacher_id
                ";
                $response = mysqli_query($conn, $subjects_query);
                $subjects_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
               <div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Subjects List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Code</th>
                                <th>Credit</th>
                                <th>Teacher</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
                </div>
                ";

                foreach ($subjects_details as $attribute => $subject_details) {
                    echo "
                        <tr>
                            <td>{$subject_details['title']}</td>
                            <td>{$subject_details['descr']}</td>
                            <td>{$subject_details['code']}</td>
                            <td>{$subject_details['credit']}</td>
                            <td>{$subject_details['name']}</td>
                    ";

                    if ($subject_details['active'] == 1) {
                        echo "<td>Active</td>";
                    } else {
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./subjects.php?query=delete&subject_id={$subject_details['subject_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./subjects.php?query=update&subject_id={$subject_details['subject_id']}' class='text-primary'>Update</a>
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
                $subject_id = $_GET["subject_id"];
                $subject_query = "SELECT * FROM subjects WHERE subject_id = $subject_id";
                $response = mysqli_query($conn, $subject_query);
                $subject_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-3'>
                        <h3 class='text-center'>Update Subject</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-subject.php?subject_id=$subject_id'>
                            <div class='form-group'>
                                <label>Subject Title:</label>
                                <input type='text' class='form-control' name='title' value='{$subject_details['title']}' required>
                            </div>

                            <div class='form-group'>
                                <label>Description:</label>
                                <textarea type='text' class='form-control' name='descr' cols='6' rows='4' required>{$subject_details['descr']}</textarea>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Code:</label>
                                        <input type='text' class='form-control' name='code' value='{$subject_details['code']}' required>
                                    </div>
                                </div>

                                <div class='col'>
                                    <div class='form-group'>
                                        <label>Credit:</label>
                                        <input type='number' class='form-control' name='credit' value='{$subject_details['credit']}' required>
                                    </div>
                                </div>
                ";

                if ($subject_details['active'] == '1') {
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
                    </div>
                        <div class='form-group'>
                            <label>Teacher:</label>
                            <select class='form-control' name='teacher_id' required>
                ";

                $teachers_query = "SELECT teacher_id, name FROM teachers WHERE active = 1 ORDER BY teacher_id ASC";
                $response = mysqli_query($conn, $teachers_query) or die(mysqli_error($conn));
                $teachers_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($teachers_details as $key => $teacher_details) {
                    if ($subject_details["teacher_id"] == $teacher_details["teacher_id"]) {
                        echo "<option value={$teacher_details['teacher_id']} selected>{$teacher_details['name']}</option>";
                    } else {
                        echo "<option value={$teacher_details['teacher_id']}>{$teacher_details['name']}</option>";
                    }
                }

                echo "
                                </select>
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_subject' class='btn btn-outline-primary w-50'>Update Subject</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "delete") {
                $subject_id = $_GET["subject_id"];
                $student_query = "DELETE FROM subjects WHERE subject_id = $subject_id";
                mysqli_query($conn, $student_query) or die(mysqli_errno($conn));
                header('Location: ./subjects.php?query=manage');
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
