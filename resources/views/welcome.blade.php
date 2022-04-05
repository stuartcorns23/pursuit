<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pursuit Traffic Management Recruitment</title>
		<link rel="icon" href="images/favicon.png">
		
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/fakeLoader.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/hoverbuttons.css')}}">
		<link rel="stylesheet" href="{{ asset('css/style.css')}}">
	</head>
	<body>
		<!-- loader -->
		<div class="fakeLoader"></div>
		<!-- end loader -->
		
		<!-- navbar -->
		<nav class="navbar navbar-expand-md fixed-top">
			<div class="container-fluid">
				<a href="index.html" class="navbar-brand bg-white"><img src="{{asset('images/pursuit-tmr-1.jpg')}}" height="100px"></a>
				<span class="call">Call us: 07885658544</span>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.html">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.html">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="services.html">Services</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="pricing.html">Pricing</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="blog.html">Blog</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact-us.html">Contact us</a>
						</li>
                        <li class="nav-btn">
							<a class="nav-link" href="{{ route('dashboard')}}">Staff Portal</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- end navbar -->
		
		<!-- home intro -->
		<div class="home-intro">
			<div class="container">
				<div class="row">
					<div class="col col-sm-12 col-md-10 offset-md-1 col-12">
						<div class="content">
							<h5>We are Trusted</h5>
							<h2>EXPERT TM RECRUITMENT</h2>
							<h6>We are a TMCA approved agency providing qualified operatives to clients across the UK</h6>
							<a href="" class="button hbtn hb-fill-right">Learn More</a> <a href="" class="button button-intro hbtn hb-fill-right">Contact us</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end end intro -->
		<!-- about -->
		<div class="about">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="content">
							<div class="title-section-left">
								<h3>Welcome to Pursuit</h3>
								<h6>We are professional - We are e</h6>
							</div>
							<p>At Pursuit TMR, we have hands-on experience of every aspect of the Traffic Management, therefore we feel that we are fully equiped and the right fit to understand and 
                                accomodate your requirements. We have a variety of qualified and experienced operatives available 365 days a year, all of our operative are:</p>
							<ul>
								<li><i class="fa fa-check"></i> Lantra Qualified from TSCO to TTMBC</li>
								<li><i class="fa fa-check"></i> OCCY Health Certified</li>
								<li><i class="fa fa-check"></i> D&A Tested</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="content-image">
							<img src="{{asset('images/cones.jpg')}}" alt="" class="w-100">
						</div>
					</div>
				</div>
			</div>
			<div class="bg-style"></div>
		</div>
		<!-- end about -->
		<!-- services -->
		<div class="services section bg-grey">
			<div class="container">
				<div class="title-section">
					<h3><span>Traffic Management</span> Industry</h3>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit dolore vel voluptatum libero consectetur accusamus! Ipsum qui veniam nemo nisi.</p>
				</div>
				<div class="row">
					<div class="col col-md-4 col-sm-12 col-12">
						<div class="content">
							<i class="fa fa-building"></i>
							<h5>TM Experience</h5>
							<p class="mb-0">Whether your looking for a sinlge operative or multiple crews. Pursuit TMR can help provide highly experienced operative of all levels at short notice. 
                                Please get in touch today!</p>
						</div>
					</div>
					<div class="col col-md-4 col-sm-12 col-12">
						<div class="content content-center">
							<i class="fa fa-dumbbell"></i>
							<h5>Looking for Skilled Operatives?</h5>
							<p class="mb-0">Whether your looking for a sinlge operative or multiple crews. Pursuit TMR can help provide highly experienced operative of all levels at short notice. 
                                Please get in touch today!</p>
						</div>
					</div>
					<div class="col col-md-4 col-sm-12 col-12">
						<div class="content">
							<i class="fa fa-wrench"></i>
							<h5>Looking for Work?</h5>
							<p class="mb-0">Are you looking for work? If you are looking for a job in the Traffic Management sector, we can help you.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end services -->
		<!-- our work -->
		<div class="our-work">
			<div class="container">
				<div class="title-section">
					<h3>Our <span>Fantastic</span> Work</h3>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit dolore vel voluptatum libero consectetur accusamus! Ipsum qui veniam nemo nisi.</p>
				</div>
			</div>
			<div class="row no-gutters">
				<div class="col-md-6 col-sm-4 col-12">
					<div class="content imghvr-fade">
						<img src="images/work1.jpg" alt="">
						<a href="">
							<div class="caption">
								<h6>Building Bridge</h6>
								<p>Construction</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-12">
					<div class="content imghvr-fade">
						<img src="images/work2.jpg" alt="">
						<a href="">
							<div class="caption">
								<h6>Building Home</h6>
								<p>Construction</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-12">
					<div class="content imghvr-fade">
						<img src="images/work3.jpg" alt="">
						<a href="">
							<div class="caption">
								<h6>Looking for work?</h6>
								<p>Construction</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-12">
					<div class="content imghvr-fade">
						<img src="images/work4.jpg" alt="">
						<a href="">
							<div class="caption">
								<h6>Building House</h6>
								<p>Construction</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-12">
					<div class="content imghvr-fade">
						<img src="images/work5.jpg" alt="">
						<a href="">
							<div class="caption">
								<h6>Building Home</h6>
								<p>Construction</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-sm-4 col-12">
					<div class="content imghvr-fade">
						<img src="images/work6.jpg" alt="">
						<a href="">
							<div class="caption">
								<h6>Building Home</h6>
								<p>Construction</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- end our work -->
		<!-- features -->
		<div class="features section">
			<div class="container">
				<div class="title-section">
					<h3>Our <span>Campany</span> Features</h3>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit dolore vel voluptatum libero consectetur accusamus! Ipsum qui veniam nemo nisi.</p>
				</div>
				<div class="row">
					
					<div class="col col-sm-12 col-12 col-md-6">
						<div class="content">
							<h4>We always give the best</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda sed quo laudantium quae soluta magni architecto, voluptate quasi quidem error, dolorum accusamus modi quaerat eos autem.</p>
						</div>
						<div class="content">
							<div class="icon">
								<i class="fa fa-fire"></i>
							</div>
							<div class="content-text">
								<h5>Repair if there is damage </h5>
								<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit Amet perspiciatis fuga repellendus similique quod obcaecati.</p>
							</div>
						</div>
						<div class="content">
							<div class="icon">
								<i class="fa fa-calendar"></i>
							</div>
							<div class="content-text">
								<h5>Controling every month</h5>
								<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit Amet perspiciatis fuga repellendus similique quod obcaecati.</p>
							</div>
						</div>
						<div class="content">
							<div class="icon">
								<i class="fa fa-cog"></i>
							</div>
							<div class="content-text">
								<h5>Strong and durable</h5>
								<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit Amet perspiciatis fuga repellendus similique quod obcaecati.</p>
							</div>
						</div>
						<div class="content pb-0">
							<div class="icon">
								<i class="fa fa-comments"></i>
							</div>
							<div class="content-text">
								<h5>Free consultation</h5>
								<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit Amet perspiciatis fuga repellendus similique quod obcaecati.</p>
							</div>
						</div>
					</div>
					<div class="col col-sm-12 col-12 col-md-6">
						<img src="images/features.jpg" alt="" class="w-100">
					</div>
				</div>
			</div>
		</div>
		<!-- end features -->
		<!-- latest blog -->
		<div class="latest-blog section bg-grey">
			<div class="title-section">
				<h3>Get <span>Info</span> from Blog</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit dolore vel voluptatum libero consectetur accusamus! Ipsum qui veniam nemo nisi.</p>
			</div>
			<div class="container">
				<div class="row">
					<div class="col col-sm-12 col-12 col-md-4">
						<div class="content">
							<img src="images/blog3.jpg" alt="" class="w-100">
							
							<div class="content-text">
								<h5><a href="">Great results are charming and beautiful</a></h5>
								<span>03 March 2020</span>
								<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur explicabo nobis soluta praesentium deserunt magnam voluptatum</p>
							</div>
						</div>
					</div>
					<div class="col col-sm-12 col-12 col-md-4">
						<div class="content">
							<img src="images/blog2.jpg" alt="" class="w-100">
							
							<div class="content-text">
								
								<h5><a href="">Have a machine that is reliable and fast </a></h5>
								<span>11 April 2020</span>
								<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur explicabo nobis soluta praesentium deserunt magnam voluptatum</p>
							</div>
						</div>
					</div>
					<div class="col col-sm-12 col-12 col-md-4">
						<div class="content r-980">
							<img src="images/blog1.jpg" alt="" class="w-100">
							
							<div class="content-text">
								
								<h5><a href="">We have been working on a big project</a></h5>
								<span>21 July 2020</span>
								<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur explicabo nobis soluta praesentium deserunt magnam voluptatum</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end latest blog -->
		<!-- footer -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-8 col-12">
						<h6>Exroz</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni provident voluptatem, consequatur porro alias.</p>
						<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et repudiandae nulla obcaecati accusamus iusto nam consequat</p>
					</div>
					<div class="col-md-2 col-sm-4 col-12">
						<h5>Quick Link</h5>
						<ul>
							<li><a href="">About us</a></li>
							<li><a href="">Pricing</a></li>
							<li><a href="">Services</a></li>
							<li><a href="">Blog</a></li>
							<li><a href="">Contact us</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 col-12">
						<h5>Recents Post</h5>
						<ul>
							<li><a href="">We will increase your busin . . . .</a></li>
							<li><a href="">Make your laptop as compute . . . .</a></li>
							<li><a href="">Trending trick for you wor . . . .</a></li>
							<li><a href="">Create faster landing page tem . . . .</a></li>
							<li><a href="">Business now is very easy usi . . . .</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 col-12">
						<h5>Contact us</h5>
						<ul>
							<li><i class="fa fa-envelope"></i> astylers97@gmail.com</li>
							<li><i class="fa fa-phone"></i> +61 3 8376 6284</li>
							<li class="map"><i class="fa fa-map-marker"></i> <p>121 King Street, Melbourne
							Victoria 3000 Australia</p></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<!-- end footer -->
		<!-- footer bottom -->
		<div class="footer-bottom">
			<div class="container">
				<p>Copyright © All Right Reserved</p>
			</div>
		</div>
		<!-- end footer bottom -->
		
		<!-- script -->
		<script src="{{ asset('js/jquery.min.js')}}"></script>
		<script src="{{ asset('js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('js/fakeLoader.min.js')}}"></script>
		<script src="{{ asset('js/main.js')}}"></script>
	</body>
</html>