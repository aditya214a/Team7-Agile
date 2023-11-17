<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style type="text/css">
	.content {
		padding: 0px;
		padding-left: 0px;
		padding-right: 0px;
	}

	.btn-common {
		color: aliceblue;
		border-radius: 5px;
	}

	.btn-common:hover {
		color: aliceblue;
		border-radius: 5px;
	}

	.content {
		padding: 0px;
		padding-left: 0px;
		padding-right: 0px;
	}

	.mt-25 {
		margin-top: 25px;
	}

	.mb-40 {
		margin-bottom: 40px;
	}

	.sm-mt-20 {
		margin-top: 20px;
	}

	/* product css */
	.page-header {
		margin-bottom: 0px;
		font-family: 'Delius Swash Caps';
		font-weight: 500;
	}

	/* single product css */
	.single-product .product-thumb-sin a img {
		max-height: 420px;
		height: fit-content;
	}

	.product-action .add-to-cart {
		color: aliceblue;
	}

	/* product text css */
	.product-text h4 a {
		font-family: cursive;
		color: #444;
	}

	.product-text h4 a:hover {
		color: forestgreen;
	}

	.product-text {
		margin-top: 13px;
	}

	.product-sale-price {
		text-decoration: line-through;
		color: gray;
	}

	.product-text>.product-price {
		color: #464444;
		font-family: 'Delius Swash Caps';
		font-weight: 600;
	}

	/* extra css */
	.style-6 h2 {
		font-family: cursive;
		font-size: 28px
	}

	.style-6 a {
		color: aliceblue;
		border-radius: 5px;
	}

	.style-6 a:hover {
		color: aliceblue;
	}
</style>

