<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements | Admin</title>
    <link rel="stylesheet" href="../assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <style type="text/css">

.btn {
border-color: black;
color: black;
background-color:white;
}
.btn-outline-dark {
color: #C85C8E;
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
                    <div class='card account custom-shadow mt-5 p-3' style='background-color:black;color:white;border-radius: 1rem 0 0 1rem';>
                        <h3  class='text-center' style='background-color:gray;color:white;'>Add Announcements📢</h3>
                        <hr>
                        <form class='card-body'style='background-color:gray;color:white;' method='POST' action='manage-announcement.php'>
                            <div class='form-group'>
                                <label>Title:</label>
                                <input type='text' class='form-control' name='title' required>
                            </div>

                            <div class='form-group'>
                                <label>Description:</label>
                                <textarea type='text' class='form-control' name='descr' cols='6' rows='2' required></textarea>
                            </div>

                            <div class='form-group'>
                                <label>More Resource (Link):</label>
                                <input type='url' class='form-control' name='resource'>
                            </div>

                            <br>
                            <div class='text-center'>
                                <button type='submit' name='add_announcement' class='btn btn-outline-primary w-50'>ADD</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if ($query == "manage") {
                $announcements_query = "SELECT * FROM announcements ORDER BY announcement_id ASC";
                $response = mysqli_query($conn, $announcements_query);
                $announcements_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
                <div class = 'border border-5 border-info' style='padding:30px 30px 30px 30px;'>
                    <h2>Announcement List</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero adipisci mollitia illum atque sequi distinctio optio minus natus nulla vel?</p>    
                    <input class='form-control w-25 mt-4 mb-4' id='searchInput' type='text' placeholder='Filter by any attribute'> 

                    <table class='table table-striped table-bordered table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Resource</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dataTable'>
                 </div>
                ";

                foreach ($announcements_details as $attribute => $announcement_details) {
                    echo "
                        <tr>
                            <td>{$announcement_details['title']}</td>
                            <td>{$announcement_details['descr']}</td>
                            <td>{$announcement_details['resource']}</td>
                    ";

                    if($announcement_details['active'] == '1'){
                        echo "<td>Active</td>";
                    }else{
                        echo "<td>Inactive</td>";
                    }

                    echo "
                            <td>
                                <a href='./announcements.php?query=delete&announcement_id={$announcement_details['announcement_id']}' class='text-danger pr-2'>Delete</a>
                                <a href='./announcements.php?query=update&announcement_id={$announcement_details['announcement_id']}' class='text-primary'>Update</a>
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
                $announcement_id = $_GET["announcement_id"];
                $announcement_query = "SELECT * FROM announcements WHERE announcement_id = '$announcement_id'";
                $response = mysqli_query($conn, $announcement_query);
                $announcement_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                echo "
                    <div class='card account custom-shadow mt-5 p-3'>
                        <h3 class='text-center'>Update Announcement</h3>
                        <hr>
                        <form class='card-body' method='POST' action='manage-announcement.php?announcement_id=$announcement_id'>
                            <div class='form-group'>
                                <label>Title:</label>
                                <input type='text' class='form-control' name='title' value='{$announcement_details['title']}' required>
                            </div>

                            <div class='form-group'>
                                <label>Description:</label>
                                <textarea type='text' class='form-control' name='descr' cols='6' rows='5' required>{$announcement_details['descr']}</textarea>
                            </div>
                ";

                if($announcement_details['active'] == '1'){
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
                            <div class='form-group'>
                                <label>More Resource (Link):</label>
                                <input type='url' class='form-control' name='resource' value='{$announcement_details['resource']}'>
                            </div>

                            <br>
                            <div class='text-center'>
                                <button type='submit' name='update_announcement' class='btn btn-outline-dark w-50'>Update Announcement</button>
                            </div>
                        </form>
                    </div>
                ";
            }

            if($query == "delete"){
                $announcement_id = $_GET["announcement_id"];
                $announcement_query = "DELETE FROM announcements WHERE announcement_id = $announcement_id";
                mysqli_query($conn, $announcement_query) or die(mysqli_errno($conn));
                header('Location: ./announcements.php?query=manage');
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
