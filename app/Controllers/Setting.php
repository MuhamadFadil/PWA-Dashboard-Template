<?php

namespace App\Controllers;

require APPPATH . 'Views/push/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

use App\Models\PushModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;
use Illuminate\Http\Request;

class Setting extends BaseController
{
    protected $pushModel;
    
    function __construct()
    {
        $this->db = db_connect();
        $this->pushModel = new PushModel();
    }
    
    public function index()
    {

        if (!Users::check()) {
            return redirect()->to('/login');
        }
        if (!in_array($_SESSION['DATA_SESSION']['role'], array('Admin'))) {
			//return redirect()->to('dashboard' & 'settingClient');
		}
        
        
        $dt = new PushModel(); 
	  
	    $data = [
	        'tampil' => $dt->tampil()->getResult()
	        ]; 
	    
	    echo view("setting", $data);
        //return view("setting.php");
    }
    
    public function simpanData(){
        session_start();
// 		$_SESSION['DATA_SESSION']['id'];

		$data=[
			//'id_users'=>$this->request->getPost('341'),
			'endpoints' =>$this->request->getPost('endpoint'),
			'p256dh' =>$this->request->getPost('p256dh'), 
			'auth' =>$this->request->getPost('auth')
	        ];
	        
	         $dt = new PushModel(); 
	         
	         $simpan = $dt->simpan($data);
	         
	         if($simpan){
	             return redirect()->to('/setting/index'); 
	         }
	}
	
	public function client(){
		$dt = new PushModel(); 
	  
	    $data = [
	        'tampil' => $dt->tampil()->getResult()
	        ]; 
	    
	    echo view("settingClient", $data);

	}
	
	public function hapus(){
		$uri = service('uri'); 
	    $id_subs = $uri->getSegment('3'); 
	    
	    $dt = new PushModel(); 
	    
	    $dt->hapus($id_subs); 
	    
	    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
	    
	    return redirect()->to('/setting/index'); 

	}
	
	public function sendPushMessage() {
	   session_start();
	   $dt = new PushNotif(); 
	   $simpan =$dt->kirimdata(); 
	}

}
