<?php 
  $c_name="";
  $c_email="";
  $c_location="";
  $c_phone="";
  $c_password="";
  $c_phone_err="";
  $matcherr="";
  $flag=0;

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

   if(isset($_POST['c_submit']) || isset($_POST['c_update'])){
    $c_name = $_POST['c_name'];
    if(isset($_POST['c_update'])){$c_id = $_POST['c_id'];
    $match = "SELECT * FROM customers WHERE id = '$c_id'";
    $match_res = mysqli_query($con,$match) or die('Unsucessful database connection.');
    $row = $match_res->fetch_assoc();
    $edit_customer_id = $row['id'];}
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

    if(isset($_POST['c_submit'])){$c_password = md5(test_input($_POST["c_password"]));}
    $c_email = test_input($_POST["c_email"]);
    $c_location = test_input($_POST["c_location"]);

    if($flag==0 && isset($_POST['c_update'])){
      // Insert into database of admins
        $c_update = "UPDATE customers SET name='$c_name',email='$c_email',phone='$c_phone',location='$c_location' WHERE id='$edit_customer_id' ";
        if(mysqli_query($con,$c_update)){
          echo "<script>alert('Successfully Updated.')</script>" ;
          $c_name="";
          $c_email="";
          $c_location="";
          $c_phone="";
          $c_description="";
        }
    }
    

    if($flag==0 && isset($_POST['c_submit'])){
        // Insert into database of admins
        $c_insert = "INSERT INTO customers(name,email,phone,location,password) VALUES('$c_name','$c_email','$c_phone','$c_location','$c_password')";
        if(mysqli_query($con,$c_insert)){
          echo "<script>alert('Successfully Registered.')</script>";}
          $c_name="";
          $c_email="";
          $c_location="";
          $c_phone="";
          $c_description="";
          $c_password="";
        }
    }

?>
<div class="container-fluid"><!-- Content -->
        <h1 class="mt-4"><i class="fas fa-user-friends"></i> Customers</h1>
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
                <p>Register new customers.</p>
                <form method="post">
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
                    <label for="c_password">Customer Password</label>
                    <input type="password" class="form-control" name="c_password" required="required">
                  </div>
                    <button type="submit" class="btn btn-success" name="c_submit">Submit</a>
                </form>
            </div><!-- Tab1 content wrapper -->
          <div id="menu1" class="container tab-pane fade"><br>
            <p>These is the list of all the customers registered from this section as well as the website.</p>
              <table class="table table-responsive  ">
              <thead>
                <tr>
                  <th scope="col">Customer Id</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Customer Email</th>
                  <th scope="col">Customer Phone</th>
                  <th scope="col">Customer Location</th>
                  <th scope="col" colspan="2" class="text-center">Options</th>
                </tr>
                <?php
                $edit_customer_id="";
                $customers = "SELECT * from customers;"; 
                  $customersres = $con->query($customers);

                  if(isset($_POST['delete_customer'])){
                    $delete_customer_id = $_POST['delete_customer'];
                    
                    $delete_customer = "DELETE FROM customers WHERE id='$delete_customer_id'";
                    
                    $run_delete = mysqli_query($con,$delete_customer);
                    
                    if($run_delete){
                        
                        echo "<script>alert('One of Your customers has been deleted.')</script>";
                        
                        echo "<script>window.open('index.php?action=customers','_self')</script>";
                        
                    }
                  }


                  if ($customersres->num_rows > 0) {
                    // if data greater than 0 
                        while($row = $customersres->fetch_assoc()) {
                            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['location'] . "</td><td><form method='post'><button type='submit' class='btn btn-primary'><i class='fas fa-pencil-alt'></i> Edit</button><input type='hidden' name='edit_customer' value='" .  $row['id'] . "'></form></td>
                  <td><form method='post'><button type='submit' class='btn btn-danger'><i class='fas fa-trash'></i> Delete</button></td><input type='hidden' name='delete_customer' value='" .  $row['id'] . "'></form></td></tr>";
                        }
                    } 
                    else {
                        echo "<tr><td colspan='7' class='text-center text-danger'>0 results</td></tr>";
                    }

                    if(isset($_POST['edit_customer'])){
                    $edit_customer_id = $_POST['edit_customer'];

                    echo "<script>alert('Go & edit in manage section.');</script>";

                    $customers = "SELECT * from customers WHERE id='$edit_customer_id';"; 
                    $customersres = $con->query($customers);
                    $row = $customersres->fetch_assoc();

                    $c_name = $row['name'];
                    $c_email = $row['email'];
                    $c_phone = $row['phone'];
                    $c_location = $row['location'];
                    $c_id = $row['id'];

                    echo '<h3>Update Customer</h3>
                    <form method="post">
                      <div class="form-group">
                        <label for="c_name">Customer Name</label>
                        <input type="text" class="form-control" name="c_name" required="required" value="' .  $c_name . '"><span class="text-danger"><?php echo $matcherr; ?></span>
                        <small id="nameHelpBlock" class="form-text text-muted">
                          Customer name must be 10-25 characters long, not more.
                        </small>
                      </div>
                      <div class="form-group">
                        <label for="c_email">Customer Email</label>
                        <input type="email" class="form-control" name="c_email" required="required" value="' .  $c_email . '">
                        <small id="nameHelpBlock" class="form-text text-muted">
                          Customer email must be valid.
                        </small>
                      </div>
                      <div class="form-group">
                        <label for="c_phone">Customer Phone</label>
                        <input type="number" class="form-control" name="c_phone" required="required" value="' .  $c_phone . '"><span class="text-danger"><?php echo $c_phone_err; ?></span>
                      </div>
                      <div class="form-group">
                        <label for="c_location">Customer Location</label>
                        <input type="text" class="form-control" name="c_location" required="required" value="' .  $c_location . '">
                        <small id="nameHelpBlock" class="form-text text-muted">
                          Customer Location must be well-written, clear and concise to read & understand.
                        </small>
                      </div>
                      <div class="form-group">
                        <label for="c_id">Customer Id</label>
                        <input type="text" readonly class="form-control" name="c_id" required="required" value="' .  $c_id . '">
                      </div>
                        <button type="submit" class="btn btn-success" name="c_update">Update</button></form><br><br>';
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