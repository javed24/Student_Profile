<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>USIS</title>
<link href="css/style.css" rel="stylesheet" type="text/css">



<?php 


include('includes/connection.php');
session_start();
 ?>


</head>

    <body>
         <div class="top">
             <div class="logo"><img src="images/logo.jpg"  alt=""/> 
             </div>

             
             <span class="bracu">BRAC UNIVERSITY </span>
             
             <?php 
			 
			 if(isset($_SESSION['type'])){
         echo('<span class="who">Logged in As: &nbsp;'.$_SESSION['id'].'</span> <form action="includes/log_out.php" method="post"><input type="submit" name="logOut" value="Log Out"></form>');
			 }
			 ?>
             </div>