<?php 
include('../includes/db.php'); 
if(isset($_POST['delete_sub'])){
    $delete_sub_email = $_POST['email'];
    
    $delete_user = "DELETE FROM subscriptions WHERE email='$delete_sub_email'";
    
    $run_delete = mysqli_query($con,$delete_user);
    
    if($run_delete){
        
        echo "<script>alert('Subscription Email " . $delete_sub_email . " Deleted.')</script>";
    }
    else{
    	echo "<script>alert('failed')</script>";
    }
    
}
$subs = "SELECT * from subscriptions;"; 
$subsres = $con->query($subs); 
 ?>
<div class="container-fluid">
        <h1 class="mt-4"><i class="fas fa-paper-plane"></i> Subscriptions</h1><br>
	      <table class="table table-responsive  ">
	      <thead>
	        <tr>
	          <th scope="col">S.N.</th>
	          <th scope="col">Email</th>
	          <th scope="col">Delete</th>
	      	</tr>
	       <form method="post">
	       	<?php
	       	$i=1;
	       	if ($subsres->num_rows > 0) {
	       	// if data greater than 0 
	       	    while($row = $subsres->fetch_assoc()) {
	       	        echo "<tr><td>" . $i . "</td><td>" . $row['email'] . "</td><td><input type='hidden' name='email' value='" . $row['email'] . "'><button type='submit' class='btn btn-danger' name='delete_sub'><i class='fas fa-trash'></i> Delete</button></td></tr>";
	       	        $i++;
	       	    }
	       	} 
	       	else {
	           	echo "<tr><td colspan='3' class='text-center'>0 results</td></tr>";
	       	}
	       	?></form>
	         </thead>
	    </table>

      </div>