<?php 
	session_start();
	include("$_SERVER[DOCUMENT_ROOT]/bistro2/bistro/includes/db.php");
	include("includes/headsidebar.php");
	if(!isset($_SESSION['user'])){
        
        echo "<script>window.open('login','_self')</script>";
        
    }
    else{
    }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="/bistro/css/bootstrap.min.css"><!-- Bootstrap CSS --> 
	<link rel="stylesheet" type="text/css" href="admin_theme.css">
</head>
 <body>
 <?php 
 if(isset($_GET['action']) && !empty($_GET['action'])){
 $p=$_GET['action'] . '.php';	
 if(file_exists($p))
 	include($p);
 else if($p == "log-out.php"){
 	  session_unset();
	  session_destroy();
	  echo "<script>alert('Logged out.')</script><script>window.open('login.php','_self')</script>";
 }
 else
 	include('404_not_found.php');
 }
 ?>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>	
 </body>
 </html>