<?php

class Auth {

	private $_siteKey;
	
	public function __construct() {
		// sitekey used for salting, do not change after site deployment or current accounts will break
		$this->_siteKey = 'fgjnvTPGa9IUfXyzYFBwoDlYChc7vTQuasP1OWMjZp68XNlVZR';
		$this->database = new Database();
	}
	
	private function randomString($length = 50) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';
		
		for ($p = 0; $p < 50; $p++) {
			$string .= $characters[mt_rand(0, (strlen($characters)-1))];
		}
		
		return $string;
	}
	
	protected function hashData($data) {
		return hash_hmac('sha512', $data, $this->_siteKey);
	}
	
	public function isAdmin() {
		// $selection being the array of the row returned by the database
		if ($selection['is_admin'] == 1) {
			return true;
		}
		return false;
	}
	
	public function createUser($email, $password, $is_admin = 0) {
		// generate users salt
		$user_salt = $this->randomString();
		
		// salt and hash the password
		$password = $user_salt . $password;
		$password = $this->hashData($password);
		
		// create verification code
		$code = $this->randomString();
		
		// commit values to database
		$this->database->query('INSERT INTO users (email, password, user_salt, is_verified, is_active, is_admin, verification_code) VALUES (:email, :password, :user_salt, :is_verified, :is_active, :is_admin, :verification_code)');
		$this->database->bind(':email', $email);
		$this->database->bind(':password', $password);
		$this->database->bind(':user_salt', $user_salt);
		$this->database->bind(':is_verified', '1'); // set 0 to enable verification by email
		$this->database->bind(':is_active', '1');
		$this->database->bind(':is_admin', $is_admin);
		$this->database->bind(':verification_code', $code);		
		$created = $this->database->execute();

		// if user was created correctly
		if ($created != false) {
			return true;
		}
		
		// ADD SENDVERIFICATION() METHOD and call it here to send an email to users with the verification code in
		
		return false;
	}
	
	public function login($email, $password) {
		// select users row from database based on $email
		$this->database->query('SELECT id, password, user_salt, is_verified, is_active, is_admin FROM users WHERE email = :email');
		$this->database->bind(':email', $email);
		$selection = $this->database->single();
		
		// salt and hash password for checking
		$password = $selection['user_salt'] . $password;
		$password = $this->hashData($password);
		
		// check email and password hash match database row
		if (($selection) && ($selection['password'] == $password)) {
			$match = true;
		} else {
			$match = false;
		}
		
		// convert to boolean
		$is_active = (boolean) $selection['is_active'];
		$verified = (boolean) $selection['is_verified'];
		
		if ($match == true) {
			if ($is_active == true) {
				if ($verified == true) {
					// email/password combination exists - set sessions
					$random = $this->randomString();
					// build the token
					$token = $_SERVER['HTTP_USER_AGENT'] . $random;
					$token = $this->hashData($token);
					
					// setup sessions vars
					session_start();
					$_SESSION['token'] = $token;
					$_SESSION['user_id'] = $selection['id'];
					
					// delete old logged_in_member records for user
					$this->database->query('DELETE FROM logged_in_member WHERE user_id = :user_id');
					$this->database->bind(':user_id', $selection['id']);
					$this->database->execute();
					
					// insert new logged_in_member records for user
					$this->database->query('INSERT INTO logged_in_member (user_id, session_id, token) VALUES (:user_id, :session_id, :token)');
					$this->database->bind(':user_id', $selection['id']);
					$this->database->bind(':session_id', session_id());
					$this->database->bind(':token', $token);
					$inserted = $this->database->execute();
					
					// logged in
					if ($inserted != false) {
						return 0;
					}
					return 3;
				} else {
					// not verified
					return 1;
				}
			} else {
				// not active
				return 2;
			}
		}
		
		// email+password combo do not match database, reject
		return 4;
		
	}
	
	public function checkSession() {
		// select the row
		$this->database->query('SELECT session_id, token FROM logged_in_member WHERE user_id = :user_id');
		$this->database->bind(':user_id', $_SESSION['user_id']);
		$selection = $this->database->single();
		
		if ($selection) {
			// check id and token
			if ((session_id() == $selection['session_id']) && ($_SESSION['token'] == $selection['token'])) {
				// id and token match, refresh the session for the next request
				$this->refreshSession();
				return true;
			}
		}
		return false;
	}
	
	private function refreshSession() {
		// regenerate id
		session_regenerate_id();
		
		// regenerate token
		$random = $this->randomString();
		// build the token
		$token = $_SERVER['HTTP_USER_AGENT'] . $random;
		$token = $this->hashData($token);
		
		// store in session
		$_SESSION['token'] = $token;
	}
	
	public function logout() {
		// remove user from logged in table
		$this->database->query('DELETE FROM logged_in_member WHERE user_id = :user_id');
		$this->database->bind(':user_id', $_SESSION['user_id']);
		$this->database->execute();
		
		session_destroy();
	}
	
}

?>