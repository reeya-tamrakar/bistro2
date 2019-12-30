<?php include('includes/header.php'); ?><!-- Header Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
<style type="text/css">
	.jumbotron{
		position: absolute;
		z-index: 2;
	}
	@media only screen and (max-width: 991.98px) {
	  .jumbotron{
	  	position: static;
	  }
	}/* Jumbotron css for enhancement of it & responsiveness */
	.carousel-caption{
		background: rgba(0,0,0,0.8);
	}/* to make carousel caption easily visible */
	.item {
	    position:relative;
	    padding-top:20px;
	    display:inline-block;/* offers part item */
	}
	.notify-badge{
	    position: absolute;
	    right:-20px;
	    top:10px;
	    background:red;
	    text-align: center;
	    border-radius: 30px 30px 30px 30px;
	    color:white;
	    padding:5px 10px;
	    font-size:20px;/* notification badge on the top of the offers part */
	}
	.jumbotron-fluid.parallax{
		background: url(/bistro/images/parallax-bg.jpg);
		min-height: 500px;
		display: flex;
		justify-content: center;
		align-items: center;
		background-attachment: fixed;/* parallax css */
	}
</style>
<div class="container-fluid">
	<div class="jumbotron text-center" style="position: static;"><!-- Welcome text on the top -->
		<h1>Welcome to Bistro!<br><small class="text-muted">Sweet serendipity awaits to fill your senses with divine pleasures.</small></h1>
		<p>A little oasis tucked away in the heart of Kathmandu, Bistro is the gem of continental, indian, nepalese & world fusion gastronomy, where cuisines are elevated to the forms of art, and ambience a perfect blend of taste & perfection</p>
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel"><!-- a simple bootstrap carousel -->
			<div class="carousel-inner">
			  	<?php /* carousel php i.e. controlled from the admin panel */
			  	$tbl_select = "SELECT * from slides";
			  	$tbl = mysqli_query($con,$tbl_select);
			  	$tblrow = mysqli_fetch_assoc($tbl);
			  	echo '<div class="carousel-item active">
				      <img class="d-block w-100" src="uploads/slides/' . $tblrow['img'] . '" alt="First slide">
				    <div class="carousel-caption d-none d-sm-block">
			      <p>' . $tblrow['name'] . '</p>
			    </div></div>';/* first carousel image, i.e. active. */
			  	while($tblrow = mysqli_fetch_assoc($tbl)){
			  		echo '<div class="carousel-item">
				      <img class="d-block w-100" src="uploads/slides/' . $tblrow['img'] . '" alt="Slide">
				    <div class="carousel-caption d-none d-sm-block">
			      <p>' . $tblrow['name'] . '</p>
			    </div></div>';/* rest of the other carousel images. */
			  	}
			  	 ?>
			</div>
		</div>
	</div>
	<div class="jumbotron text-center" style="background: transparent; position: static;"><!-- search bar after the dynamic carousel (doesn't work yet) -->
		<p class="display-4">What are you craving for? <i class="fas fa-drumstick-bite"></i></p>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" placeholder="Cuisine Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-outline-success" type="button"><i class="fab fa-searchengin"></i> Search</button>
		  </div>
		</div>
	</div><hr>
	<div class="jumbotron text-center" style="background: transparent; position: static;"><!-- left why us section -->
		<p class="display-4">Why us <i class="fas fa-question"></i><br>not others <i class="far fa-question-circle"></i></p>
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col">
						<p class="display-3"><i class="fas fa-birthday-cake"></i><br><span class="num">200</span>+</p>
						<p>Events & Parties</p>
					</div>
					<div class="col">
						<p class="display-3"><i class="far fa-laugh-beam"></i><br><span class="num">1000</span>+</p>
						<p>Satisfied Customers</p>
					</div>
				</div>
				<div class="row my-5">
					<div class="col my-5">
						<p class="display-3"><i class="fas fa-birthday-cake"></i><br><span class="num">1</span> hr-*</p>
						<p>Delievery Time<br><small class="text-muted">* - Within 10kms of bistro</small></p>
					</div>
					<div class="col my-5">
						<p class="display-3"><i class="far fa-smile-beam"></i></p>
						<p>Warm Hospitality</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<!-- Section: Testimonials v.2 -->
				<section class="text-center">

				  <!-- Section heading -->
				  <h2 class="h1-responsive font-weight-bold my-5">What customers say!</h2>

				  <div class="wrapper-carousel-fix">
				    <!-- Carousel Wrapper -->
				    <div id="carousel-example-1" class="carousel no-flex testimonial-carousel slide carousel-fade" data-ride="carousel"
				      data-interval="false">
				      <!--Slides-->
				      <div class="carousel-inner" role="listbox">
				        <!--First slide-->
				        <div class="carousel-item active">
				          <div class="testimonial">
				            <!--Avatar-->
				            <div class="avatar mx-auto mb-4">
				              <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(30).jpg" class="rounded-circle img-fluid"
				                alt="First sample avatar image">
				            </div>
				            <!--Content-->
				            <p>	
				              <i class="fas fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
				              eos
				              id officiis hic tenetur quae quaerat ad velit ab. Lorem ipsum dolor sit amet, consectetur
				              adipisicing elit. Dolore cum accusamus eveniet molestias voluptatum inventore laboriosam labore
				              sit, aspernatur praesentium iste impedit quidem dolor veniam.
				            </p>
				            <h4 class="font-weight-bold">Anna Deynah</h4>
				            <h6 class="font-weight-bold my-3">Founder at ET Company</h6>
				          </div>
				        </div>
				        <!--First slide-->
				        <!--Second slide-->
				        <div class="carousel-item">
				          <div class="testimonial">
				            <!--Avatar-->
				            <div class="avatar mx-auto mb-4">
				              <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" class="rounded-circle img-fluid"
				                alt="Second sample avatar image">
				            </div>
				            <!--Content-->
				            <p>
				              <i class="fas fa-quote-left"></i> Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
				              odit
				              aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
				              porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia
				              non numquam eius modi tempora incidunt ut labore. </p>
				            <h4 class="font-weight-bold">Maria Kate</h4>
				            <h6 class="font-weight-bold my-3">Photographer at Studio LA</h6>
				          </div>
				        </div>
				        <!--Second slide-->
				        <!--Third slide-->
				        <div class="carousel-item">
				          <div class="testimonial">
				            <!--Avatar-->
				            <div class="avatar mx-auto mb-4">
				              <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(3).jpg" class="rounded-circle img-fluid"
				                alt="Third sample avatar image">
				            </div>
				            <!--Content-->
				            <p>
				              <i class="fas fa-quote-left"></i> Duis aute irure dolor in reprehenderit in voluptate velit esse
				              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
				              culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus
				              error sit voluptatem accusantium doloremque laudantium.</p>
				            <h4 class="font-weight-bold">John Doe</h4>
				            <h6 class="font-weight-bold my-3">Front-end Developer in NY</h6>
				        </div>
				        <!--Third slide-->
				      </div>
				      <!--Slides-->
				      <!--Controls-->
				      <a class="carousel-control-prev left carousel-control" href="#carousel-example-1" role="button"
				        data-slide="prev">
				        <span class="icon-prev" aria-hidden="true"></span>
				        <span class="sr-only">Previous</span>
				      </a>
				      <a class="carousel-control-next right carousel-control" href="#carousel-example-1" role="button"
				        data-slide="next">
				        <span class="icon-next" aria-hidden="true"></span>
				        <span class="sr-only">Next</span>
				      </a>
				      <!--Controls-->
				    </div>
				    <!-- Carousel Wrapper -->
				  </div>

				</section>
				<!-- Section: Testimonials v.2 -->
			</div>
		</div>

		<h1><i class="fas fa-funnel-dollar"></i> Offers</h1><!-- Offers section -->
		<p>Dashain Maha Offer</p>
		<div class="slick"><!-- a simple bootstrap slick (controls in the bottom), isn't dynamic yet -->
			<div class="content">
			  	<div class="item">
			  		<a href="#">
						<span class="notify-badge">10%</span>
						<div class="thumbnail" >
							<h4 class="text-center"><span class="label label-info">Nepali</span></h4>
							<img src="http://placehold.it/300x300&text=Momo" class="img-responsive">
							<div class="caption">
								<div class="row">
									<div class="col-md-4 col-xs-6">
										<h3>Momo</h3>
									</div>
									<div class="col-md-8 col-xs-6 price">
										<h3>
										<label>Rs. 124</label>
										</h3>
									</div>
								</div>
								<p>prev. Rs. 140</p>
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-primary btn-product"><span class="glyphicon glyphicon-thumbs-up"></span> Details</a> 
									</div>
									<div class="col-md-6">
										<a href="#" class="btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
									</div>
								</div>
							</div>
						</div><!-- Thumbnail -->
					</a>
				</div><!-- Item Wrapper -->
			</div><!-- Content Wrapper -->
			<div class="content">
			  	<div class="item">
			  		<a href="#">
						<span class="notify-badge">10%</span>
						<div class="thumbnail" >
							<h4 class="text-center"><span class="label label-info">Nepali</span></h4>
							<img src="http://placehold.it/300x300&text=Momo" class="img-responsive">
							<div class="caption">
								<div class="row">
									<div class="col-md-4 col-xs-6">
										<h3>Momo</h3>
									</div>
									<div class="col-md-8 col-xs-6 price">
										<h3>
										<label>Rs. 124</label>
										</h3>
									</div>
								</div>
								<p>prev. Rs. 140</p>
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-primary btn-product"><span class="glyphicon glyphicon-thumbs-up"></span> Details</a> 
									</div>
									<div class="col-md-6">
										<a href="#" class="btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
									</div>
								</div>
							</div>
						</div><!-- Thumbnail -->
					</a>
				</div><!-- Item Wrapper -->
			</div><!-- Content fluid Wrapper -->
			<div class="content">
			  	<div class="item">
			  		<a href="#">
						<span class="notify-badge">10%</span>
						<div class="thumbnail" >
							<h4 class="text-center"><span class="label label-info">Nepali</span></h4>
							<img src="http://placehold.it/300x300&text=Momo" class="img-responsive">
							<div class="caption">
								<div class="row">
									<div class="col-md-4 col-xs-6">
										<h3>Momo</h3>
									</div>
									<div class="col-md-8 col-xs-6 price">
										<h3>
										<label>Rs. 124</label>
										</h3>
									</div>
								</div>
								<p>prev. Rs. 140</p>
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-primary btn-product"><span class="glyphicon glyphicon-thumbs-up"></span> Details</a> 
									</div>
									<div class="col-md-6">
										<a href="#" class="btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
									</div>
								</div>
							</div>
						</div><!-- Thumbnail -->
					</a>
				</div><!-- Item Wrapper -->
			</div><!-- Content fluid Wrapper -->
			<div class="content">
			  	<div class="item">
			  		<a href="#">
						<span class="notify-badge">10%</span>
						<div class="thumbnail" >
							<h4 class="text-center"><span class="label label-info">Nepali</span></h4>
							<img src="http://placehold.it/300x300&text=Momo" class="img-responsive">
							<div class="caption">
								<div class="row">
									<div class="col-md-4 col-xs-6">
										<h3>Momo</h3>
									</div>
									<div class="col-md-8 col-xs-6 price">
										<h3>
										<label>Rs. 124</label>
										</h3>
									</div>
								</div>
								<p>prev. Rs. 140</p>
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-primary btn-product"><span class="glyphicon glyphicon-thumbs-up"></span> Details</a> 
									</div>
									<div class="col-md-6">
										<a href="#" class="btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
									</div>
								</div>
							</div>
						</div><!-- Thumbnail -->
					</a>
				</div><!-- Item Wrapper -->
			</div><!-- Content fluid Wrapper -->
			<div class="content">
			  	<div class="item">
			  		<a href="#">
						<span class="notify-badge">10%</span>
						<div class="thumbnail" >
							<h4 class="text-center"><span class="label label-info">Nepali</span></h4>
							<img src="http://placehold.it/300x300&text=Momo" class="img-responsive">
							<div class="caption">
								<div class="row">
									<div class="col-md-4 col-xs-6">
										<h3>Momo</h3>
									</div>
									<div class="col-md-8 col-xs-6 price">
										<h3>
										<label>Rs. 124</label>
										</h3>
									</div>
								</div>
								<p>prev. Rs. 140</p>
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-primary btn-product"><span class="glyphicon glyphicon-thumbs-up"></span> Details</a> 
									</div>
									<div class="col-md-6">
										<a href="#" class="btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
									</div>
								</div>
							</div>
						</div><!-- Thumbnail -->
					</a>
				</div><!-- Item Wrapper -->
			</div><!-- Content fluid Wrapper -->
		</div><br><br><!-- Slick Wrapper -->
		<h1><i class="fas fa-star"></i> Featured Categories</h1><br>
		<div class="slick"><!-- a simple bootstrap slick (controls in the bottom), isn't dynamic yet -->
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/nepali-food-featured-cat.png" alt="Card image cap">
			  <div class="card-body">
			    <h2 class="card-text">Nepali</h2>
			  </div>
			</a>
			</div>
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/continental-food-featured-cat.png" alt="Card image cap" style="">
			  <div class="card-body"><br><br><br><br><br><br>
			    <h2 class="card-text">Continental</h2>
			  </div>
			</a>
			</div>
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/indian-food-featured-cat.png" alt="Card image cap">
			  <div class="card-body"><br><br>
			    <h2 class="card-text">Indian</h2>
			  </div>
			</a>
			</div>
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/chinese-food-featured-cat.png" alt="Card image cap">
			  <div class="card-body"><br><br><br><br><br><br>
			    <h2 class="card-text">Chinese</h2>
			  </div>
			</a>
			</div>
		</div><!-- Slick Wrapper --><br><br>
		<h1><i class="fas fa-hotdog"></i> Featured Dishes</h1><br>
		<div class="slick"><!-- a simple bootstrap slick (controls in the bottom), isn't dynamic yet -->
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/nepali-momo-featured.png" alt="Card image cap">
			  <div class="card-body">
			    <h2 class="card-text">Momo</h2>
			  </div>
			</a>
			</div>
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/chinese-peach-garden-featured.png" alt="Card image cap" style="">
			  <div class="card-body">
			    <h2 class="card-text">Peach Garden</h2>
			  </div>
			</a>
			</div>
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/continental-smoothie-featured.png" alt="Card image cap">
			  <div class="card-body">
			    <h2 class="card-text">Smoothie</h2>
			  </div>
			</a>
			</div>
			<div class="card border-0" style="">
			<a href="#">
			  <img class="card-img-top" src="/bistro/images/indian-biryani-featured.png" alt="Card image cap">
			  <div class="card-body">
			    <h2 class="card-text">Biryani</h2>
			  </div>
			</a>
			</div>
		</div><!-- Slick Wrapper -->
	</div><!-- Jumbotron Container Wrapper -->
	<div class="jumbotron-fluid parallax" data-stellar-background-ratio="0.5"><!-- a parallax that is created by using stellar.js -->
	</div>
	<div class="content text-white p-4 display-4" style="background:rgba(0,0,0,0.9);">
			<p>The inception of Bistro can be attributed to the lack of quality eateries in Nepal. As a restaurant, we have struggled to come to terms with the standards the Nepali consumer is accepting on a daily basis.</p><a href="/bistro/about">Read More about bistro</a>
	</div>
</div><!-- Container fluid Wrapper -->
<script src="/bistro/js/jquery.stellar.js"></script><!-- stellar.js which uses jquery for parallax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script><!-- counterup.js which uses jquery for counting up in why us section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script><!-- waypoints is a reference for counterup -->
<script type="text/javascript">
	$('.carousel').carousel({/*jquery for carousel*/
	  interval: 2000
	});
	$(".num").counterUp({/*jquery for counterUp*/
	  delay: 10,
	  time: 500
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
<script type="text/javascript">
	$('.slick').slick({/*jquery for slicks (slick is responsive.)*/
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  dots: true,
	  responsive: [
	      {
	        breakpoint: 1200,
	        settings: {
	          slidesToShow: 3,
	          slidesToScroll: 1,
	          infinite: true,
	          dots: true
	        }
	      },
	      {
	        breakpoint: 1100,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 2
	        }
	      },
	      {
	        breakpoint: 725,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1
	        }
	      }]
	});
</script>
<script type="text/javascript">
	$.stellar();/*stellar.js initialization*/
</script>
<?php include('includes/footer.php'); ?><!-- Footer Link -->