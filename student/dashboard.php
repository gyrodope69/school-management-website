<?php include("../config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Student</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .row.content {
            height: 80vh;
        }

        .sidenav {
            background-color: lightgray;
            height: 100%;
        }

        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
        .alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
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
                <ul class='nav nav-pills nav-stacked'>
                    <li><a href='./dashboard.php'>Dashboard</a></li>
                    <li><a href='../timetable.php'>Timetable</a></li>
                    <li><a href='../syllabus.php'>Syllabus</a></li>
                    <li><a href='#!'>Dues</a></li>
                    <li><a href='../profile.php'>Manage Profile</a></li>
                    <li><a href='../logout.php'>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav hidden-xs">
                <h4>ERP Model.</h4>
                <ul class='nav nav-pills nav-stacked'>
                    <li><a href='./dashboard.php'>Dashboard</a></li>
                    <li><a href='../timetable.php'>Timetable</a></li>
                    <li><a href='../syllabus.php'>Syllabus</a></li>
                    <li><a href='#!'>Dues</a></li>
                    <li><a href='../profile.php'>Manage Profile</a></li>
                    <li><a href='../logout.php'>Logout</a></li>
                </ul>
            </div>
            <br>
            <div class="col-sm-10">
           <?php $i=0;
            $email = $_SESSION["user_email"];
           $fees = $conn->query("SELECT ef.*,s.name as sname,s.student_id FROM student_ef_list ef inner join students s on s.student_id = ef.student_id where email='{$email}'");
           ?>
            <div class="alert" id="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong>Alert!</strong> Dues pending for
            <?php 
           while($row=$fees->fetch_assoc()){  
               $paid = $conn->query("SELECT sum(amount) as paid FROM payments where ef_id=".$row['id']);
               $paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid']:'';
               $balance = $row['total_fee'] - $paid;
               if($balance>0){
                $i=$i+1;
           ?>
            <?php echo $row['month']; ?>,            
            <?php } } ?>
            </div>
            <?php if(empty($i)){ ?>
                <script>
                   alert = document.getElementById("alert");
                   alert.classList.add("hide");
                </script>
            <?php } ?>
                <div class="well"  style="background-color:lightgray;>
                    <h4>Dashboard</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, laudantium. Hic suscipit modi, molestiae a veniam tenetur officiis nostrum. Doloribus praesentium dolorum culpa corporis qui quas magnam corrupti enim fugiat.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well"  style="background-color:#e6e2d3;">
                            <h4>Ongoing Academic Year</h4>
                            <p>01-06-22 to 01-06-23</p>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore, eaque!</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="well"  style="background-color:#e6e2d3;">
                            <h4>Ongoing Financial Year</h4>
                            <p>01-06-22 to 01-06-23</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, sequi!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $email = $_SESSION["user_email"];
                    $student_query = "SELECT 
                        students.student_id, students.class_id, classes.subject_ids
                        FROM students JOIN classes WHERE students.email = '$email' AND students.class_id = classes.class_id
                    ";
                    $response = mysqli_query($conn, $student_query) or die(mysqli_error($conn));
                    $student_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                    $class_id = $student_details["class_id"];
                    $student_id = $student_details["student_id"];
                    $subject_ids = json_decode($student_details["subject_ids"]);

                    for ($i = 0; $i < sizeof($subject_ids); $i++) {
                        $subject_id = $subject_ids[$i];

                        $subject_query = "SELECT subjects.title, subjects.descr, subjects.code, subjects.credit, teachers.name 
                            FROM subjects JOIN teachers ON subjects.teacher_id = teachers.teacher_id 
                            WHERE subjects.subject_id = $subject_id AND subjects.teacher_id = teachers.teacher_id
                        ";
                        $response = mysqli_query($conn, $subject_query) or die(mysqli_error($conn));
                        $subject_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                        $subject_title = ucwords($subject_details["title"]);
                        $subject_descr = $subject_details["descr"];
                        $subject_code = strtoupper($subject_details["code"]);
                        $subject_credit = $subject_details["credit"];
                        $teacher_name = ucwords($subject_details["name"]);

                        $attendance_query = "SELECT present, absent, total 
                            FROM attendance 
                            WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'
                        ";
                        $response = mysqli_query($conn, $attendance_query) or die(mysqli_error($conn));

                        if (mysqli_num_rows($response) == 0) {
                            $attendance_percentage = "No class conducted yet";
                        } else {
                            $attendance_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
                            $attendance_percentage = $attendance_details["total"] != 0 ? ($attendance_details["present"] / $attendance_details["total"]) * 100 . " % ": 0;
                        }

                        $grade_query = "SELECT mid_term_1, mid_term_2, end_term, other 
                            FROM grades 
                            WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'
                        ";
                        $response = mysqli_query($conn, $grade_query) or die(mysqli_errno($conn));
                        if (mysqli_num_rows($response) == 0) {
                            $mid_term_1 = $mid_term_2 = $end_term = $other = "Marks not released yet";
                        } else {
                            $grade_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
                            $mid_term_1 = $grade_details["mid_term_1"];
                            $mid_term_2 = $grade_details["mid_term_2"];
                            $end_term = $grade_details["end_term"];
                            $other = $grade_details["other"];
                        }

                        echo "
                            <div class='col-sm-6'>
                                <div class='well'>
                                    <h4>$subject_title</h4>
                                    <p>$subject_descr</p>
                                    <p>Code : $subject_code</p>
                                    <p>Credit : $subject_credit</p>
                                    <p>Lecturer : $teacher_name</p>
                                    <p>Attendance : $attendance_percentage</p>
                                    <p>Mid Term 1 (25) : $mid_term_1</p>
                                    <p>Mid Term 2 (25) : $mid_term_2</p>
                                    <p>End Term (25) : $end_term</p>
                                    <p>Assignments & Vivas (25) : $end_term</p>
                                </div>
                            </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
