<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="A complete landing page solution for any business">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<title>Welcome - Flarum Installer | Hexa</title>
	<link rel="stylesheet" href="https://myhexa.co/assets/vendor/strokegap/style.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/vendor/slick-carousel/slick/slick.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/vendor/fancybox/dist/jquery.fancybox.min.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/vendor/animate.css/animate.min.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/css/bundle.css">
	<link rel="stylesheet" href="https://myhexa.co/assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Google%20Sans:400,500,600,700%7COpen+Sans:400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<header class="header header-shrink header-inverse fixed-top">
		<div class="container">
			<nav class="navbar navbar-expand-lg">
				<a class="navbar-brand" href="/">
					<span class="logo-default">
          <img src="https://myhexa.co/assets/img/hexa-white.svg" alt="">
        </span>
					<span class="logo-inverse">
          <img src="https://myhexa.co/assets/img/hexa.svg" alt="">
        </span>
				</a>
				<div class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
					<span class="lnr lnr-text-align-right nav-hamburger"></span>
					<span class="lnr lnr-cross nav-close"></span>
				</div>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link btn btn-sm btn-rounded btn-default u-w-110" href="https://myhexa.co" target="_blank">Visit Hexa</a>
						</li>
						<li class="nav-item">
							<a class="nav-link btn btn-sm btn-rounded btn-white u-w-160" href="https://github.com/myhexa/flarum-installer">View on GitHub</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>
	<section class="u-py-100 u-pt-lg-200 u-pb-lg-150 u-flex-center" style="background: linear-gradient(-180deg, #BCC5CE 0%, #929EAD 98%), radial-gradient(at top left, rgba(255,255,255,0.30) 0%, rgba(0,0,0,0.30) 100%);
 background-blend-mode: screen; background-size:cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center text-white">
					<h1 class="text-white">
    			Getting Started
    		</h1>
					<div class="u-h-4 u-w-50 bg-white rounded mx-auto my-4"></div>
					<p class="lead">
						During this installation, Flarum will be installed onto
						<?php
$hostname = getenv('HTTP_HOST');
echo $hostname; ?>
					</p>
				</div>
			</div>
		</div>
	</section>
	<section class="u-py-80">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>Welcome!</h3>
					<p>Hello! Welcome to the Flarum auto-installer by Hexa. The Hexa installer helps you to easily install Flarum forum software on any host, as long as they support php. When you're ready, click the button below to move on.</p>
					<br>
					<br>
					<button class="nav-link btn btn-sm btn-rounded btn-default u-w-250" onclick="window.location.href='install'">CONTINUE TO INSTALL</button>
				</div>
	</section>
	<script src="https://myhexa.co/assets/vendor/jquery/dist/jquery.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/popper.js/dist/popper.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/isotope/dist/isotope.pkgd.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/parallax.js/parallax.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/wow/dist/wow.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/vide/dist/jquery.vide.min.js"></script>
	<script src="https://myhexa.co/assets/vendor/appear-master/dist/appear.min.js"></script>
	<script src="https://myhexa.co/assets/js/smoothscroll.js"></script>
	<script src="https://myhexa.co/assets/js/bundle.js"></script>
	<script src="https://myhexa.co/assets/js/fury.js"></script>
</body>

</html>
