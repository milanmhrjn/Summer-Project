<?php


//session start
session_start();




//create constant to store non repeating values
    define("LOCALHOST",'localhost');//constant (value change nahuney vako le variable ma store gareko)
    define('LOCAL_HOST','localhost');
    define('DB_USERNAME','root');
    define("DB_PASSWORD",'');
    define('DB_NAME','triple_two_production');
    define("SITE_URL","http://localhost/TripleTwoProduction/");

  $con = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  //database connection
  $db_select = mysqli_select_db($con,DB_NAME) or die(mysqli_connect_error()); //selecting database
?>