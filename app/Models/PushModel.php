<?php

namespace App\Models;

use CodeIgniter\Model;


require APPPATH . 'Views/push/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;



class PushModel extends Model
{

    function __construct()
    {
        $this->db = db_connect();
    }
    protected $table = "subscribers";


    public function getData($id_subs = false)
    {
        if ($id_subs == false) {
            return $this->findAll();
        }

        return $this->where(['id_subs' => $id_subs])->first();
    }

    function tampil()
    {
        return $this->db->table('subscribers')->get();
    }
    
    function getIdUser($id_user){
        return $this->where(['id_subs'=>$id_user])->first(); 
        
    }

    function simpan($data)
    {
        //require APPPATH . 'views/vendor/autoload.php';
        //making current id for id_users value
        // $id_user = getIdUser($data); 
        $id_user = $_SESSION['DATA_SESSION']['id'];
        $name_user = $_SESSION['DATA_SESSION']['name'];
        $kota_user = $_SESSION['DATA_SESSION']['kota'];

        $_POST = json_decode(file_get_contents('php://input'), true);


        $endpoint =$_POST['endpoint'];
        $key = $_POST['key'];
        $auth = $_POST['token'];
        $key_len = strlen($key);
        $auth_len = strlen($auth);
        $key = substr($key, 0, ($key_len - 1));     //hapus sama dengan ("=") di akhir string
        $auth = substr($auth, 0, ($auth_len - 2));  //hapus sama dengan ("==") di akhir string

        //mengubah / menjadi _
        $key = str_replace('/', '_',$key);
        $key = str_replace('+', '-',$key);
        
        //mengubah + menjadi -
        $auth = str_replace('+', '-', $auth);
        $auth = str_replace('/', '_', $auth);

        if (isset($_POST['axn']) && $_POST['axn'] != NULL) {
            $output = '';
            switch ($_POST['axn']) {
                case "subscribe":
                    //tb_subscribers

                    $sql = "INSERT INTO subscribers (id_user, name_user,kota_user, endpoints, p256dh, auth) VALUES ('$id_user','$name_user','$kota_user','$endpoint', '$key', '$auth')";
					$this->query($sql);
                    break;

                case "unsubscribe":
                    $sql = "DELETE FROM subscribers WHERE endpoints = '$endpoint'";
					$this->query($sql);
                    break;

                default:
            }
            exit;
        }
	    
        return $this->db->table('subscribers')->insert($data);
    }
    
    function hapus($id_subs){
        return $this->db->table('subscribers')->delete(['id_subs'=>$id_subs]); 
    }
    
    // function kirimdata($endpoint,$p256dh,$auth)
    function kirimdata()
    {
	    $id_user = $_SESSION['DATA_SESSION']['id'];   
        // DICOBA KIRIM SATU-SATU SAJA, TIDAK MENGGUNAKAN ARRAY//
        
        //Konek ke database
	    require_once "connected.php";
        
        $sql = "select tb.id_user, tb.endpoints, tb.p256dh, tb.auth from tb_subscribers as tb inner join users as u on tb.id_user = u.id where tb.id_user = u.id"; 
        // $sql = "SELECT * FROM tb_subscribers where id_user = $id_user";
        // echo $id; 
        echo $sql; 
        $result = mysqli_query($link, $sql)  or die(mysql_error());
		$subscriptions = [];
		
        while($row = mysqli_fetch_assoc($result))
		{
			$endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
			$subscriptions[] = Subscription::create(json_decode($endpoints, true));
		}
		
		$payload = 'Selamat Datang, di aplikasi web PWA!';
		
		$auth = [
		    'VAPID' => [
		        'subject' => 'http://localhost:8080/', // can be a mailto: or your website address
		        'publicKey' => 'BOE99lvdjCbHi6nI17XW76tG_X4lzuZYo3cPfwhqdcSSMKcyMNVcpnT3VbNkUBtoZuuul5NX3Xh3S7vTa0eGt0U
', // (recommended) uncompressed public key P-256 encoded in Base64-URL
		        'privateKey' => 'ufRraaod9VVDblESL-oabmV0SsOXFxm03bIr-kK7Aq8', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
		    ],
		];
		
		$webPush = new WebPush($auth);

		// Send to one Endpoint
		//$res = $webPush->sendNotification($subscriptions[$endpoints], $payload, ['TTL' => 5000]);
		
		//Send to multiple Endpoints
		foreach ($subscriptions as $sub)
		{
			//$res = $webPush->queueNotification($sub, $payload, ['TTL' => 5000]);
			$res = $webPush->sendOneNotification($sub, $payload, ['TTL' => 5000]);
		
		}
		
		foreach ($webPush->flush() as $report) {
			$endpoint = $report->getRequest()->getUri()->__toString();
		
			if ($report->isSuccess()) {
				echo "[v] Message sent successfully for subscription {$endpoint}. <br>";
				// echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			} else {
				echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
				// echo "<script type='text/javascript'>alert('failed!')</script>";
			}
		}
        
        //  $this->db->table('tb_subscribers')->getWhere(['p256dh', 'auth']);
        

    }
    
