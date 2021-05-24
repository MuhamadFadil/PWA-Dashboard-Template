<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
	public function index()
	{
		if(!Users::check()){
				return redirect()->to('login');
		}
		if ($_SESSION['DATA_SESSION']['role'] == "Admin") {
			return redirect()->to('users/users_management');
		}
		return view("dashboard");
		

	}
}
