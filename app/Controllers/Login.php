<?php

namespace App\Controllers;

use App\Models\UsersModel;
// use CodeIgniter\HTTP\RequestInterface;
// use CodeIgniter\Controller;
use App\Libraries\Mathcaptcha;

class Login extends BaseController{
	public function index(){
		$tmp = Users::check();
		if($tmp==1){ return redirect()->to('dashboard'); }
		
    // Users::check();
		// if($_SESSION['DATA_SESSION']['login']){ return redirect()->to('dashboard'); }
		// if(isset($_SESSION['DATA_SESSION'])){ return redirect()->to('dashboard'); }

		$request = \Config\Services::request();
		$username = $request->getVar('username');
		$password = $request->getVar('password');
		$captcha = $request->getVar('date');
		$mcaptcha = new Mathcaptcha();
		$mcaptcha->init();

		$output = [];
		if ($username == "" && $password == "" && $captcha == "") {
			if (isset($_SESSION['err'])) {
				$output['err'] = $_SESSION['err'];
				$_SESSION['err'] = "";
			}
			$output['question'] = $mcaptcha->get_question();
		} else {

			if ($captcha != $_SESSION['mathcaptcha_answer']) {

				$output['err'] = "wrong captcha!";
				$output['question'] = $mcaptcha->get_question();
			} else {
				if ($username == "" || $password == "") {
					$output['err'] = 'Enter Username / Password';
					$output['question'] = $mcaptcha->get_question();
				} else {

					$login = [
						'username'  => $username,
						'password' => $password,
					];

					$model = new UsersModel();
					$dologin = $model->login($login);

					$logged_in = $dologin->getRow();
					if (isset($logged_in)) {
						$data_session = [
							'name' => $logged_in->name,
							'id' => $logged_in->id,
							'role' => $logged_in->role,
							'email' => $logged_in->email,
							'photo' => $logged_in->photo,

							'kota' => $logged_in->kota,

							'login' => true
						];
						$_SESSION['LAST_ACTIVITY'] = time();
						$_SESSION['DATA_SESSION'] = $data_session;

						$db = \Config\Database::connect();

						$builder = $db->table('users');
						$builder->set('last_login', date('Y-m-d H:i:s'));
						$builder->where('id', $logged_in->id);
						$builder->update(); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
						// $_SESSION['DATA_SESSION']['session'] = substr(sha1(rand()), 0, 30);
						// $builder->set('session', $_SESSION['DATA_SESSION']['session']);
						// $builder->where('id', $logged_in->id);
						// $builder->update(); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2

						if ($logged_in->status == 'Blocked') {
							// die('You are not allowed to access this system.');
							// }elseif($logged_in->status != ''){ //jika status tidak aktif, ke form aktivasi akun
							return redirect()->to('login/activate');
						} elseif ($logged_in->status == '') {
							$output['question'] = $mcaptcha->get_question();
							$output['err'] = 'Your account is inactive. Please click the activation link that was sent to your email. <br><br><a href="' . base_url('login/activate') . '">Click here</a> if you need a new activation link.';
						} else {
							//$this->session->set_flashdata('success', 'Your session is now active.');
							return redirect()->to('dashboard');
						}
					} else {
						//else{ die($dologin->num_rows().'Database error. Please contact administrator.'); }
						$output['err'] = 'Wrong Email / Password';
						$output['question'] = $mcaptcha->get_question();
					}
				}
			}
		}

		echo view("login", $output);
	}

	public function activate($key = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$db = \Config\Database::connect();
		$request = \Config\Services::request();
		$resend = $request->getVar('resend');
		if ($resend == "1") {
			$email = $_SESSION['DATA_SESSION']['email'];
			$r = $db->query("select id from users where email = '$email'")->getRow()->id;
			if (isset($r->id)) {
				$reset_key = substr(sha1(rand()), 0, 30);
				$t = "Someone has used your email to create an account on <b>ABCD</b> or <b>PSB CCIT</b>. Please click the link below to activate the account. This link will remain active 24 hours from now.<br><br>" .
					"If you did not create an account, please ignore this email.<br><br>" .
					site_url("Login/activate/") . $reset_key .
					"<br><br>Regards,<br>ABCD Bot<br /><br><br>";
				$db->query("INSERT INTO activate_account (user,reset_pass_key,expiration) VALUES (" . $r->id . ", '$reset_key', '" . date('Y-m-d H:i:s', time() + (60 * 60 * 24)) . "');");

				$emaildata = [
					'to' => $email,
					'subject' => "User Account Password Reset",
					'body' => $t,
					'time' => date('Y-m-d H:i:s'),
				];
				//mail($email,"User Account Creation",$t);
				$db->table('sendmail_log')->insert($emaildata);
			}
		}
		if ($key != "") {
			$r = $db->query("select * from activate_account where reset_pass_key = '$key' and expiration > CURDATE() and used = 0")->getRow();
			// if(count($r)!=1){
			if (!isset($r->id)) {
				//$this->session->set_flashdata('error', 'Key invalid or expired.');
				return redirect()->to('login');
			}
			$db->query("UPDATE activate_account SET used = 1 WHERE id = " . $r->id);
			$db->query("UPDATE users SET status = 'Active' WHERE id = " . $r->user);
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			$_SESSION['err'] = "Your account has been activated";
			return redirect()->to('login');
		} else {
			$data = [];
			return view("activate", $data);
		}
	}

