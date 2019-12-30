<?php 

/* connection details  */
$servername = "localhost";
$username = "root";
$password = "";
$db = "bistro";

// Create connection
$con = mysqli_connect($servername,$username,$password,$db) or die("Connection failed.");
?>