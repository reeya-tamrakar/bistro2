<?php
session_start();
include('../includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - Bistro Admin Panel</title>

<!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- Links -->
	<link rel="stylesheet" type="text/css" href="/bistro/css/bootstrap.min.css"><!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/png" href="/bistro/images/logo/favicon.png"/><!-- Link for favicon -->
	<link rel="stylesheet" type="text/css" href="style.css"><!-- Main CSS -->

<!-- Style -->
	<style type="text/css">
		body{/* reset everything */
			margin: 0;
			padding: 0;
		}
		.container-fluid{/* the main background */
			background: url('/bistro/images/admin_bg.jpg');
			width: 100%;
			height: 100vh;
			background-size: cover;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.logbx{/*login box*/
			background: white;
			padding: 40px;
			z-index: 0;
			border-radius: 10px;
		}
		form{
			z-index: 1;
		}
		.logbx input{/*input boxes*/
			display: block;
			margin: 5px;
			height: 40px;
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<div class="logbx">
		<form method="post">
			<h2>Admin Login</h2>
			<input type="text" name="user" placeholder="Username" required="required">
			<input type="password" name="pass" placeholder="Password" required="required">
			<input type="submit" name="log" value="Login" class="btn btn-primary">
		</form>
		<a href="/bistro/">Back to the website</a>	
	</div>
</div>
</body>
</html>
<?php 

    if(isset($_POST['log'])){
        
        $username = mysqli_real_escape_string($con,$_POST['user']);
        
        $password = md5(mysqli_real_escape_string($con,$_POST['pass']));
        
        $get_admin = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        
        $run_admin = mysqli_query($con,$get_admin);

        $count = mysqli_num_rows($run_admin);

        $run_admin = mysqli_fetch_assoc($run_admin);
        
        if($count==1){
            
            $_SESSION['user']=$username;
            $_SESSION['email']=$run_admin['email'];
            $_SESSION['id']=$run_admin['id'];
            $_SESSION['phone']=$run_admin['phone'];
            $_SESSION['location']=$run_admin['location']	;
            $_SESSION['description']=$run_admin['description'];
            
            echo "<script>alert(' Welcome Back $username')</script>";
            
            echo "<script>window.open('index.php?action=dashboard','_self')</script>";
            
        }else{
            
            echo "<script>alert('Email or Password is Wrong !')</script>";
            
        }
        
    }

?>