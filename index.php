<!doctype html> <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title></title>
		<meta name="description" content="">
		<meta name="author" content="">

		<meta name="viewport" content="width=device-width">

		<link rel="stylesheet/less" href="less/style.less">
		<script src="js/libs/less-1.3.0.min.js"></script>

		<!-- Use SimpLESS (Win/Linux/Mac) or LESS.app (Mac) to compile your .less files
		to style.css, and replace the 2 lines above by this one:

		<link rel="stylesheet" href="less/style.css">
		-->

		<script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
	</head>
	<body>
		
		<?php 
			require_once "constants.php";
		?>
		<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

		<div class="container">

			<!-- Main hero unit for a primary marketing message or call to action -->
			<div class="homeCenter">
				<div class="row-fluid">
					<div class="span4" style="border: 1px black solid right;">
						<ul class="nav nav-list">
							<li class="nav-header">
								homeCenter
							</li>
							<li class="active">
								<a href="#"> <i class="icon-dashboard"></i> Dashboard </a>
								<a class="context pull-right" href="#">show</a>
							</li>
							<li>
								<a href="admin.php"> <i class="icon-settings"></i> Configuration </a>
							</li>
							<li class="nav-header">
								Administration
							</li>
							<li>
								<a href="#"> <i class="icon-notes"></i> Serviio console </a>
							</li>
							<li>
								<a href="#"> <i class="icon-database"></i> phpMyAdmin </a>
							</li>
							<li class="nav-header">
								Tools
							</li>
							<li>
								<a href="#"> <i class="icon-aria2c"></i> aria2C-webUI </a>
							</li>
							<li>
								<a href="#"> <i class="icon-owncloud"></i> ownCloud </a>
							</li>
							<li>
								<a href="#"> <i class="icon-bugtracker"></i> bugTracker </a>
							</li>
						</ul>
					</div>
					<div class="span8">
						<div class="row-fluid">
							<ul class="dash-row">
								<li class="span4 dash-item">
									<a href="#"><i class="bigIcon-dashboard"></i><br />Dashboard</a>
								</li>
								<li class="span4 dash-item">
									<i class="bigIcon-notes"></i><br />Serviio console
								</li>
								<li class="span4 dash-item">
									<i class="bigIcon-database"></i><br />phpMyAdmin
								</li>
							</ul>
							<ul class="dash-row">
								<li class="span4 dash-item">
									<i class="bigIcon-aria2c"></i><br />aria2C-webUI
								</li>
								<li class="span4 dash-item">
									<i class="bigIcon-owncloud"></i><br />ownCloud
								</li>
								<li class="span4 dash-item">
									<i class="bigIcon-bugtracker"></i><br />bugTracker
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<hr>

			<footer>
				<div class="row">
					<h3>
					<div class="span3">
						<span><?php echo APP_NAME ?></span>
					</div>
					<div class="span4 offset5">
						<span class="pull-right">     
    						<span id="jclock"></span>
						</span>
					</div></h3>
				</div>
			</footer>

		</div>
		<!-- /container -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')
		</script>
		<script src="js/libs/jquery.jclock.js"></script>

		<!-- scripts concatenated and minified via ant build script-->
		<script src="js/libs/bootstrap/bootstrap.min.js"></script>

		<script src="js/plugins.js"></script>
		<script src="js/script.js"></script>
		<!-- end scripts-->

	</body>
</html>
