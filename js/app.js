$(function() {
	function Canvas(debug) {
		var _this = this,
			USER_NO_AUTH = 0, //User not logged in
			USER_AUTH_PERM = 1, //User logged in and gave permissions
			USER_AUTH_NO_PERM = 2; //User logged in, has not given or revoked permissions;

		_debug = debug;

		/**
		*	Called first. Loads Facebook SDK library.
		*/
		this.init = function() {
			// Load the SDK Asynchronously
		    (function(d){
		      var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
		      js = d.createElement('script'); js.id = id; js.async = true;
		      js.src = "https://connect.facebook.net/en_US/all.js";
		      d.getElementsByTagName('head')[0].appendChild(js);
		    }(document));
		}

		/**
		*	LOGICS HERE
		*/
		this.fbReady = function() {
			FB.init({
				appId      : '341857635901143', // App ID
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
			});
			if(_debug === true) {
				console.log('init ready');
			}

			$('#log_in').click(function(e) {
				e.preventDefault();

				_this.fbLogin(function(resp) {
					if(resp === USER_AUTH_PERM) {
						window.location.reload();
					}
				});
			});

			$('#log_out').click(function(e) {
				e.preventDefault();

				_this.fbLogout(function(resp) {
					window.location.reload();
				});
			});

			$('#publish').click(function(e) {
				e.preventDefault();
				
				var href = $(this).attr('href');

				_this.fbPublish(href, function(err, resp) {
					if(_debug) {
						if(err === false) { 
							console.log('shared'); 
						} else {
							console.log('not shared');
						}
					}

				});
			});
		}

		/**
		* 	Login and authorize user
		*/
		this.fbLogin = function(next) {
			if(_debug) { console.log("Firing login"); }
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
			}, {scope:'publish_actions'});
		}

		this.fbLogout = function(next) {
			FB.logout(function(response) {
		  		if(_debug) { console.log("User logged out"); }
		  		if(typeof next === 'function') {
					next(response);
				}
			});
		}

		this.fbPublish = function(url, next) {
			FB.api(
		        '/me/fido_stream_test:fire',
		        'POST',
		        {phaser: url},
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
		}

	}

	/**
	* 	Fire!
	*/
	var canvas = new Canvas(true);
	window.fbAsyncInit = canvas.fbReady;
	canvas.init();
});