<?php 
  $matcherr="";
  $u_phone_err="";
  $u_user="";
  $u_email="";
  $u_location="";
  $u_phone="";
  $u_description="";
  $u_pass="";
  $flag=0;


  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if(isset($_POST['u_submit'])){
    $user = $_POST['u_user'];
    $match = "SELECT username FROM admins WHERE username = '$user'";
    $match_res = mysqli_query($con,$match) or die('Unsucessful database connection.');     
    $count = mysqli_num_rows($match_res);
    if($count > 0){
      $flag=1;
      $matcherr="Username already exists";
    }
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

    $u_pass = md5(test_input($_POST["u_pass"]));
    $u_email = test_input($_POST["u_email"]);
    $u_location = test_input($_POST["u_location"]);
    $u_description = test_input($_POST["u_description"]);



    if($flag==0){
        // Insert into database of admins
        $u_insert = "INSERT INTO admins(username,password,email,phone,location,description) VALUES('$u_user','$u_pass','$u_email','$u_phone','$u_location','$u_description')";
        if(mysqli_query($con,$u_insert)){
          echo "<script>alert('Successfully Registered.')</script>";
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
?> 
      <div class="container-fluid"><!-- Content -->
        <h1 class="mt-4"><i class="fas fa-users"></i> Users</h1>
        <div class="container"><!-- Container Wrapper -->
          <br>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home"><i class="fas fa-file-import"></i> Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu1"><i class="fas fa-user-cog"></i> Manage</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="home" class="container tab-pane active"><br/>
                <p>Register new admin.<span class="text-danger"> All fields are mandatory.</span></p>
                <form method="post">
                  <div class="form-group">
                    <label for="u_user">Username</label>
                    <input type="text" class="form-control" name="u_user" required="required" value="<?php echo $u_user ?>"><span class="text-danger"><?php echo $matcherr; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="u_pass">Password</label>
                    <input type="password" class="form-control" name="u_pass" placeholder="Create a password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                  </div>
                  <div class="form-group">
                    <label for="u_email">User Email Address</label>
                    <input type="email" class="form-control" name="u_email" required="required" value="<?php echo $u_email ?>">
                    <small id="nameHelpBlock" class="form-text text-muted">
                      User email must be valid.
                    </small>
                  </div>
                  <div class="form-group">
                    <label for="u_phone">Phone</label>
                    <input type="number" class="form-control" name="u_phone" required="required" value="<?php echo $u_phone ?>"><span class="text-danger"><?php echo $u_phone_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="u_location">Location</label>
                    <input type="text" class="form-control" name="u_location" required="required" value="<?php echo $u_location ?>">
                    <small id="nameHelpBlock" class="form-text text-muted">
                      User Location must be well-written, clear and concise to read & understand.
                    </small>
                  </div>
                  <div class="form-group">
                    <label for="u_description">User Description</label>
                    <textarea class="form-control" name="u_description" rows="3" required="required"><?php echo $u_description ?></textarea>
                    <small id="descHelpBlock" class="form-text text-muted">
                      Description is about 200 characters long.
                    </small>
                  </div>
                    <button class="btn btn-success" name="u_submit" type="Submit">Submit</button>
                </form>
            </div><!-- Tab1 content wrapper -->
          <div id="menu1" class="container tab-pane fade"><br>
            <p>These is the list of all the users registered from this section as well as the website. You cannot edit their personal info but can delete it.</p>
              <table class="table table-responsive  ">
              <thead>
                <tr>
                  <th scope="col">User Id</th>
                  <th scope="col">User Name</th>
                  <th scope="col">User Email</th>
                  <th scope="col">User Phone</th>
                  <th scope="col">User Location</th>
                  <th scope="col">User Description</th>
                  <th scope="col" class="text-center">Options</th>
                </tr>
                <?php 
                  $admins = "SELECT * from admins;"; 
                  $adminsres = $con->query($admins);

                  if(isset($_POST['delete_admin'])){
                    $delete_admin_id = $_POST['delete_admin'];
                    
                    $delete_admin = "DELETE FROM admins WHERE id='$delete_admin_id'";
                    
                    $run_delete = mysqli_query($con,$delete_admin);
                    
                    if($run_delete){
                        
                        echo "<script>alert('One of Your admins has been deleted.')</script>";
                        
                        echo "<script>window.open('index.php?action=users','_self')</script>";
                        
                    }
                  }


                  if ($adminsres->num_rows > 0) {
                    // if data greater than 0 
                        while($row = $adminsres->fetch_assoc()) {
                            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['username'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['location'] . "</td><td>" . $row['description'] . "</td><form method='post'><td><button type='submit' class='btn btn-danger'><i class='fas fa-trash'></i> Delete</button><input type='hidden' name='delete_admin' value='" .  $row['id'] . "'></form></td></tr>";
                        }
                    } 
                    else {
                        echo "<tr><td colspan='7' class='text-center text-danger'>0 results</td></tr>";
                    }  
                ?>
              </thead>
            </table>  
            </div>
          </div><!-- Tab2 content wrapper -->
          </div><!-- Tab Content Wrapper -->
        </div><!-- Container Wrapper -->
      </div><!-- Content wrapper -->
    </div>
      <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

</body>
</html>