<?php
include("./config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ERP Model</title>
    <link rel="stylesheet" href="./assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style type="text/css">
   
   body{
       padding: 0px;
      /* background-color:#82AAE3; */
      /* padding-bottom:100px; */
      /* background-color:#00E7FF; */


   }
   .row {
    --mdb-gutter-x: 0;
    --mdb-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--mdb-gutter-y)*-1);
    margin-right: calc(var(--mdb-gutter-x)*-0.5);
    margin-left: calc(var(--mdb-gutter-x)*-0.5);
    box-sizing: border-box;
    padding: 0px 150px 0px 150px;
        
}

   .p-5 {
    border-radius: .5rem !important;
    box-sizing: border-box;  
   }
   .img-fluid, .img-thumbnail {
    max-width: 100%;
    height: auto;
    --mdb-gutter-x: 0;
}
   @media (min-width: 768px){
 .d-md-block {
    display: block!important;
    }
    .col-md-6 {
    flex: 0 0 auto;
    width: 50%;
}
   
   </style>
    </head>

<body>
     <div class="container-fluid p-5" style="border-radius: .5rem .5rem 0 0;">
    <div class="row g-0">
    <div class="col-md-6 col-lg-6 d-none d-md-block" style="padding-right: 0px;">
                <img src="./assets/vendor/login.jpg" alt="School Preview"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;width: 680px;height: 688px;padding-top:48px;" />
        </div>
        
        <div class='card account custom-shadow mt-5 pt-3 col-md-6 col-lg-6 ' style="width: 680px;height: 640px;border-radius: .5rem .5rem 0 0;background-color:grey;">
            
            <h3 class='text-center'>Login Form</h3>
           
            <hr>
            <form class='card-body' method='POST' action='account-api.php'>
                <div class='form-group'>
                    <label>Category:</label>
                    <select class='form-control' name='category' required>
                        <option value='student' selected>student</option>
                        <option value='teacher'>teacher</option>
                        <option value='accountant'>accountant</option>
                        <option value='admin'>admin</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label>Email:</label>
                    <input type='email' class='form-control' name='email' required>
                </div>
                <div class='form-group'>
                    <label>Password:</label>
                    <input type='password' class='form-control' name='password' required>
                </div>
                <br>
                <div class='text-center'>
                    <button type='submit' name='login' class='btn btn-primary w-50'>SIGN IN</button>
                </div>
            </form>
        </div>
    </div>
              
    </div>
</div> 
</body>

</html>

<!-- Test -->
