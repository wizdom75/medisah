
<!DOCTYPE html>
<html lang="en-US" class="no-js">

	<head>
	
		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!-- Title -->
		<title>Medisah - Coming Soon</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico">
		
		<!-- Font awesome -->
		<link rel="stylesheet" type="text/css" href="dcss/all.min.css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
		<!-- Google web fonts -->
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600,700,700italic">
		
		<!-- Stylesheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/media.css">
		
		<!-- Color schema -->
		<link rel="stylesheet" type="text/css" href="css/color.css" class="colors">
		
		<!-- YTPlayer -->
		<link rel="stylesheet" type="text/css" href="css/ytplayer.min.css">
		
		<!-- Settings (Remove it on your site) -->
		<link rel="stylesheet" type="text/css" href="css/settings.css">
	
	</head>
	
	<body>
		<div class="wrap" id="bg-image">
	
			<!-- Main -->
			<div id="main">
				<div class="inner">
	
					<!-- Header -->
					<header>
						<h1 class="logo fade-in">
							<img src="img/logo.jpeg" width="350" height="200" alt="Medisah" />
						</h1>
					</header>
	
					<!-- Content -->
					<section class="content">
	
						<h1 class="title">
							<span>Coming soon!</span>
						</h1>
						
						<p class="slogan">
							Medicine dispensing and stock tracking will never be the same again. We are building a solution to all pharmacy problems. <br />
							One day at a time.
						</p>
	
						<!-- Countdown timer -->
						<div id="timer"></div>
	
						<p class="subtitle">Notify Me When It's Ready</p>
	
						<!-- Newsletter form -->
						<div id="newsletter" class="form-wrap">
						
							<form action="{{ '/subscribe' }}" method="post" id="newsletter-form">
							@csrf
							
								<p class="form-field">
									<input type="text" name="email" id="email" value="" placeholder="Your email" />
								</p>
								
								<p class="form-submit">
									<input type="submit" name="submit" id="submit" value="Subscribe" />
								</p>
								
							</form>
							
						</div>
	
						<!-- Social links -->
						<div class="social">
							<ul>
								
								<!-- <li>
									<a href="#" title="Twitter">
										<i class="fab fa-twitter"></i>
									</a>
								</li> -->
								
								<li>
									<a href="https://www.facebook.com/medisah247/?ref=chp" title="Facebook">
										<i class="fab fa-facebook-f"></i>
									</a>
								</li>
								
								<!-- <li>
									<a href="#" title="Pinterest">
										<i class="fab fa-pinterest"></i>
									</a>
								</li> -->
								
								<!-- <li>
									<a href="#" title="Instagram">
										<i class="fab fa-instagram"></i>
									</a>
								</li> -->
								
								<!-- <li>
									<a href="#" title="Vimeo">
										<i class="fab fa-vimeo-v"></i>
									</a>
								</li> -->
							
							</ul>
						</div>
	
					</section>
	
					<!-- Modal page toggle -->
					<div class="modal-toggle">
						<a href="#" id="modal-open" title="More Info">
							<i class="fas fa-angle-right"></i>
						</a>
					</div>
	
				</div>
			</div>
	
			<!-- Modal page: About Us -->
			<div id="modal">
				<div class="inner">
	
					<!-- Modal toggle -->
					<div class="modal-toggle">
						<a href="#" id="modal-close" title="Close">
							<i class="fas fa-times"></i>
						</a>
					</div>
	
					<!-- Content -->
					<section class="content">
						
						<h1 class="title">About <span>MEDISAH</span></h1>
					
						<!-- Columns -->
						<div class="row">
							
							<div class="one-half">
							 
<p>Medical self assistance hub. We are an Online Pharmaceutical Platform bringing you close to all your medication needs at your door step, regardless of where you are.</p>
We pride ourselves in working extremely hard, hand in hand with majority of local Pharmaceutical Companies to give you Our valued clients access to both over the counter and prescribed medications, just at the Click of a Button and at the comfort of your home from wherever you are .

							</div>
							
							<div class="one-half">
								<!-- <h2><i class="fas fa-phone"></i> Phone</h2>
								<p>
									 Phone: +1 (866) 496-3250<br />
									Fax: +1 (866) 496-3251 -->
								<!-- </p> -->
								
								<!-- <h2><i class="fas fa-envelope"></i> Email</h2> -->
								<!-- <p>
									<a href="/cdn-cgi/l/email-protection#46232b272f2a06352f322328272b236825292b"><span class="__cf_email__" data-cfemail="8de8e0ece4e1cdfee4f9e8e3ece0e8a3eee2e0">[email&#160;protected]</span></a>
								</p> -->
								
								<h2><i class="fas fa-map"></i> Address</h2>
								<p>
								London Road, Oxford, OX3 7, United Kingdom
								</p>
							</div>
							
						</div>
	
					</section>
	
				</div>
			</div>
	
		</div>
	
		<!-- Background overlay -->
		<div class="body-bg"></div>
	
		<!-- Loader -->
		<div class="page-loader">
			<div class="progress">Loading...</div>
		</div>
	
		<!-- jQuery -->
		<script data-cfasync="false" src="js/email-decode.js"></script>
		<script src="js/jquery.js"></script>

		<!-- Plugins -->
		<script src="js/modernizer.js"></script>
		<script src="js/backstretch.min.js"></script>	
		<script src="js/jquery.plugin.min.js"></script>
		<script src="js/jquery.countdown.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/jquery.placeholder.min.js"></script>
		<script src="layout/plugins/ytplayer/jquery.mb.ytplayer.min.js"></script>

		<!-- Main -->
		<script src="js/main.js"></script>
	</body>	
	
</html>