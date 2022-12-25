<nav class="navbar navbar-expand-md" style="background-color:rgba(0, 0, 0, 0.7);color:#fff;border-color: #080808">
    <p class="text-primary"><a class="navbar-brand" href="../index.php">ERP Model.</a></p>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <i class="fa fa-bars text-primary" aria-hidden="true"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <?php

        if ($_SESSION["user_category"] == "guest") {
            echo '
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#our-services"><b style="color:white">Our Services</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="#about-us"><b style="color:white">About Us</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="./login.php"><b style="color:white">Login</b></a>
                    </li>
                </ul>
            ';
        }

        if ($_SESSION["user_category"] == "admin") {
            echo '
                <ul class="navbar-nav text-center">
                    <li class="nav-item p-2">
                        <a class="nav-link" href="./admin/admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link text-primary" href="./logout.php">Logout</a>
                    </li>
                </ul>
            ';
        }

        if ($_SESSION["user_category"] == "student") {
            echo '
                <ul class="navbar-nav text-center">
                    <li class="nav-item p-2">
                        <a class="nav-link" href="./student/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link" href="./logout.php">Logout</a>
                    </li>
                </ul>
            ';
        }

        if ($_SESSION["user_category"] == "teacher") {
            echo '
                <ul class="navbar-nav text-center">
                    <li class="nav-item p-2">
                        <a class="nav-link" href="./teacher/grade.php">Grade</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link" href="../teacher/attendance.php">Attendance</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link" href="../profile.php">Profile</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            ';
        }

        if ($_SESSION["user_category"] == "accountant") {
            echo '
                <ul class="navbar-nav text-center">
                    <li class="nav-item p-2">
                        <a class="nav-link" href="./accountant/index.php">Dashboard</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link" href="./accountant/index.php">Fees, Payments & Receipts</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link text-primary" href="./logout.php">Logout</a>
                    </li>
                </ul>
            ';
        }
        ?>
    </div>
</nav>
