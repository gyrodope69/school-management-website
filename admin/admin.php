<?php include("../config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .row.content {
            height: 80vh;
        }

        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-inverse visible-xs">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">ERP Model</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <?php
                if (isset($_GET["transport"]) && $_GET["transport"] == true) {
                    echo "
                            <ul class='nav nav-pills nav-stacked'>
                                <li><a href='./admin.php'>Dashboard</a></li>
                                <li><a href='./transport/drivers.php?query=add'>Add Driver</a></li>
                                <li><a href='./transport/drivers.php?query=manage'>Manage Driver</a></li>
                                <li><a href='./transport/vehicles.php?query=add'>Add Vehicle</a></li>
                                <li><a href='./transport/vehicles.php?query=manage'>Manage Vehicle</a></li>
                                <li><a href='./transport/routes.php?query=add'>Add Route</a></li>
                                <li><a href='./transport/routes.php?query=manage'>Manage Route</a></li>
                                <li><a href='./transport/schedules.php?query=add'>Add Schedule</a></li>
                                <li><a href='./transport/schedules.php?query=manage'>Manage Schedule</a></li>
                                <li><a href='../logout.php'>Logout</a></li>
                            </ul>
                        ";
                } else {
                    echo "
                        <ul class='nav nav-pills nav-stacked'>
                            <li><a href='./admin.php?transport=true'>Transport Management</a></li>
                            <li><a href='./students.php?query=add'>Add Student</a></li>
                            <li><a href='./students.php?query=manage'>Manage Student</a></li>
                            <li><a href='./teachers.php?query=add'>Add Teacher</a></li>
                            <li><a href='./teachers.php?query=manage'>Manage Teacher</a></li>
                            <li><a href='./announcements.php?query=add'>Add Announcements</a></li>
                            <li><a href='./announcements.php?query=manage'>Manage Announcements</a></li>
                            <li><a href='./subjects.php?query=add'>Add Subject</a></li>
                            <li><a href='./subjects.php?query=manage'>Manage Subject</a></li>
                            <li><a href='./classes.php?query=add'>Add Class</a></li>
                            <li><a href='./classes.php?query=manage'>Manage Class</a></li>
                            <li><a href='./timetables.php?query=add'>Add Timetable</a></li>
                            <li><a href='./timetables.php?query=manage'>Manage Timetable</a></li>
                            <li><a href='./syllabuses.php?query=add'>Add Syllabus</a></li>
                            <li><a href='./syllabuses.php?query=manage'>Manage Syllabus</a></li>
                            <li><a href='../logout.php'>Logout</a></li>
                        </ul>
                        ";
                }
                ?>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav hidden-xs">
                <h4>ERP Model.</h4>
                <?php
                if (isset($_GET["transport"]) && $_GET["transport"] == true) {
                    echo "
                            <ul class='nav nav-pills nav-stacked'>
                                <li><a href='./admin.php'>Dashboard</a></li>
                                <li><a href='./transport/drivers.php?query=add'>Add Driver</a></li>
                                <li><a href='./transport/drivers.php?query=manage'>Manage Driver</a></li>
                                <li><a href='./transport/vehicles.php?query=add'>Add Vehicle</a></li>
                                <li><a href='./transport/vehicles.php?query=manage'>Manage Vehicle</a></li>
                                <li><a href='./transport/routes.php?query=add'>Add Route</a></li>
                                <li><a href='./transport/routes.php?query=manage'>Manage Route</a></li>
                                <li><a href='./transport/schedules.php?query=add'>Add Schedule</a></li>
                                <li><a href='./transport/schedules.php?query=manage'>Manage Schedule</a></li>
                                <li><a href='../logout.php'>Logout</a></li>
                            </ul>
                        ";
                } else {
                    echo "
                            <ul class='nav nav-pills nav-stacked'>
                                <li><a href='./admin.php?transport=true'>Transport Management</a></li>
                                <li><a href='./students.php?query=add'>Add Student</a></li>
                                <li><a href='./students.php?query=manage'>Manage Student</a></li>
                                <li><a href='./teachers.php?query=add'>Add Teacher</a></li>
                                <li><a href='./teachers.php?query=manage'>Manage Teacher</a></li>
                                <li><a href='./announcements.php?query=add'>Add Announcements</a></li>
                                <li><a href='./announcements.php?query=manage'>Manage Announcements</a></li>
                                <li><a href='./subjects.php?query=add'>Add Subject</a></li>
                                <li><a href='./subjects.php?query=manage'>Manage Subject</a></li>
                                <li><a href='./classes.php?query=add'>Add Class</a></li>
                                <li><a href='./classes.php?query=manage'>Manage Class</a></li>
                                <li><a href='./timetables.php?query=add'>Add Timetable</a></li>
                                <li><a href='./timetables.php?query=manage'>Manage Timetable</a></li>
                                <li><a href='./syllabuses.php?query=add'>Add Syllabus</a></li>
                                <li><a href='./syllabuses.php?query=manage'>Manage Syllabus</a></li>
                                <li><a href='../logout.php'>Logout</a></li>
                            </ul>
                        ";
                }
                ?>
            </div>
            <br>

            <div class="col-sm-10">
                <div class="well">
                    <h4>Dashboard</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, laudantium. Hic suscipit modi, molestiae a veniam tenetur officiis nostrum. Doloribus praesentium dolorum culpa corporis qui quas magnam corrupti enim fugiat.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well">
                            <h4>Ongoing Academic Year</h4>
                            <p>01-06-22 to 01-06-23</p>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, eaque!</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="well">
                            <h4>Ongoing Financial Year</h4>
                            <p>01-06-22 to 01-06-23</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, sequi!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Registered Students</h4>
                            <?php
                            $count_students = "SELECT COUNT(*) AS NUM_STUDENTS FROM students";
                            $response = mysqli_query($conn, $count_students) or die(mysqli_error($conn));
                            $num_students = mysqli_fetch_array($response)["NUM_STUDENTS"];
                            echo "<p>$num_students</p>"
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Registered Teachers</h4>
                            <?php
                            $count_teachers = "SELECT COUNT(*) AS NUM_TEACHERS FROM teachers";
                            $response = mysqli_query($conn, $count_teachers) or die(mysqli_error($conn));
                            $num_teachers = mysqli_fetch_array($response)["NUM_TEACHERS"];
                            echo "<p>$num_teachers</p>"
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Active Announcements</h4>
                            <?php
                            $count_announcements = "SELECT COUNT(*) AS NUM_ANNOUNCEMENTS FROM announcements WHERE active = 1";
                            $response = mysqli_query($conn, $count_announcements) or die(mysqli_error($conn));
                            $num_active_announcements = mysqli_fetch_array($response)["NUM_ANNOUNCEMENTS"];
                            echo "<p>$num_active_announcements</p>"
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Active Subjects</h4>
                            <?php
                            $count_subjects = "SELECT COUNT(*) AS NUM_SUBJECTS FROM subjects WHERE active = 1";
                            $response = mysqli_query($conn, $count_subjects) or die(mysqli_error($conn));
                            $num_subjects = mysqli_fetch_array($response)["NUM_SUBJECTS"];
                            echo "<p>$num_subjects</p>"
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Active Classes</h4>
                            <?php
                            $count_classes = "SELECT COUNT(*) AS NUM_CLASSES FROM classes WHERE active = 1";
                            $response = mysqli_query($conn, $count_classes) or die(mysqli_error($conn));
                            $num_classes = mysqli_fetch_array($response)["NUM_CLASSES"];
                            echo "<p>$num_classes</p>"
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Active Drivers</h4>
                            <?php
                            $count_drivers = "SELECT COUNT(*) AS NUM_DRIVERS FROM miscellaneous WHERE category = 'driver' AND active = 1";
                            $response = mysqli_query($conn, $count_drivers) or die(mysqli_error($conn));
                            $num_drivers = mysqli_fetch_array($response)["NUM_DRIVERS"];
                            echo "<p>$num_drivers</p>"
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Active Vehicles</h4>
                            <?php
                            $count_vehicles = "SELECT COUNT(*) AS NUM_VEHICLES FROM vehicles WHERE active = 1";
                            $response = mysqli_query($conn, $count_vehicles) or die(mysqli_error($conn));
                            $num_vehicles = mysqli_fetch_array($response)["NUM_VEHICLES"];
                            echo "<p>$num_vehicles</p>"
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Active Transport Services</h4>
                            <?php
                            $count_schedules = "SELECT COUNT(*) AS NUM_SCHEDULES FROM vehicles_schedule WHERE active = 1";
                            $response = mysqli_query($conn, $count_schedules) or die(mysqli_error($conn));
                            $num_schedules = mysqli_fetch_array($response)["NUM_SCHEDULES"];
                            echo "<p>$num_schedules</p>"
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>