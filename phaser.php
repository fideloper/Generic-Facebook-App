<?php
/* Init app */
require_once('app.php');
$app = new App();
?><!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# fido_stream_test: http://ogp.me/ns/fb/fido_stream_test#">
	<title>Stream Test</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<meta property="og:title" content="Fire Phaser"/>
	<meta property="og:site_name" content="Stram Test"/>
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="<?php echo $app->getAppId()	; ?>" />
	<meta property="og:url" content="http://secure.digitalsurgeons.com/stream/phaser.php"/>
	<meta property="og:image" content="http://secure.digitalsurgeons.com/stream/phaser-st4.jpg"/>
	<meta property="og:type" content="fido_stream_test:phaser"/>
	<meta property="og:description" content="A standard issue phaser"/>
</head>
<body>
<img src="phaser-st4.jpg" alt="" />
</body>