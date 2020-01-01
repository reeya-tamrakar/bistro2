<footer>
<div class="foot bg-light p-2"><!-- Light Background Footer -->
	<div class="row">
		<div class="col-sm-6 col-md-3 p-3">
			<h5>bistro</h5>
			<p>A little oasis tucked away in the heart of Kathmandu, Bistro is the gem of continental, indian, nepalese & world fusion gastronomy, where cuisines are elevated to the forms of art, and ambience a perfect blend of taste & perfection</p>
		</div>
		<div class="col-sm-6 col-md-3 p-3">
			<h5>Site Options</h5>
			<a href="/bistro2/bistro/admin/index?action=dashboard">Head to admin panel</a><br/>
			<a href="/bistro2/bistro/docs/index">Head to documentation</a><br/><br/>
			<h5>Navigation</h5>
			<a href="/bistro2/bistro/">Home</a><br/>
			<a href="/bistro2/bistro/services">Services</a><br/>
			<a href="/bistro2/bistro/about">About</a><br/>
		</div>
		<div class="col-sm-6 col-md-3 p-3">
			<h5>Find us</h5>
			<p><!-- p Start -->
                    
                    <strong>Bistro</strong>
                    <br/>Patan, Lalitpur
                    <br/>http://localhost/bistro
                    <br/>0818-0683-3157
                    <br/>bistro@localhost.com
                    <br/><strong>Cosmos project</strong>
                    
            </p><!-- p Finish -->
		</div>
		<?php 
		include('includes/db.php'); /* part for subscriptions sending */
		if(isset($_POST['sub'])){
			$email=$_POST['email'];

			$insert = "INSERT INTO subscriptions (email) VALUES('$email');";

			if(mysqli_query($con,$insert))
			{
				echo "<script>alert('Successfully Sent')</script>";
			}
			else
			{
				echo "<br>Error.";
			}
		}
		
		 ?>
		<div class="col-sm-6 col-md-3 p-3">
			<form method="post"><!--s Newsletter Subscription Form -->
				<h5>Subscribe to news-letter</h5>
				<div class="input-group mb-3">
				  <input type="email" class="form-control" name="email" required="required">
				  <div class="input-group-append">
				    <input class="btn btn-outline-primary" type="submit" name="sub" value="Subscribe">
				  </div>
				</div>
			</form>
				<hr>
				<h5>Keep in touch</h5>
				<div class="btn-group d-flex justify-content-center" role="group"><!-- Icon group (Learn more at bootstrap documentation about this section) -->
				  <button type="button" class="btn btn-secondary ml-2"><i class="fi-xnsuxl-facebook"></i></button>
				  <button type="button" class="btn btn-secondary ml-2"><i class="fi-xnsuxl-instagram"></i></button>
				  <button type="button" class="btn btn-secondary ml-2"><i class="fi-xnsuxl-twitter"></i></button>
				  <button type="button" class="btn btn-secondary ml-2"><i class="fi-xnsuxl-whatsapp"></i></button>
				  <button type="button" class="btn btn-secondary ml-2"><i class="fi-xwsuxl-youtube"></i></button>
				</div>
		</div>
	</div>
</div>
<div class="copy bg-dark p-2"><!-- Copyight text -->
	<p class="text-white" align="center">&copy; <?php echo date("Y") ?> Bistro All Rights Reserved.</p>
</div>
</footer>
</body>
</html>