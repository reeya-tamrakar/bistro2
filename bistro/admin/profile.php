<?php 


$matcherr="";
$u_phone_err="";
$u_id="";
$u_user="";
$u_email="";
$u_location="";
$u_phone="";
$u_description="";
$u_pass="";
$flag=0;
$passerr="";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if(isset($_POST['u_submit'])){
    $u_user = $_POST['u_user'];
    if($u_user!=$_SESSION['user']){$match = "SELECT username FROM admins WHERE username = '$u_user'";
    $match_res = mysqli_query($con,$match) or die('Unsucessful database connection.');     
    $count = mysqli_num_rows($match_res);
    if($count > 0){
      $flag=1;
      $matcherr="Username already exists";
    }}
    $u_user = test_input($_POST["u_user"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9_]*$/",$u_user)) {
      $flag=1;
      $matcherr = "Only letters and white space allowed";
    }

    $u_phone = test_input($_POST["u_phone"]);
    $filtered_phone_number = filter_var($u_phone, FILTER_SANITIZE_NUMBER_INT);
     // Remove "-" from number
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     // Check the length of number
     // This can be customized if you want phone number from a specific country
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        $u_phone_err = "Invalid phone number";
        $flag=1; 
     }
    $u_email = test_input($_POST["u_email"]);
    $u_location = test_input($_POST["u_location"]);
    $u_description = test_input($_POST["u_description"]);
    $u_id = $_POST['u_id'];

    if($flag==0){
        // Insert into database of admins
        $u_update = "UPDATE admins SET username='$u_user',email='$u_email',phone='$u_phone',location='$u_location',description='$u_description' WHERE id='$u_id'";
        if(mysqli_query($con,$u_update)){
          echo "<script>alert('Successfully Updated.')</script>";
          $_SESSION['user']=$u_user;
          $u_user="";
          $u_email="";
          $u_location="";
          $u_phone="";
          $u_description="";
          $u_pass="";
        }
        else{
          echo "error";
        }
    }

  }
  $user = $_SESSION['user'];
  $info = "SELECT * FROM admins WHERE username = '$user'";
  $info_res = mysqli_query($con,$info) or die("Unsuccessful.");
  $row = mysqli_fetch_assoc($info_res);
  if(isset($_POST['u_update'])){
    if(md5($_POST['u_pass'])  !=$row['password']){
      $passerr = "Old password not correct.<br>";
    }
    else if(md5($_POST['u_passcon'])==$row['password']){
      $passerr = "New Password same as old one.<br>";
    }
    else{
      $u_id = $row['id'];
      $u_pass = md5($_POST['u_passcon']);
      $u_update = "UPDATE admins SET password='$u_pass' WHERE id='$u_id'";
      if(mysqli_query($con,$u_update)){
        echo "<script>alert('Successfully Updated.')</script>";
        $u_pass="";
      }
    }
  }
 ?>
<div class="container-fluid"><!-- Content -->
        <h1 class="mt-4"><i class="fas fa-user-tie"></i> My Profile</h1>
        <div class="container"><!-- Container Wrapper -->
          <br>

        <form method="post">
          <div class="form-group">
            <label for="u_user">Username</label>
            <input type="text" class="form-control" name="u_user" required="required" value="<?php echo $row['username'] ?>"><span class="text-danger"><?php echo $matcherr; ?></span>
          </div>
          <div class="form-group">
            <label for="u_email">User Email Address</label>
            <input type="email" class="form-control" name="u_email" required="required" value="<?php echo $row['email'] ?>">
            <small id="nameHelpBlock" class="form-text text-muted">
              User email must be valid.
            </small>
          </div>
          <div class="form-group">
            <label for="u_phone">Phone</label>
            <input type="number" class="form-control" name="u_phone" required="required" value="<?php echo $row['phone'] ?>"><span class="text-danger"><?php echo $u_phone_err; ?></span>
          </div>
          <div class="form-group">
            <label for="u_location">Location</label>
            <input type="text" class="form-control" name="u_location" required="required" value="<?php echo $row['location'] ?>">
            <small id="nameHelpBlock" class="form-text text-muted">
              User Location must be well-written, clear and concise to read & understand.
            </small>
          </div>
          <div class="form-group">
            <label for="u_description">User Description</label>
            <textarea class="form-control" name="u_description" rows="3" required="required"><?php echo $row['description'] ?></textarea>
            <small id="descHelpBlock" class="form-text text-muted">
              Description is about 200 characters long.
            </small>
          </div>
          <div class="form-group">
            <label for="u_id">User Id</label>
            <input type="text" class="form-control" name="u_id" rows="3" required="required" readonly="readonly" value="<?php echo $row['id']?>">
          </div>
            <button class="btn btn-success" name="u_submit" type="Submit">Update</button><br><br>
        </form>
        </div><!-- Container Wrapper -->
        <div class="container">
          <form method="post">
            <h3>Change Password</h3>
            <div class="form-group">
              <label for="u_pass">Old Password</label>
              <input type="password" class="form-control" name="u_pass" placeholder="Type your old password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
            <div class="form-group">
              <label for="u_pass">New Password</label>
              <input type="password" class="form-control" name="u_passcon" placeholder="Create a new password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div><span class="text-danger"><?php echo $passerr; ?></span>
            <button class="btn btn-primary" name="u_update" type="Submit">Change</button>
          </form>
        </div>
      </div><!-- Content wrapper -->
    </div>
      <!-- /#page-content-wrapper -->