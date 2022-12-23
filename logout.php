<!-- destroy session, session variables and close connection with the database -->
<?php
include('./config.php');
session_unset();
session_destroy();
mysqli_close($conn);
header("location: ./index.php");
