<?php

require_once 'fb/src/facebook.php';

class App {

	private $facebook;
	private $isLogged;
	private $user;

	const APP_ID = '341857635901143';
	const APP_SECRET = '29dfc9d5e8836ad60a6248e1f02179a8';

	public function __construct() {
		$this->facebook = new Facebook(array(
		  'appId'  => self::APP_ID,
		  'secret' => self::APP_SECRET,
		  'fileUpload' => TRUE
		));
	}

	public function isLoggedIn() {
		if($this->isLogged !== NULL) {
			return $this->isLogged;
		}

		$user = $this->facebook->getUser();

		if($user == FALSE) {
			$this->isLogged = FALSE;
		} else {
			$this->isLogged = TRUE;
		}

		return $this->isLogged;
	}

	public function getFacebook() {
		return $this->facebook;
	}

	public function getColor() {
		if(isset($_GET['color']) === FALSE) {
			return FALSE;
		}
		return trim(strip_tags($_GET['color']));
	}

	public function getUser() {
		if($this->user !== NULL) {
			return $this->user;
		}
		try {
			$this->user = $this->facebook->api('/me');
			return $this->user;
		} catch(FacebookApiException $e) {
			return FALSE;
		}
	}

	public function getAppId() {
		return self::APP_ID;
	}

}