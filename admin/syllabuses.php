<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syllabus | Admin</title>
    <link rel="stylesheet" href="../assets/css/base-styles.css">
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
                   <div class='card account custom-shadow mt-5 mb-5 p-3'>
                        <h3 class='text-center'>Get Syllabus</h3>
                        <hr>
                        <form class='card-body' method='POST' action='find-file.php'>
                            <div class='form-group'>
                                    <label>Class:</label>
                                    <select class='form-control' name='class_id' required>
                ";

                $classes_query = "SELECT class_id, standard FROM classes WHERE active = 1 ORDER BY class_id ASC";
                $response = mysqli_query($conn, $classes_query) or die(mysqli_errno($conn));
                $classes_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                foreach ($classes_details as $attribute => $class_details) {
                    echo "<option value={$class_details['class_id']}>{$class_details['standard']}</option>";
                }

                echo "
                                </select>
                            </div>
                            <div class='form-group'>
                                <label>Upload File:</label> <br>
                                <input type='file' name='fileToUpload' required>
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='add_syllabus' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                $syllabuses_query = "SELECT 
                    syllabuses.syllabus_id, classes.standard, syllabuses.file, syllabuses.active 
                    FROM syllabuses JOIN classes ON syllabuses.class_id = classes.class_id
                    ORDER BY classes.class_id ASC
                ";
                $response = mysqli_query($conn, $syllabuses_query);
                $syllabuses_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
                <div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Syllabus List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Standard</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
                </div>
                ";

                foreach ($syllabuses_details as $attribute => $syllabus_details) {
                    echo "
                        <tr>
                            <td>{$syllabus_details['standard']}</td>
                            <td><a href='../assets/vendor/syllabus/{$syllabus_details['file']}'>{$syllabus_details['file']}</a></td>
                    ";

                    if($syllabus_details['active'] == '1'){
                        echo "<td>Active</td>";
                    }else{
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./syllabuses.php?query=delete&syllabus_id={$syllabus_details['syllabus_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./syllabuses.php?query=update&syllabus_id={$syllabus_details['syllabus_id']}' class='text-primary'>Update</a>
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
                $syllabus_id = $_GET["syllabus_id"];
                $syllabuses_query = "SELECT 
                    syllabuses.syllabus_id, classes.standard, syllabuses.file
                    FROM syllabuses JOIN classes ON syllabuses.class_id = classes.class_id
                    WHERE syllabuses.syllabus_id = $syllabus_id
                    LIMIT 1
                ";
                $response = mysqli_query($conn, $syllabuses_query);
                $syllabus_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-3'>
                        <h3 class='text-center'>Update Syllabus</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-syllabus.php?syllabus_id=$syllabus_id' enctype='multipart/form-data'>                            
                            <div class='form-group'>
                                <label>Class:</label>
                                <input type='text' class='form-control' name='class_id' value='{$syllabus_details['standard']}' readonly>
                            </div>
                ";

                echo "
                            <div class='form-group'>
                                <label>Upload New File  (previous file need to be deleted manually):</label> <br>
                                <input type='file' name='fileToUpload' required>
                            </div>
                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_syllabus' class='btn btn-outline-primary w-50'>Update Syllabus</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if($query == "delete"){
                $syllabus_id = $_GET["syllabus_id"];
                $syllabus_query = "DELETE FROM syllabuses WHERE syllabus_id = $syllabus_id";
                mysqli_query($conn, $syllabus_query) or die(mysqli_errno($conn));
                header('Location: ./syllabuses.php?query=manage');
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