	public function forgot($key = ""){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$db = \Config\Database::connect();
		$request = \Config\Services::request();
		$email = $request->getVar('email');
		$captcha = $request->getVar('date');
		$mcaptcha = new Mathcaptcha();
		$mcaptcha->init();
		if ($email == ""  && $captcha == "") {
			$output['question'] = $mcaptcha->get_question();
		} else {
			if ($captcha != $_SESSION['mathcaptcha_answer']) {

				$output['err'] = "wrong captcha!";
				$output['question'] = $mcaptcha->get_question();
			} else {
				$output['err'] = "Thank you. If the email is associated with an active account in our system, you will receive an email to reset your password.	";
				$output['question'] = $mcaptcha->get_question();

				$r = $db->query("select id from users where email = '$email'")->getRow();
				if (isset($r->id)) {
					$reset_key = substr(sha1(rand()), 0, 30);
					$t = "Someone requested to reset the password for an account associated with this email. Please follow this link to reset your password at <b>".APPNAME."</b>. This link will remain active 24 hours from now.<br><br>" .
						"If you do not want to reset your password, please ignore this email.<br><br>" .
						site_url("Login/confirm/") . $reset_key .
						"<br><br>Regards,<br>".APPNAME." Bot<br /><br><br>";
					$db->query("INSERT INTO reset_account (user,reset_pass_key,expiration) VALUES (" . $r->id . ", '$reset_key', '" . date('Y-m-d H:i:s', time() + (60 * 60 * 24)) . "');");

					$emaildata = [
						'to' => $email,
						'subject' => "[".APPNAME."] Password Reset",
						'body' => $t,
						'time' => date('Y-m-d H:i:s'),
					];
					//mail($email,"User Account Password Reset",$t);
					$db->table('sendmail_log')->insert($emaildata);
				}
			}
		}
		return view("forgot", $output);
	}
	public function confirm($key = "") // http://localhost.sc/Login/confirm/e5c293fc7f67c737fed6d1ffceeed6
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$db = \Config\Database::connect();
		$request = \Config\Services::request();
		$password = $request->getVar('password');
		$password2 = $request->getVar('password2');
		$builder = $db->table('users');
		$captcha = $request->getVar('date');
		$mcaptcha = new Mathcaptcha();
		$mcaptcha->init();
		$output = [];
		if ($password == "" && $password2 == ""  && $captcha == "") {
			$r = $db->query("select * from reset_account where reset_pass_key = '$key' and expiration > CURDATE() and used = 0")->getRow();
			if (!isset($r->id)) {
				//$this->session->set_flashdata('error', 'Key invalid or expired.');
				return redirect()->to('login');
			}
			$output['question'] = $mcaptcha->get_question();
			$_SESSION['reset_id'] = $r->user;
		} else {
			if ($captcha != $_SESSION['mathcaptcha_answer']) {

				$output['err'] = "wrong captcha!";
				$output['question'] = $mcaptcha->get_question();
			} else {
				if ($password == $password2) {
					$builder->set('password', md5($password));
					$builder->where('id', $_SESSION['reset_id']);
					$builder->update(); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
					$db->query("UPDATE reset_account SET used = 1 WHERE user = " . $_SESSION['reset_id']);
					unset($_SESSION['reset_id']);
					$_SESSION['err'] = "Your account password has been changed";
					return redirect()->to('login');
				} else {
					$output['err'] = "Password does not match";
					$output['question'] = $mcaptcha->get_question();
				}
			}
		}
		return view("reset_password", $output);
	}
	public function test()
	{
		$contents = file_get_contents("assets/provinsi.json");
		$contents = utf8_encode($contents);
		$results = json_decode($contents, true);
		print_r($results["Aceh Barat"]);
		$db = \Config\Database::connect();
		$wow = "Aceh Barat";
		$builder = $db->table('users');
		$builder->set('provinsi', $results[$wow]);
		$builder->where('id', 3);
		$builder->update(); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2

		$table_name = "users";
		$column_name = "tempat_lahir";
		$wow =  $db->query('SHOW COLUMNS FROM ' . $table_name . ' WHERE field="' . $column_name . '"');
		$cnt = 0;
		echo "<select>";
		foreach ($wow->getRow() as $row) {
			print_r($row);
			if ($cnt == 1) {
				foreach (explode("','", substr($row, 6, -2)) as $option) {
					print("<option>$option</option>");
				}
			}
			$cnt = $cnt + 1;
		}
		echo "</select>";
	}
	public function test2()
	{
		echo view("test");
	}
}
