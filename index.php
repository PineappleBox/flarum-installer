<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to the Auto-Installer! | Hexa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="https://myhexa.co/back/favicon.ico">
    <link rel="stylesheet" type="text/css" href="https://myhexa.co/scss/bootstrap/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://myhexa.co/dist/theme.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://myhexa.co/dist/theme.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    </head>

<body class="signin-page">
                  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" role="navigation">
                <div class="container">
                  <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-2">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <a class="navbar-brand" href="#"><img src="img/logo.png" class="d-none d-lg-inline mr-2 w-25" /></a>

                  <div class="collapse navbar-collapse justify-content-end" id="navbar-collapse-2">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co" target="_blank">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co/features" target="_blank">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co/pricing" target="_blank">Pricing</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co/contact" target="_blank">Contact Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://community.myhexa.co" target="_blank">Community</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link nav-link--rounded ml-lg-2" target="_blank" href="http://flarum-demo.myhexa.co">View Demo Site</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav><!DOCTYPE html>
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



        <br><br><br><br><br><br><div class="wrapper"><h1>Getting Started</h1><br>
<p>Welcome to the Hexa auto-installer! By clicking continue, you will be taken to the install screen.<br> There, you will need a MySQL Database and a MySQL User. If you do not have these, please create them and then continue on.<br><br><i><b>Sharing is Caring. Please Share This!</i></b></div>




<div class="wrapper">
  <div class="FormButtons">
<button type="submit" class="btn-shadow btn-shadow-dark btn-pill" onclick="window.location.href='install'">CONTINUE TO INSTALL <i class="zmdi zmdi-arrow-right"></i></button>
  
  </div>
  </div>
  <br><br>
<div class="index-features-cta">
  <div class="container">
    <div class="info">
      <strong>
At Hexa, we believe code is AWESOME!
</strong>
      <p>
        It takes a lot of time and hard work to put together these projects.<br> Please show your support by sharing this project!
      </p>
    </div>
    <a href="https://twitter.com/home?status=I%20just%20installed%20%40flarum%20using%20the%20%40myhexa%20auto-installer.%20You%20should%20really%20check%20out%20their%20stuff!%20It's%20really%20AWESOME!!!">Share on Twitter</a>
  </div>
</div>

<div class="wrapper"><br>
  <div class="alert alert-inverse" role="alert">
  Running into any issues during installation? Please click <a href="https://community.myhexa.co/t/flarum-installer">here</a> to let us know about them.
</div>




<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
      </div>
    </div>
  </body>
</html>
