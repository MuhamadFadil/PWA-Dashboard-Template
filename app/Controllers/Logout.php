<?php
namespace App\Controllers;
class Logout extends BaseController{
	public function index(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['LAST_ACTIVITY'])) { // last request was more than 30 minutes ago
			session_unset();     // unset $_SESSION variable for the run-time 
			session_destroy();   // destroy session data in storage
		}
		return redirect()->to('login');
	}
}