    function test (){
        
        // 		$res = $webPush->sendNotification(
        // 		    $subscriptions[$endpoints], 
        // 		    "Hello", 
        // 		    str_replace(['_', '-'], ['/', '+'],$subscriptions['p256dh']),
        // 		    str_replace(['_', '-'], ['/', '+'],$subscriptions['auth']), 
        // 		    true
        // 		    ); 
        // 		var_dump($res); 
        
        //notif
            // string $endpoint,
            // ?string $publicKey = null,
            // ?string $authToken = null,
            // ?string $contentEncoding = null
        
        
        return $this->db->table('tb_subscribers')->getData(['id'=>$id_subs]);
    }
    
    function test3 ()
    {
        // session_start();
	   // $id_user = $_SESSION['DATA_SESSION']['id'];   
        // DICOBA KIRIM SATU-SATU SAJA, TIDAK MENGGUNAKAN ARRAY//
        
        //Konek ke database
	    require_once "connected.php";
        
        $sql = "SELECT * FROM tb_subscribers where id_user = 348";
        echo $sql; 
        $result = mysqli_query($link, $sql);
		$subscriptions = [];
		
        while($row = mysqli_fetch_assoc($result))
		{
			$endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
			$subscriptions[] = Subscription::create(json_decode($endpoints, true));
		}
		
		$payload = 'Selamat Datang, di aplikasi web PWA!';
		
		$auth = [
		    'VAPID' => [
		        'subject' => 'https://fadil.website/', // can be a mailto: or your website address
		        'publicKey' => 'BKlGYNo8ShA_X2vRv_6j82WZwH9K3kepYWm8G_lyxXP1J2j7URzGIawEGDRkcvkzm24X2d_gaZjzJjjVq_9CHUk
', // (recommended) uncompressed public key P-256 encoded in Base64-URL
		        'privateKey' => '57qTpaIFXpx7kxmU5Dujbab-mhF4Rfgf3Lx-kH2jfTU', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
		    ],
		];
		
		$webPush = new WebPush($auth);

		// Send to one Endpoint
		//$res = $webPush->sendNotification($subscriptions[$endpoints], $payload, ['TTL' => 5000]);
		
		//Send to multiple Endpoints
		foreach ($subscriptions as $sub)
		{
			$res = $webPush->queueNotification($sub, $payload, ['TTL' => 5000]);
			//$res = $webPush->sendOneNotification($sub, $payload, ['TTL' => 5000]);
		
		}
		
		foreach ($webPush->flush() as $report) {
			$endpoint = $report->getRequest()->getUri()->__toString();
		
			if ($report->isSuccess()) {
				echo "[v] Message sent successfully for subscription {$endpoint}. <br>";
				// echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			} else {
				echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
				// echo "<script type='text/javascript'>alert('failed!')</script>";
			}
		}
        
        //  $this->db->table('tb_subscribers')->getWhere(['p256dh', 'auth']);
        

    }
    
}
