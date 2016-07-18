<?php
class Login {

	public $username = false;
	private $password = false;
	public $logged_in = false;
	public $last_login = false;

	function __construct($username, $password=null) {
		$this->username = $username;
		$this->password = $password;
		$this->ad_login();
		
	}

	function ad_login() {
		$cranleigh_options = array(
			"account_suffix" => "@cranleigh.org",
			"domain_controllers" => array(
				"csdc01.cranleigh.org",
				"csdc02.cranleigh.org",
				"csdc03.cranleigh.org",
			),
			"base_dn" => "DC=cranleigh,DC=org"
		);

		if ($this->username && $this->password):
				$provider = new \Adldap\Connections\Provider($cranleigh_options);
				$ad = new \Adldap\Adldap();
				$ad->addProvider('default', $provider);
								
			try {
				if ($provider->auth()->attempt($this->username, $this->password)) {
					// Now I've authenticated, lets destroy the Password
					$this->password = false;
					
					$this->logged_in = true;
					$this->last_login = time();
					$_SESSION['user']['logged_in'] = true;
					$_SESSION['user']['username'] = $this->username;
					$_SESSION['user']['OU'] = false;
					$_SESSION['user']['last_login'] = time();
					
									
				} else {
					// fail
					
				
				}
			} catch (\Adldap\Exceptions\Auth\UsernameRequiredException $e) {
				// The user didn't supply a username.
				echo "User didn't supply a username";
			} catch (\Adldap\Exceptions\Auth\PasswordRequiredException $e) {
				// The user didn't supply a password.
				echo "User didn't supply a password";
			}

		endif;
	}
	function __destruct() {
		
	}

}


