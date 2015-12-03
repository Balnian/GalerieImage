<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <link href="css/Image.css" rel="stylesheet">
  </head>
  <body>
    <?php
        //echo (session_status() === PHP_SESSION_NONE)? 'true':'false' ;
/*echo (session_status() === PHP_SESSION_ACTIVE)? 'true':'false' ;
echo (session_status() === PHP_SESSION_DISABLED)? 'true':'false' ;
echo (isset($_SESSION))? 'true':'false' ;
echo (session_id() == '')? 'true':'false' ;
echo (isset($_SESSION['IDUsager']))? 'true':'false' ;*/
//echo $_SESSION['IDUsager'];
//echo (!isset($_SESSION['count']));
/*if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
} else {
    $_SESSION['count']++;
}*/
//echo isset($_SESSION['IDUsager']);


        if (isset($_SESSION['IDUsager']))//session_status() == PHP_SESSION_NONE)
        {
            include "Menu.php";
        }
        elseif(basename($_SERVER['REQUEST_URI'], '.php') !== "Login")
        {
            HEADER("Location: Login.php");
        }




