<!--  this page is used by customer to update his/her info & password. -->
<?php include 'includes/header.php'; /* header link */

if(!isset($_SESSION['name'])){echo "<script>window.open('/bistro/','_self')</script>";} 

/* emptying variables, essential for Autofill when showing up errors. */
$c_name="";
$c_email="";
$c_location="";
$c_phone="";
$c_password="";
$c_phone_err="";/*turns on if phone number is entered invalid.*/
$matcherr="";/*turns on if username already exists in db. */
$passerr="";/*turns on if there arises some kinds of error while changing password*/

/* this flag turns 1 & indicates error. */
$flag=0;

if(isset($_POST['c_update'])){
    $c_name = $_POST['c_name'];
    $c_id = $_POST['c_id'];/*id whose data is to get updated. */
    $match = "SELECT * FROM customers WHERE id = '$c_id'";
    $match_res = mysqli_query($con,$match) or die('Unsucessful database connection.');
    $row = $match_res->fetch_assoc();
    $edit_customer_id = $row['id'];
    $namematch = "SELECT * FROM customers WHERE name = '$c_name'";
    $namematch_res = mysqli_query($con,$namematch) or die('Unsucessful database connection.');     
    $count = mysqli_num_rows($namematch_res);
    if($count > 0 && isset($_POST['c_submit'])){
      $flag=1;
      $matcherr="Username already exists";
    }
    $c_name = test_input($c_name);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9_]*$/",$c_name)) {
      $flag=1;
      $matcherr = "Only letters, underscores  and white space allowed";
    }

    $c_phone = test_input($_POST["c_phone"]);
    $filtered_phone_number = filter_var($c_phone, FILTER_SANITIZE_NUMBER_INT);
     // Remove "-" from number
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     // Check the length of number
     // This can be customized if you want phone number from a specific country
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        $c_phone_err = "Invalid phone number";
        $flag=1; 
     }

   	$c_email = test_input($_POST["c_email"]);
    $c_location = test_input($_POST["c_location"]);

    if(isset($_POST['c_update'])){
      // Insert into database of admins
        $c_update = "UPDATE customers SET name='$c_name',email='$c_email',phone='$c_phone',location='$c_location' WHERE id='$edit_customer_id' ";
        if(mysqli_query($con,$c_update)){
          echo "<script>alert('Successfully Updated.')</script>" ;
          $_SESSION['name']=$c_name;
          $c_name="";
          $c_email="";
          $c_location="";
          $c_phone="";
          $c_description="";
        }
    }
  }
    


$user = $_SESSION['name'];
$info = "SELECT * FROM customers WHERE name = '$user'";
$info_res = mysqli_query($con,$info) or die("Unsuccessful.");
$row = mysqli_fetch_assoc($info_res);
$c_name = $row['name'];
$c_email = $row['email'];
$c_phone = $row['phone'];
$c_location = $row['location'];
$c_id = $row['id'];

    if(isset($_POST['c_submit'])){/* section for change password */
       if(md5($_POST['c_pass'])  !=$row['password']){
         $passerr = "Old password not correct.<br>";
       }
       else if(md5($_POST['c_passcon'])==$row['password']){
         $passerr = "New Password same as old one.<br>";
       }
       else{
         $c_id = $row['id'];
         $c_pass = md5($_POST['c_passcon']);
         $c_update = "UPDATE customers SET password='$c_pass' WHERE id='$c_id'";
         if(mysqli_query($con,$c_update)){
           echo "<script>alert('Successfully Updated.')</script>";
           $c_pass="";
         }
       }
    }

?>
<div class="container-fluid"><!-- Content -->
        <h1 class="mt-4"><i class="fas fa-user"></i> Profile</h1>
          <br>
    <form method="post"><!-- customer details input field -->
      <div class="form-group">
        <label for="c_name">Customer Name</label>
        <input type="text" class="form-control" name="c_name" required="required" value="<?php echo $c_name ?>"><span class="text-danger"><?php echo $matcherr; ?></span>
        <small id="nameHelpBlock" class="form-text text-muted">
          Customer name must be 10-25 characters long, not more.
        </small>
      </div>
      <div class="form-group">
        <label for="c_email">Customer Email</label>
        <input type="email" class="form-control" name="c_email" required="required" value="<?php echo $c_email ?>">
        <small id="nameHelpBlock" class="form-text text-muted">
          Customer email must be valid.
        </small>
      </div>
      <div class="form-group">
        <label for="c_phone">Customer Phone</label>
        <input type="number" class="form-control" name="c_phone" required="required" value="<?php echo $c_phone ?>"><span class="text-danger"><?php echo $c_phone_err; ?></span>
      </div>
      <div class="form-group">
        <label for="c_location">Customer Location</label>
        <input type="text" class="form-control" name="c_location" required="required" value="<?php echo $c_location ?>">
        <small id="nameHelpBlock" class="form-text text-muted">
          Customer Location must be well-written, clear and concise to read & understand.
        </small>
      </div>
      <div class="form-group">
        <label for="c_id">Customer Id</label>
        <input type="text" readonly class="form-control" name="c_id" required="required" value="<?php echo  $c_id ?>">
      </div>
        <button type="submit" class="btn btn-success" name="c_update">Update</button></form><br><br>

      <form method="post">
        <h3>Change Password</h3><!-- change password section -->
        <div class="form-group">
          <label for="c_pass">Old Password</label>
          <input type="password" class="form-control" name="c_pass" placeholder="Type your old password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
        </div>
        <div class="form-group">
          <label for="c_pass">New Password</label>
          <input type="password" class="form-control" name="c_passcon" placeholder="Create a new password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
        </div><span class="text-danger"><?php echo $passerr; ?></span>
        <button class="btn btn-primary" name="c_submit" type="Submit">Change</button>
      </form>
     
</div><!-- Content wrapper --> -->