<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">

		<?php include 'includes/navbar1.php'; ?>
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-sm-12">
						<?php
						if (isset($_SESSION['error'])) {
							echo "
	        				<div class='alert alert-danger'>
	        					" . $_SESSION['error'] . "
	        				</div>
	        			";
							unset($_SESSION['error']);
						}
						?>
						<!-- video -->
						<div class="banner-area bg-1 overlay">
							<div class="">
								<div class="row align-items-center height-800 pb-111">
									<div class="col-sm-12">
										<div class="banner-text text-center">
											<h2>The Garden Introducing</h2>
											<p class="mt-30">Enjoy wonderful day in your garden</p>
											<a class="venobox video-play" data-gall="gall-video" data-autoplay="true" data-vbtype="video" href="images/client/home_page/home.mp4">
												<i class="fa fa-play"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- video End -->
						<!-- Information Read More Part -->
						<div class="service-area mt-minus-100 sm-mt-80">
							<div class="container">
								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="sin-service">
											<img src="assets/images/promo/1.jpg" alt="promo">
											<h3>Planting & Garden Care</h3>
											<p>15 Brilliant and Easy Plant Care Tips.</p>
											<a target="_blank" href="https://www.proflowers.com/blog/plant-care/" class="readmore">Read More</a>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="sin-service">
											<img src="assets/images/promo/2.jpg" alt="promo">
											<h3>Watering Your Garden</h3>
											<p>Tips On How And When To Water The Garden.</p>
											<a target="_blank" href="https://www.gardeningknowhow.com/garden-how-to/watering/watering-garden.htm" class="readmore">Read More</a>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-12 d-lg-block d-md-none">
										<div class="sin-service">
											<img src="assets/images/promo/3.jpg" alt="promo">
											<h3>Design & Renovation</h3>
											<p>How Great Garden Design Happens</p>
											<a target="_blank" href="https://www.finegardening.com/article/how-great-garden-design-happens" class="readmore">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div><br>
						<!-- Information Read More Part End -->
						<!-- Banner-Area Start-->
						<div class="banner-area bg-3">
							<div class="container">
								<div class="row align-items-center height-800">
									<div class="col-lg-8 offset-lg-2 col-md-12">
										<div class="banner-text style-3 text-black text-center mt-minus-10">
											<h2>We Are <br /> The Best Choice</h2>
											<p class="mt-35">We as some of the most trustworthy online nurseries are offer plants suitable for your zone with excellent shipping practices, including the timing of delivery.<br /> We know what plants can be delivered to your region</p>
											<a href="product_type.php" class="btn-common mt-40">Shop Now</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--banner-area end-->
						<!-- Service Area 1 Start-->
						<div class="service-area mt-86 sm-mt-63">
							<div class="container">
								<!-- Service Header Start-->
								<div class="row">
									<div class="col-lg-8 offset-lg-2">
										<div class="section-title style-2">
											<h2>Welcome to Infigreen</h2>
											<p>Perfect Choice Nursery is not associated with "Perfect Choice Landscaping & Maintenance". Perfect Choice Nursery's only focus is our Retail and Wholesale garden center.</p>
										</div>
									</div>
								</div>
								<!-- Service 1 Start-->
								<div class="row mt-55 sm-mt-50">
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="sin-service">
											<i class="fa fa-pagelines"></i>
											<h3>The best plant varieties</h3>
											<p>There is an incredible number of different plants in the world. Humans separate plants according to particular traits.</p>
										</div>
									</div>
									<!-- Service 2 Start-->
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="sin-service">
											<i class="fa fa-truck"></i>
											<h3>Professional and Convenient</h3>
											<p>With door-to-door delivery, we also provides you planting service and best guidance by professionals.</p>
										</div>
									</div>
									<!-- Service 3 Start-->
									<div class="col-lg-4 d-lg-block col-md-6 d-md-none col-sm-12">
										<div class="sin-service">
											<i class="fa fa-trophy"></i>
											<h3>We have 5+ Years of Experience</h3>
											<p>We are increasing our product quality and service by using 20 years of experience and we will more and more accurate for you.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Service Area 1 End-->

						<!-- Benefit Area Start -->
						<div class="benefit-area mt-80 sm-mt-65">
							<div class="container">
								<div class="row">
									<!-- Shadow Image -->
									<div class="col-lg-5 col-sm-12 d-none d-lg-block">
										<div class="img-shadow">
											<img src="assets/images/projects/11.jpg" class="img-shadow" alt="" />
										</div>
									</div>
									<div class="col-lg-7 col-sm-12">
										<div class="section-title style-4 text-left pt-10">
											<h2>Why Choosing “INFIGREEN”</h2>
										</div>
										<div class="row mt-30">
											<!-- 1st Column -->
											<div class="col-sm-6">
												<div class="sin-service style-2 text-left">
													<i class="fa fa-pagelines" aria-hidden="true"></i>
													<h3>Over 5+ Years of Expeirence</h3>
													<p>We are increasing our product quality and service by our experience and we will more and more accurate for you.</p>
												</div>
											</div>
											<!-- 2nd Column -->
											<div class="col-sm-6">
												<div class="sin-service style-2 text-left">
													<i class="fa fa-shield" aria-hidden="true"></i>
													<h3>Licensed, Bonded, Insured</h3>
													<p>All product are bonded and unsured for licensed product so that our idea will only using for provides.</p>
												</div>
											</div>
											<!-- 1st Column -->
											<div class="col-sm-6">
												<div class="sin-service style-2 text-left">
													<i class="fa fa-trophy" aria-hidden="true"></i>
													<h3>Award Wining Company</h3>
													<p>We were been award winning company among whaole nursery e-commerce platforms.</p>
												</div>
											</div>
											<!-- 2nd Column -->
											<div class="col-sm-6">
												<div class="sin-service style-2 text-left">
													<i class="fa fa-suitcase" aria-hidden="true"></i>
													<h3>Excellent Services</h3>
													<p>Around more than a millions customers are happy by using our services and services make us strong.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--benefit-area end-->

						<!-- Latest News start -->
						<div class="blog-area mt-40 sm-mt-57">
							<div class="container">
								<div class="row">
									<!-- Header News -->
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<div class="section-title style-2">
											<h2>Latest News</h2>
										</div>
									</div>
								</div>
								<!-- News -->
								<div class="row mt-35">
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="single-blog">
											<div class="blog-thumb">
												<a href="#"><img src="assets/images/blog/7.jpg" alt="blog-image"></a>
											</div>
											<div class="blog-desc">
												<h3>Landscape Architects Networ</h3>
												<p>Don't be distracted by criticism. Remember the only taste of success some people.</p>
												<a href="#" class="readmore">Read More</a>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-12">
										<div class="single-blog">
											<div class="blog-thumb">
												<a href="#"><img src="assets/images/blog/8.jpg" alt="blog-image"></a>
											</div>
											<div class="blog-desc">
												<h3>Expansion of Portland Japanese</h3>
												<p>Don't be distracted by criticism. Remember the only taste of success some people.</p>
												<a href="#" class="readmore">Read More</a>
											</div>
										</div>
									</div>
									<div class="col-lg-4 d-lg-block col-md-6 d-md-none col-sm-12">
										<div class="single-blog">
											<div class="blog-thumb">
												<a href="#"><img src="assets/images/blog/9.jpg" alt="blog-image"></a>
											</div>
											<div class="blog-desc">
												<h3>Architects and Urban Designers</h3>
												<p>Don't be distracted by criticism. Remember the only taste of success some people.</p>
												<a href="#" class="readmore">Read More</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Latest News Area End -->
					</div>
				</div>
		</div>
		</section>
	</div>
	</div>
	<?php include 'includes/footer.php'; ?>
	<?php include 'includes/scripts.php'; ?>
</body>

</html>