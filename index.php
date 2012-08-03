<?php
/*
LOOK UP:
https://developers.facebook.com/docs/opengraph/actionlinks/
*/


/* Init app */
require_once('app.php');
$app = new App();

/* Current User */
$me = FALSE;

if($app->isLoggedIn()) {
	$me = $app->getUser();
}
?><!DOCTYPE html>
<html>
<head>
	<title>Stream Test</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<meta property="og:title" content="Stram Red"/>
	<meta property="og:site_name" content="Stram Test"/>
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="<?php echo $app->getAppId(); ?>" />
	<meta property="og:image" content="http://secure.digitalsurgeons.com/stream/phaser-st4.jpg"/>
	<meta property="og:type" content="fido_stream_test:phaser"/>
</head>
<body>
	<div id="fb-root"></div>
	<!-- Navbar
    ================================================== -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="/stream">Stram Test</a>
				<div class="nav-collapse collapse">
						<ul class="nav">
						<?php if($app->isLoggedIn() == FALSE) : ?>
							<li class="">
								<a href="#" id="log_in">Login</a>
							</li>
						<?php elseif($me !== FALSE) : ?>
							<li class="">
								<a href="<?php echo $me['link']; ?>" target="_blank"><img src="https://graph.facebook.com/<?php echo $me['id']; ?>/picture" width="20" height="20" /> <?php echo $me['name'] ?></a>
							</li>
							<li>
								<a href="#" id="log_out">Log Out</a>
							</li>
						<?php else : ?>
							<li class="">
								<a href="#" id="log_in">Login</a>
							</li>
						<?php endif; ?>
						</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="container">
		<?php if($app->isLoggedIn() == FALSE) : ?>
		<p>Log in to fire</p>
		<?php else: ?>
		<a class="btn" id="publish" href="http://secure.digitalsurgeons.com/stream/phaser.php">Fire Phaser</a>
		<?php endif; ?>
	</div>
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>