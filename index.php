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
<?php /*
<script>
$(function() {
	var _debug = true;

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '341857635901143', // App ID
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true,  // parse XFBML
			fileUpload : true
		});

		$('#log_in').click(function(e) {
			e.preventDefault();

			FB.login(function(response) {
				if (response.authResponse) {
					//Logged in
					if(_debug) { console.log('logged in'); }
					if(typeof next === 'function') {
						next(USER_AUTH_PERM);
					}
				} else {
					//User cancelled login or did not fully authorize.
					if(_debug) { console.log("not logged in or didn't authorize"); }
					if(typeof next === 'function') {
						next(USER_NO_AUTH);
					}
				}
			}, {scope:'publish_stream'});

		});

		$('#publish').click(function(e) {
			e.preventDefault();

			var media = {"media": [
			    { 
			        "type": "image", 
			        "src": "http://secure.digitalsurgeons.com/stream/red.jpg", 
			        "href": "http://red.coach.com/",
			        description: "ths is my description",
			        name: 'taggd red'
			    }]
			}

			FB.api(
		        '/me/photos',
		        'POST',
		        {image:'http://secure.digitalsurgeons.com/stream/red.jpg', message:'this is totally my message'},
		        function(response) {
		           	if (!response || response.error) {
		              	//alert('Error occured');
		              	if(_debug) { console.log(response.error); }
			            if(typeof next === 'function') {
							next(true, null);
						}
		           	} else {
		            	if(_debug) { console.log('shared'); }
		            	//Change views here
	              		if(typeof next === 'function') {
							next(false, response.id);
				   		}
		           }
		    	}
		    );

			// FB.api(
			// 	{
			// 		method: 'stream.publish',
			// 		name: 'My Published Stream',
			// 		description: 'This is what im posting',
			// 		caption: 'Image caption',
			// 		attachment: media,
			// 		message: 'yay this is working?'
			// 	},
			// 	function(response) {
			//     	console.log(response);
			//    	}
			// );

			// FB.api(
			// 	{
			// 		method: 'photos.upload',
			// 		name: 'My Published Stream',
			// 		description: 'This is what im posting',
			// 		caption: 'Image caption',
			// 		attachment: media,
			// 		message: 'yay this is working?',
			// 		source: 'http://secure.digitalsurgeons.com/stream/red.jpg'
			// 	},
			// 	function(response) {
			//     	console.log(response);
			//    	}
			// );
		});

		


	}
});
// Load the SDK Asynchronously
	(function(d){
		var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
		js = d.createElement('script'); js.id = id; js.async = true;
		js.src = "//connect.facebook.net/en_US/all.js";
		d.getElementsByTagName('head')[0].appendChild(js);
	}(document));
</script>
*/ ?>
</body>
</html>