<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table = 'news';
	public function login($data)
	{
		$db = \Config\Database::connect();
		$username = $data['username'];
		$password = md5($data['password']);
		$dologin = $db->query("select * from users where email = '$username' and password = '$password' and status = 'Active'");
		//echo '<pre>';echo "select * from users where (username = '$username' or email = '$username') and password = '$password'";print_r($dologin);die();
		return $dologin;
	}
	public function register($data)
	{
		$db = \Config\Database::connect();
		$username = $data['username'];
		$password = md5($data['password']);
		$email = $data['email'];
		$nama = $data['name'];
		echo $nama;
		echo $username;
		echo $email;
		echo $password;
		die();
		$sql = "INSERT INTO users (name, email, password) VALUES (".$db->escape($nama).", ".$db->escape($email).", ".$db->escape($password).")";
$db->query($sql);
echo $db->affectedRows();
			//$dologin = $db->query("INSERT INTO users(name, username, email, password) VALUES ('$nama', '$username','$email','$password')");
		
		//echo '<pre>';echo "select * from users where (username = '$username' or email = '$username') and password = '$password'";print_r($dologin);die();

		return $sql;
	}
}
