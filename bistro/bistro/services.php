<!-- this is  -->
<?php include('includes/header.php'); ?>
<style type="text/css">
	.jumbotron {/* centering picture */
	  background-image: url("/bistro/images/services_bg.jpg");
	  background-size: cover;
	  height: 600px;
	  display: flex;
	  justify-content: center;
	  align-items: center;
	}
	.strokeme/* using stroke on the cover picture */
	{
	    color: white;
	    text-shadow:
	    -1px -1px 0 #000,
	    1px -1px 0 #000,
	    -1px 1px 0 #000,
	    1px 1px 0 #000;
	  	font-size: 50px;
	  	background-color: rgba(0,0,0,.5);
	}
</style>
<body>
<?php echo "<h1> Our ".ucfirst($first_part)."</h1>";?>
 <div class="jumbotron text-center">
 	<h2 class="strokeme">We here are bistro are enjoying to provide you the services you want the most.</h2>
 </div>
 <div class="card-deck">
  <div class="card text-center">
    <i class="fas fa-glass-cheers p-3" style="font-size: 60px;"></i>
    <div class="card-body">
      <h5 class="card-title">Food & Beverages</h5>
      <p class="card-text">Bistro provides both online & offline services regarding food & beverages. Food & Beverages can be ordered both online & offline.</p>
    </div>
  </div>
  <div class="card text-center">
    <i class="fas fa-birthday-cake p-3" style="font-size: 60px;"></i>
    <div class="card-body">
      <h5 class="card-title">Birthday party & events</h5>
      <p class="card-text">Whether it be your birthday or your friends', bistro is already to host different birthdays & other events.</p>
    </div>
  </div>
  <div class="card text-center">
    <i class="fas fa-clock p-3" style="font-size: 60px;"></i>
    <div class="card-body">
      <h5 class="card-title">Fast delievery</h5>
      <p class="card-text">Discluding traffic conditions, we provide top class fast delievery services. Instantly, we try to crave in your hunger needs.</p>
    </div>
  </div>
  <div class="card text-center">
    <i class="fas fa-campground p-3" style="font-size: 60px;"></i>
    <div class="card-body">
      <h5 class="card-title">Catering</h5>
      <p class="card-text">We go along with picnic groups, cook foods you want on your auspicious occasions at reasonable prices & also serve with our full hearts.</p>
    </div>
  </div>
</div><br>
<p><a href="/bistro/contact">Contact us</a> for more</p>
<?php include('includes/footer.php');?>