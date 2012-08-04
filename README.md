#Facebook Applications
###A Field Guide

####Sumary
**Creating an application (Canvas Page)**
	
1. Where's your iFrame
2. https / ssl
3. client-side code

**Open Graph: Actions and Objects**

1. Performing an action, sharing an object
2. User-generated images
3. Custom action approval and test users (http://developers.facebook.com/docs/opengraph/opengraph-approval/)
4. client-side code

**Facebook Tiles (Formerly tabs)**

1. Getting an app into a tile
2. Retrieving GET data
3. Client and server-side code
	
####Create an application
There was a time when you could build Facebook applications within Facebook. Now, however, Facebook applications are on your servers, and use code you write. This means a Facebook application is loading a web-page you host from within an iFrame.

Your first step to create a Facebook application is to [register it](https://developers.facebook.com/apps). When creating an application, there are many forms to fill out. This will **not** be a comprehensive guide.

**Register your app**

After following the link above, click the Create New App button. You'll be presented with a screen asking for the **name** of the app, and it's **namespace**. The namespace will be both the URL of the canvas app (more on that later) and referenced in code to perform actions with the Open Graph API (again, more on that later). 

![Register App](readme/001-register_app.png)

**Where's your iframe**

Once you've registered your app, you need to tell Facebook where to pull in your website. Facebook pulls in YOUR website via an iFrame for its application, so you just need to let facebook know where that lives.

![Register App](readme/002-iframe.png)

On the Basic app settings (Settings > Basic in left-hand navigation), there are two areas that need filling out.

1. Basic Info::App Domain
2. App Integration::Website with Facebook Login, App on Facebook, Mobile Web

The **App Domain** needs to be the base domain name of your server. If you're doing `myfancyapp.mydomain.com`, the App Domain is `mydomain.com`.

The **App Integration** is the exact URL of your website, for instance `myfancyapp.com/mydomain/canvas/`. Note that website need to end in a "directory" with a trailing slash "/". You can fill out all sections with the same URL.

**Https / SSL**

Note that the App on Facebook requres a secure URL ("**Secure Canvas Url**" and later "**Secure Page Tab Url**"). `This means that your website needs to support https`. It needs an SSl certificate. This is because many users now view Facebook via https. Your app will not work if it does not support it when a user is attempting to access content under https.

You should be able to load up your canvas app and see your site at `http://apps.facebook.com/your_app_namespace/`. *Note* that your app page must be setup to accept POST resquests to receive the `signed_request` POST variable sent to it. GET-only routes will fail. 

You can **also** pass your app GET requests via the Facebook URL. For example, `http://apps.facebook.com/your_app_namespace/?what=ever` will make GET 'what=ever' available to your application page.

The same is **NOT** true for Facebook Tile (tab) pages. There's a more complicated method for retrieving such data explained below.

**Client-side code**

Here are some code snippets to help you get setup, login, etc.

	//Called when FB object is loaded and ready
	window.fbAsyncInit = function() {
		FB.init({
	        appId      : '01234567890', // Your App ID
	        status     : true, // check login status
	        cookie     : true, // enable cookies to allow the server to access the session
	        xfbml      : true  // parse XFBML
	  	});

	  	//FB global object is available now


	  	/* Check if user is logged in and/or hasn't authorized app permissions */
	  	FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				// the user is logged in and has authenticated
				console.log('Ready to roll');
			} else if (response.status === 'not_authorized') {
				// the user is logged in to Facebook, but not authenticated
				console.log('Permissions revoked or not given');
			} else {
				// the user isn't logged in to Facebook.
				console.log('Not logged in');
			}
		});



	  	/* Log a user in */
	  	FB.login(function(response) {
			if (response.authResponse) {
				//Logged in
				console.log('logged in');
			} else {
				//User cancelled login or did not fully authorize.
				console.log('not authorized or not logged in');
			}
		}, {scope:'publish_actions'}); //Give us permission to post to users wall



	  	/* Check for changes in user status */
	  	FB.Event.subscribe('auth.statusChange', function(response) {
			if (response.authResponse) {
				// user has auth'd your app and is logged into Facebook
				console.log('ready to roll');
			} else {
				// user has not auth'd your app, or is not logged into Facebook
				console.log('not authorized or not logged in');
			}
		});

	}

	// Load the SDK Asynchronously
	(function(d){
	  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
	  js = d.createElement('script'); js.id = id; js.async = true;
	  js.src = "//connect.facebook.net/en_US/all.js";
	  d.getElementsByTagName('head')[0].appendChild(js);
	}(document));

####Open Graph: Doin' Stuff
We want our users to do stuff, and share that on their wall/timeline. In the Open Graph settings, you can define what a user is doing, and it can be anything.

Start by defining and Action and an Object. In our example, we're allowing people to `Eat` some `Bugs`.

![Register App](readme/003-action.png)
![Register App](readme/004-object.png)

After these **both** are created, you need to set them up further with some extra options. Click into your newly created Action (Eat).

1. Under the Name of the action (Eat), enter in the corresponding Object (Bugs) in the Connected Object Types field.
2. Scroll down to Configure Story Attachment and add in any captions or info you want to in included in the action when it is performed. If you click **advanced**, you can see/edit what the open graph action url will be (/me/apps_field_guide:eat).
3. Save that.

Now head to your Object type and click on it to edit (Bugs). Note you can make it an Object or a Place (location). 


# License:
Do whatever you want with this.
