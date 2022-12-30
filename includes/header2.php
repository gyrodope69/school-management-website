<nav class="navbar navbar-expand-md" style="background-color:black;color:#fff;border-color: #080808;padding-bottom:0 0 4.5rem ; font-family: 'Montserrat', sans-serif; ">
<p class="text-primary" style="padding-top: 10px;"><a class="navbar-brand"  style="color:#D6E4E5; font-family: 'Montserrat', sans-serif;" href="http://localhost/school-management-website/index.php">ERP Model.</a></p>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <i class="fa fa-bars text-primary" aria-hidden="true"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <?php


        if ($_SESSION["user_category"] == "teacher") {
            echo '
                <ul class="navbar-nav text-center">
                    <li class="nav-item p-2">
                        <a class="nav-link text-light" href="../teacher/grade.php">Grade</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link text-light" href="../teacher/attendance.php">Attendance</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link text-light" href="../profile.php">Profile</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link text-light" href="../logout.php">Logout</a>
                    </li>
                </ul>
            ';
        }

        ?>
    </div>
</nav>