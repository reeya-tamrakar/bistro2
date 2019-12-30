<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($_GET['action']); ?> - Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" type="text/css" href="admin_theme.css">
  <link rel="shortcut icon" type="image/png" href="/bistro/images/logo/favicon.png"/><!-- Link for favicon -->
    

  <!-- Bootstrap core JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Actions</div>
      <div class="list-group list-group-flush">
        <a href="index.php?action=dashboard" class="list-group-item list-group-item-action bg-light selected"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="index.php?action=home" class="list-group-item list-group-item-action bg-light"><i class="fas fa-home"></i> Home Page</a>
        <a href="index.php?action=cuisines" class="list-group-item list-group-item-action bg-light"><i class="fas fa-utensils"></i> Cuisines</a>
        <a href="index.php?action=cuisinecats" class="list-group-item list-group-item-action bg-light"><i class="fas fa-cog"></i> Cuisine Categories</a>
        <a href="index.php?action=customers" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user-friends"></i> Customers</a>
        <a href="index.php?action=orders" class="list-group-item list-group-item-action bg-light"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a href="index.php?action=payments" class="list-group-item list-group-item-action bg-light"><i class="fas fa-money-bill"></i> Payments</a>
        <a href="index.php?action=users" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i> Users</a>
        <a href="index.php?action=subscriptions" class="list-group-item list-group-item-action bg-light"><i class="fas fa-paper-plane"></i> Subscriptions</a>
        <a href="index.php?action=log-out" class="list-group-item list-group-item-action bg-light"><i class="fas fa-toggle-off"></i> Log Out</a>
      </div>
    </div>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>

        <a class="navbar-brand pl-1" href="index.php?action=dashboard">Admin Area</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-tie"></i> <?php echo $_SESSION['user'] ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="index.php?action=profile"><i class="fas fa-user"></i> Profile</a>
                <a class="dropdown-item" href="index.php?action=cuisines"><i class="fas fa-utensils"></i> Cuisines</a>
                <a class="dropdown-item" href="index.php?action=customers"><i class="fas fa-user-friends"></i> Customers</a>
                <a class="dropdown-item" href="index.php?action=cuisinecats"><i class="fas fa-cog"></i> Cuisine Categories</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?action=log-out"><i class="fas fa-toggle-off"></i> Log Out</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>