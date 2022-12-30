<?php include("./config.php") ?>
<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home | ERP Model</title>
        <link rel="stylesheet" href="./assets/css/base-styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
   

            .mt-5 {
               margin-top:0;
            }
    </style>
    </head>

<body>
    <div class="container-fluid text-center" style="padding:0;">

        <?php include("./includes/header.php") ?>

        <div class="row" style="padding: 5%";>
          

            <div class="wrapper col-12 col-sm-12 col-lg-8">
                <div id="carousel-update" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="hover">
                    
                     <div class="carousel-inner" >
                        
                        
                        
                        <div class="carousel-item active ">
                        <img src="./assets/vendor/slideshow-img-1.jpg" alt="School Preview">
                        </div>

                        <div class="carousel-item ">
                        <img src="./assets/vendor/slideshow-img-1.jpg" alt="School Preview">
                        </div>

                        

                     </div>

                  
                    
                </div>
            </div>

           

            <div class="announcements col-12 col-sm" >
                <div class="text-center"style="background-color:black;color:#fff;">
                    <h4>ANNOUNCEMENTS</h4>
                </div>     

                <ul id="notice" class="text-center p-3">
                <marquee direction="up" scrollamount="3" behavior="scroll-alternate" loop="">

                    <?php
                    $announcements_query = "SELECT * FROM announcements WHERE active = 1 ORDER BY announcement_id ASC";
                    $response = mysqli_query($conn, $announcements_query);
                    $announcements_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                    for ($i = 0; $i < sizeof($announcements_details); $i++) {
                        $title = ucwords($announcements_details[$i]["title"]);
                        $descr = $announcements_details[$i]["descr"];
                        $resource = $announcements_details[$i]["resource"];
                        echo "
                            <li class='news-item'>
                                <p class='font-weight-bold'>$title</p>
                                <p>$descr</p>
                                <a href='$resource'>$resource</a>
                            </li>
                            <hr>
                        ";
                    }
                    ?>
                    </marquee>
                </ul>   
            </div>


        </div>
        <br>

        <div class="jumbotron jumbotron-fluid mt-5" style="padding: 50px 50px 50px 50px; margin: 4.5rem">
            <h2 align="left">Today's Transport Schedules</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque ex nisi accusamus debitis nam quisquam facere tempora asperiores tempore optio?</p>
            <?php
            $today = strtolower(date('l'));


                $schedules_query = "SELECT * FROM vehicles_schedule WHERE day = '$today' ORDER BY departure";
                $response = mysqli_query($conn, $schedules_query);
                $schedules_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                echo "
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th>Vehicle No.</th>
                                <th>Depar ture Time</th>
                                <th>Arrival Time</th>
                                <th>Route</th>
                                <th>Driver</th>
                            </tr>
                        </thead>
                        <tbody>
                ";

                foreach ($schedules_details as $attribute => $schedule_details) {
                    $driver_query = "SELECT * FROM miscellaneous WHERE miscellaneous_id = '{$schedule_details['driver_id']}' ";
                    $response = mysqli_query($conn, $driver_query) or die(mysqli_error($conn));
                    $driver_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                    $route_query = "SELECT * FROM routes WHERE route_id = '{$schedule_details['route_id']}' ";
                    $response = mysqli_query($conn, $route_query);
                    $route_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                    $vehicle_query = "SELECT * FROM vehicles WHERE vehicle_id = '{$schedule_details['vehicle_id']}' ";
                    $response = mysqli_query($conn, $vehicle_query);
                    $vehicle_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

                    echo "
                        <tr>
                            <td>{$vehicle_details['vehicle_number']}</td>
                            <td>{$schedule_details['departure']}</td>
                            <td>{$schedule_details['arrival']}</td>
                            <td>{$route_details['start']} to {$route_details['finish']}</td>
                            <td>{$driver_details['name']}</td>
                        </tr>
                    ";
                }

                echo "
                            </tbody>
                        </table>
                    ";
                ?>
            </div>
        </div>

        <div class="service-container" id="our-services" style="padding: 10px 0px 0px 0px; margin: 4.5rem">
            <h2 align="left" style="padding: 0px 0px 0px 50px;">Our Services</h2>
            <div class="card-group">
                <div class="card shov">
                    <img class="card-img-top img-responsive service-img" src="./assets/vendor/slideshow-img-1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Service title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card shov">
                    <img class="card-img-top img-responsive service-img" src="./assets/vendor/slideshow-img-1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Service title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card shov">
                    <img class="card-img-top img-responsive service-img" src="./assets/vendor/slideshow-img-1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Service title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="jumbotron jumbotron-fluid mt-5" style="padding: 50px 50px 50px 50px; margin: 4.5rem">
            <div class="row p-3" id="about-us">
                <h2 align="left">About US</h2>
                <div class="col-sx-1"></div>
                <div class="col-xs-10 content pl-4">
                    <p style="text-align: justify;"><i>“A computer would deserve to be called intelligent if it could deceive a human into believing that it was human.” ~ Alan Turing</i></p>
                    <p style="text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non ab mollitia voluptas deleniti dolorum ipsum distinctio quis deserunt, tempore voluptatum. Labore enim molestias impedit, deleniti quaerat maiores deserunt cum iure.</p>
                    <p style="text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non ab mollitia voluptas deleniti dolorum ipsum distinctio quis deserunt, tempore voluptatum. Labore enim molestias impedit, deleniti quaerat maiores deserunt cum iure.</p>
                    <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus iste sequi ea in, nam impedit quis reiciendis sed perspiciatis animi fuga voluptate minima cupiditate nisi voluptatem ut culpa accusantium! Sequi in quae fugiat tempore. Deserunt, ut adipisci ipsum quidem ipsam sed ab voluptates, animi dignissimos tempora saepe veniam mollitia corporis?</p>
                    <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, maiores rem magnam sint quibusdam fugit labore quod error, ipsa beatae atque minus consequatur. Ipsam pariatur recusandae vero suscipit totam, sapiente impedit ut ex necessitatibus harum labore debitis non dolores nobis nulla tempora exercitationem minus, illo distinctio? Vitae suscipit expedita quas?</p>
                    <p><b>Mr. Swaraj Kumar Chaudhary<br>Head of Organization<br>swarajkumarchaudhary1729@gmail.com</b></p>

                    </b>
                </div>
            </div>
        </div>

        <?php include("./includes/footer.php") ?>
    </div>
    </div>

    </div>
</body>

</html>
