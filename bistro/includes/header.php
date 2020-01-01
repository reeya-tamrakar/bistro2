<?php 
session_start();
/* php price list array */
$name_list = array('Momo','chowmein','Thakali Khana','Dal Dhokli','Pizza','chuankchou','Idli','Naan','Burger','Malai kofta','Carbonara','Spagetti','Samosa chat');
$price_list = array(150,160,320,105,450,570,170,45,180,120,430,320,110);

/* php to extract page name*/
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[2];
$first_part = basename($_SERVER['PHP_SELF'], ".php");
$top_msg = "";

include('includes/db.php');

if(isset($_SESSION['name'])){
  $top_msg= "<p class='float-right mt-1 pr-3'>Logged in as <a href='/bistro/profile?view=" . $_SESSION['name'] . "' class='text-danger'>" . $_SESSION['name'] . "</a>.</p>";
}
// php to validate sign up data.
$s_name=$s_email=$s_phone=$s_location="";
$s_name_err=$s_email_err=$s_phone_err=$s_location_err=$s_password_err=$match_err="";

if (isset($_POST['s_submit'])) {
  if (empty($_POST["s_name"])) {
    $s_name_err = "Name is required";
  } else {
    $s_name = test_input($_POST["s_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9]*$/",$s_name)) {
      $s_name_err = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["s_email"])) {
    $s_email_err = "Email is required";
  } else {
    $s_email = test_input($_POST["s_email"]);
    // check if e-mail address is well-formed
    if (!filter_var($s_email, FILTER_VALIDATE_EMAIL)) {
      $s_email_err = "Invalid email format";
    }
  }
    
  if (empty($_POST["s_location"])) {
    $s_location_err = "Location is required";
  } else {
    $s_location = test_input($_POST["s_location"]);
  }

  if (empty($_POST["s_phone"])) {
    $s_phone_err = "Phone is required";
  } else {
    $s_phone = test_input($_POST["s_phone"]);
    $filtered_phone_number = filter_var($s_phone, FILTER_SANITIZE_NUMBER_INT);
     // Remove "-" from number
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     // Check the length of number
     // This can be customized if you want phone number from a specific country
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        $s_phone_err = "Invalid phone number";
     }

  }
  $s_password = $_POST["s_password"];
  $s_password = md5($s_password);
  $match = "SELECT name FROM customers";
  $matchres = mysqli_query($con,$match);
  $flag=1;
  if($matchres->num_rows > 0){
    while($row = $matchres->fetch_assoc()){
      if($row['name'] == $s_name){
        $flag=0;
      }
    }
  }
  if($flag==0){
    $match_err = "Username already exists.";
  }
  else{
    // Insert into database of customers
    $s_insert = "INSERT INTO customers(name,email,phone,location,password) VALUES('$s_name','$s_email','$s_phone','$s_location','$s_password')";
    if(mysqli_query($con,$s_insert)){
      echo "<script>alert('Successfully Signed up.')</script>";
      $_SESSION['name']=$s_name;
      $_SESSION['email']=$s_email;
      $_SESSION['location']=$s_location;
      $_SESSION['phone']=$s_phone; 
      $top_msg= "<p class='float-right pr-3'>Logged in as <a href='/bistro/profile?view=" . $_SESSION['name'] . "' class='text-danger'>" . $_SESSION['name'] . "</a>.</p>";
    }
    else{
      echo "error";
    }
  }
}

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

// Logout php
if(isset($_POST["logout"])){
      session_unset();
      session_destroy();
      echo "<script>alert('Logged out.')</script>";
}

$l_name = $match_err = "";

