<?php

namespace App\Controllers;
use App\Models\PushNotif;
use App\Libraries\GroceryCrud;
//web push
require APPPATH . 'Views/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class Setting extends BaseController
{
	protected $shareModel;
    function __construct(){
        $this-> db = db_connect(); 
        $this->shareModel = new PushNotif();
    }

	public function index()
	{
		if (!Users::check()) {
			return redirect()->to('login');
		}

		$dt = new PushNotif(); 
	  
	    $data = [
	        'tampil' => $dt->tampil()->getResult()
	        ]; 
	    
	    echo view("setting", $data);

		//return view('setting');
	}

	public function simpanData(){

		$data=[
			// 'id_user'=>$this->request->getPost('id'),
			'endpoints' =>$this->request->getPost('endpoint'),
			'p256dh' =>$this->request->getPost('p256dh'), 
			'auth' =>$this->request->getPost('auth')
	        ];
	        
	         $dt = new PushNotif(); 
	         
	         $simpan = $dt->simpan($data);
	         
	         if($simpan){
	             return redirect()->to('/setting/index'); 
	         }
	}

	public function hapus(){
		$uri = service('uri'); 
	    $id_subs = $uri->getSegment('3'); 
	    
	    $dt = new PushNotif(); 
	    
	    $dt->hapusdata($id_subs); 
	    
	    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
	    
	    return redirect()->to(base_url('/setting/index'))->with('status','Data berhasil terhapus'); 

	}

	public function sendAll(){
		$session = \Config\Services::session();

		// session_start();
		require_once "connected.php";
		// $this-> db = db_connect();

		$sql = "SELECT *FROM subscribers";
		$result = mysqli_query($link, $sql);
		$subscriptions = [];

		while($kol = mysqli_fetch_array($result))
		{
			// $endpoints = [
			//     "endpoint" => $row['endpoints'],
			//     "expirationTime" => null,
			//     "keys" => [
			//         "p256dh" => $row['p256dh'],
			//         "auth" => $row['auth']
			//         ],
			// ];
			// $endpoints = '{"id_user":"'.$row['id_user'] . '"name_user":"'.$row['name_user'] .'"kota_user":"'.$row['kota_user'] . '"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
			// $endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
			$endpoints = '{"endpoint":"'. $kol['endpoints'] .'","expirationTime":null,"keys":{"p256dh":"' . $kol['p256dh'] . '","auth":"' . $kol['auth'] . '"}}';
			$subscriptions[] = Subscription::create(json_decode($endpoints, true));
		}

		$payload = 'Pasti Bisa Nyook!';

		// $publickey = 'BOE99lvdjCbHi6nI17XW76tG_X4lzuZYo3cPfwhqdcSSMKcyMNVcpnT3VbNkUBtoZuuul5NX3Xh3S7vTa0eGt0U',
		// $privatekey = 'ufRraaod9VVDblESL-oabmV0SsOXFxm03bIr-kK7Aq8'

		$auth = [
			'VAPID' => [
				'subject' => 'https://fadil.website', // can be a mailto: or your website address
				'publicKey' => 'BOE99lvdjCbHi6nI17XW76tG_X4lzuZYo3cPfwhqdcSSMKcyMNVcpnT3VbNkUBtoZuuul5NX3Xh3S7vTa0eGt0U', // (recommended) uncompressed public key P-256 encoded in Base64-URL
				'privateKey' => 'ufRraaod9VVDblESL-oabmV0SsOXFxm03bIr-kK7Aq8', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
			],
		];

		$webPush = new WebPush($auth);

		// Send to one Endpoint
		// $res = $webPush->sendOneNotification($subscription, $payload, ['TTL' => 5000]);

		//Send to multiple Endpoints
		foreach ($subscriptions as $sub)
		{
			$res = $webPush->queueNotification($sub, $payload, ['TTL' => 5000]);
			// $res = $webPush->sendOneNotification($sub, $payload, ['TTL' => 5000]);

		}

		foreach ($webPush->flush() as $report) {
			$endpoint = $report->getRequest()->getUri()->__toString();

			if ($report->isSuccess()) {
				//$_SESSION['berhasil'] = 'Sukses Terikirim';
				//$session = session();
				//$session->markAsFlashdata('berhasil');
				
				$session->setFlashdata('berhasil', 'Terkirim');
				echo "[v] Pesan sukses terkirim ke subscription {$endpoint}. <br>";
				// return redirect()->to(base_url('/setting/index'))->with('status', 'Pesan berhasil dikirim');
			} else {
				//$_SESSION['gagal'] = 'Gagal Terikirim';
				//$session = session();
				
				$session->setFlashdata('gagal', 'Gagal');
				echo "[x] Pesan tidak terkirim ke subscription {$endpoint}: {$report->getReason()}";
				// session()->setFlashdata('gagal', '[x] Pesan tidak terkirim ke subscription {$endpoint}: {$report->getReason()}');
				// return redirect()->to(base_url('/setting/index'))->with('status', 'Pesan gagal dikirim');
			}
		}
		// $data=[
		// 	//'id_users'=>$this->request->getPost('341'),
		// 	'endpoints' =>$this->request->getPost('endpoint'),
		// 	'p256dh' =>$this->request->getPost('p256dh'), 
		// 	'auth' =>$this->request->getPost('auth')
	    //     ];
	        
	    //      $dt = new PushNotif(); 
	         
	    //      $kirim = $dt->kirimdata($data);
	         
	    //      if($kirim){
	    //          return redirect()->to('/setting/index'); 
	    //      }
		
		// return redirect()->to('/setting/index'); 
	}

	public function broadcast(){
		// require APPPATH . 'views/vendor/autoload.php';

			//'id_users'=>$this->request->getPost('341'),
			// $data1 = 'endpoints' => $this->request->getWhre('endpoints');
			// $data2 = 'p256dh' => $this->request->getWhere('p256dh'); 
			// $data3 = 'auth' => $this->request->getWhere('auth'); 
	        

			//$data1 = 'endpoints'; 
			// $dt = new PushNotif(); 
		  
			// $ambil = $dt->ambildata($data1,$data2, $data3);
	         
			// if($ambil){
			// 	return redirect()->to('/setting/index'); 
	
				// $dt = new PushNotif(); 
				 
				// $kirimdata = $dt->kirimdata();
				 
				// if($kirimdata){
				// 	 return redirect()->to('/setting/index'); 
				//  }
		
	    
	    echo view("content/pushNotif");
	}

	public function custom(){
		//$data1 = 'endpoints'; 
		$dt = new PushNotif(); 
	  
	    $data = [
	        'data' => $dt->tampil()->getResult()
	        ]; 
	    
	    echo view("sendBroadcast", $data);
	}

	public function client(){
		session_start();
		$dt = new PushNotif(); 
	  
	    $data = [
	        'tampil' => $dt->tampil()->getResult()
	        ]; 
	    
	    echo view("settingClient", $data);

	}

	public function Status(){
		session_start();
		$data=[
			'Member_id'=>$this->request->getPost('id'),
			'status' =>$this->request->getPost('status')
	        ]; 
	         
		$dt = new PushNotif(); 
		$simpan = $dt->status($data);

		if($simpan){
			session()->setFlashdata('tersimpan', 'Berhasil Tersimpan'); 
			return redirect()->to('/setting/index'); 
		}else{
			session()->setFlashdata('gagal', 'Gagak Tersimpan');
		}

	}

}
