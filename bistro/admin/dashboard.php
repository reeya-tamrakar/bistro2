<?php 
    
    if(!isset($_SESSION['user'])){
        
        echo "<script>window.open('login.php','_self')</script>";
            
    }else{
}

    $customers = "SELECT * from customers;"; 
    $customersres = $con->query($customers);
    $cust_num = $customersres->num_rows;


    $cuisinecats = "SELECT * from cuisinecats;"; 
    $cuisinecatsres = $con->query($cuisinecats);
    $cuiscat_num = $cuisinecatsres->num_rows;


    $cuisines = "SELECT * from cuisines;"; 
    $cuisinesres = $con->query($cuisines);
    $cuis_num = $cuisinesres->num_rows;
?>
<div class="container-fluid">
        <h1 class="mt-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
        <div class="row p-3">
          <div class="col-lg-2 m-auto col-sm-6 border border-primary text-white p-0"><div class="p-1 bg-primary"><i class="fas fa-list"></i> <?php echo $cuis_num ?> Cuisine(s)</div> <div class="bg-white p-1"><a href="index.php?action=cuisines">View Details <span class=""><i class="fas fa-arrow-circle-right"></i></span></a></div>
          </div>
          <div class="col-lg-2 m-auto col-sm-6 border border-success text-white p-0"><div class="p-1 bg-success"><i class="fas fa-users"></i> <?php echo $cust_num ?> Customer(s)</div> <div class="bg-white p-1"><a href="index.php?action=customers" class="text-success">View Details <span class=""><i class="fas fa-arrow-circle-right"></i></span></a></div>
          </div>
          <div class="col-lg-2 m-auto col-sm-6 border border-warning text-white p-0"><div class="p-1 bg-warning"><i class="fas fa-tags"></i> <?php echo $cuiscat_num ?> Cuisine Cat(s)</div> <div class="bg-white p-1"><a href="index.php?action=cuisinecats" class="text-warning">View Details <span class=""><i class="fas fa-arrow-circle-right"></i></span></a></div>
          </div>
          <div class="col-lg-2 m-auto col-sm-6 border border-danger text-white p-0"><div class="p-1 bg-danger"><i class="fas fa-shopping-cart"></i> Order(s)</div> <div class="bg-white p-1"><a href="index.php?action=orders" class="text-danger">View Details <span class=""><i class="fas fa-arrow-circle-right"></i></span></a></div>
          </div>
        </div>
        <div class="row p-3">
          <div class="col-lg-8 border border-primary p-0">
            <div class="bg-primary text-white p-1"><i class="fas fa-money-bill"></i> New Orders</div>
            <div class="p-2">
              <table class="table table-responsive  ">
              <thead>
                <tr>
                  <th scope="col">Order no.</th>
                  <th scope="col">Customer Email</th>
                  <th scope="col">Invoice No.</th>
                  <th scope="col">Cuisine Id</th>
                  <th scope="col">Cuisine Qty</th>
                  <th scope="col">Location</th>
                  <th scope="col">Status</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>test@test.com</td>
                  <td>5431</td>
                  <td>12</td>
                  <td>4</td>
                  <td>Nepal</td>
                  <td>pending</td>
                </tr>
              </thead>
            </table>
            </div>
          </div>
          <div class="col-lg-4">
            <span class="text-light bg-dark p-1"><i class="fas fa-user-tie"></i> <?php echo $_SESSION['user'] ?></span>
            <div class="bg-light p-2">
              <i class="fas fa-envelope"></i>Email: <?php echo $_SESSION['email'] ?><br>
              <i class="fas fa-map-marked"></i> Location: <?php echo $_SESSION['location'] ?><br>
              <i class="fas fa-phone-square"></i> Contact: <?php echo $_SESSION['phone'] ?>
            </div>
            <div class="border border-light p-2">
              <h6>About Me</h6>
              <p><?php echo $_SESSION['description'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper --> 