// Login php
if(isset($_POST['login'])){
  $l_name = test_input($_POST['l_name']);
  $l_password = md5(test_input($_POST['l_password']));

  $match = "SELECT * FROM customers";
  $matchres = mysqli_query($con,$match);
  $flag=1;
  if($matchres->num_rows > 0){
    while($row = $matchres->fetch_assoc()){
      if($row['name'] == $l_name && $row['password'] == $l_password){
        
      echo "<script>alert('Successfully Logged In.')</script>";
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['location']=$row['location'];
        $_SESSION['phone']=$row['phone'];
      $top_msg= "<p class='float-right pr-3'>Logged in as <a href='/bistro/profile?view=" . $_SESSION['name'] . "' class='text-danger'>" . $_SESSION['name'] . "</a>.</p>";
        $flag = 0;  
      }
    }
    if($flag=1){
      $match_err="Username or Password Wrong.";
    }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php if($first_part!="index"){echo ucfirst($first_part) . ' | ';} ?>Bistro <?php if($first_part=="index"){echo " - good food instantly!";} ?></title><!-- Write the first part into title. -->

<!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Links -->
	<link rel="stylesheet" type="text/css" href="/bistro/css/main.css"><!-- Main CSS -->
	<link rel="stylesheet" type="text/css" href="/bistro/css/bootstrap.min.css"><!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/png" href="/bistro/images/logo/favicon.png"/><!-- Link for favicon -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin_theme.css"><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">



<!-- Scripts -->  
  <script src="/bistro2/bistro/js/jquery.js"></script><!-- jQuery JS -->
	<script src="/bistro2/bistro/js/bootstrap.min.js"></script><!-- Bootstrap JS -->

</head>
<body>
<header><!-- Head part of the website -->
<nav class="navbar navbar-expand-md navbar-light"><!-- Navigation Bar -->
  <a href="/bistro2/bistro/"><img src="/bistro2/bistro/images/logo/logo.png" width="150"></a><!-- Logo -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav">
    <span class="navbar-toggler-icon"></span>
  </button><!-- Hamburger icon (visible in <768px devices) -->
  <div class="collapse navbar-collapse" id="nav"><!-- Navbar, the collapsible part -->
    <ul class="navbar-nav ml-auto"><!-- Navbar start -->
      <li class="nav-item <?php if ($first_part=="index") {echo "active"; } else  {echo "";} ?> mr-4"><!-- php for making the class active -->
        <a class="nav-link" href="/bistro2/bistro/">Home</a>
      </li>
      <li class="dropdown menu-large nav-item"> <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Menu </a>
                    <ul class="dropdown-menu megamenu"><!-- Mega Menu -->
                    	<h1 class="text-center">Mega Menu</h1>
                        <div class="row">
                          <?php 
                          $cat_select = "SELECT DISTINCT catname from menucuis";
                          $cat = mysqli_query($con,$cat_select);
                        while($catrow = mysqli_fetch_assoc($cat)){
                          echo '<li class="col-md-3 dropdown-item"><!-- A column of Mega Menu -->
                                <ul><!-- List of items of the megamenu -->
                                    <li class="dropdown-header">' . $catrow['catname'] . '</li>';
                          $cui_select = "SELECT * FROM menucuis WHERE catname='" . $catrow['catname'] ."'";
                          $cui = mysqli_query($con,$cui_select);
                          while($cuirow = mysqli_fetch_assoc($cui)){
                            echo '<li><a href="#">' . $cuirow['cuiname'];
                            if(in_array($cuirow['cuiname'], $name_list)){
                              $index = array_search($cuirow['cuiname'], $name_list);
                              echo '<button type="submit" class="btn btn-primary btn-sm ml-2 float-right" onclick="alert('. "Ordered Successfully." . ')">Order!</button> <strong class="float-right">Rs. ' . $price_list[$index] . '</strong> </a>';
                            }
                            echo '</li>'; 
                          }
                          echo '</ul></li>';
                        }
                           ?>
                        </div>
                    </ul>
                </li>
      <li class="nav-item <?php if ($first_part=="services") {echo "active"; } else  {echo "";} ?> mr-4">
        <a class="nav-link" href="services">Services</a>
      </li>
      <li class="nav-item <?php if ($first_part=="about") {echo "active"; } else  {echo "";} ?> mr-4">
        <a class="nav-link" href="about">About</a>
      </li>
      <li class="nav-item mr-4 hidden-md">
      	<div class="input-group mb-2">
		  <input type="text" class="form-control" placeholder="What's on tastebud?">
		  <div class="input-group-append"><button type="button" class="btn btn-success"><i class="fa fa-search"></i></button></span></div>
		</div>
      </li>
       </a>
    </ul>
  </div>
</nav>
<?php if(!isset($_SESSION['name'])){
  echo '<!-- Button trigger modal -->
<button type="button" class="btn btn-primary float-right mr-2" data-toggle="modal" data-target="#exampleModal1">
  Sign Up
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">
        <p>All are required.</p>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Username</span>
          </div>
          <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="s_name" value="'.  $s_name . '"><span class="text-danger">' .   $s_name_err . '</span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Email</span>
          </div>
          <input type="email" class="form-control" aria-label="Email" aria-describedby="basic-addon1" name="s_email" value="' .   $s_email. '"><span class="text-danger">' .   $s_email_err . '</span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Phone</span>
          </div>
          <input type="number" class="form-control" aria-label="Phone" aria-describedby="basic-addon1" name="s_phone" value="' .   $s_phone. '"><span class="text-danger">' .   $s_phone_err . '</span>
        </div><div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Location</span>
          </div>
          <input type="text" class="form-control" aria-label="Location" aria-describedby="basic-addon1" name="s_location" value="' .   $s_location . '"><span class="text-danger">' .   $s_location_err . '</span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password</span>
          </div>
          <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon1" name="s_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><span class="text-danger">' .   $s_password_err . '</span>
        </div>
        <span class="text-danger">' .   $match_err . '</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="s_submit">Sign Up</button>
      </div></form>
    </div>
  </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#exampleModal">
  Login
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Username</span>
          </div>
          <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="l_name" value="' . $l_name . '">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password</span>
          </div>
          <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon1" name="l_password">
        </div>
        <span class="text-danger">' . $match_err .'</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
      </div></form>
    </div>
  </div>
</div>';
}
else {echo '<form method="post"><button type="submit" class="btn btn-danger mb-1 mr-3 float-right" name="logout">Logout</button></form>' . $top_msg ; } ?>
<br><br>
</header>