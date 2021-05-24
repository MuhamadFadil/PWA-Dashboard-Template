<?php 

namespace App\Models; 
use CodeIgniter\Model;
use Zend\Db\Sql\Sql;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
        
require APPPATH . 'views/vendor/autoload.php';
// require_once "vendor/autoload.php";

class PushNotif extends Model
{
    
    function __construct(){
        $this-> db = db_connect(); 
    }
    protected $table ="subscribers";
    
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

    function simpan($data){
        session_start();
        //require APPPATH . 'views/vendor/autoload.php';
        //making current id for id_users value

		// $result = mysql_query("select id from users where name ='".$_SESSION['name']."'");
		// $row = mysql_fetch_array($result); 
		// $id = $row['id']; 
        // session_start();
		// $db = \Config\Database::connect();
        
        $id_user = $_SESSION['DATA_SESSION']['id'];
        $name_user = $_SESSION['DATA_SESSION']['name'];
        $kota_user = $_SESSION['DATA_SESSION']['kota'];

        
		// $entry = $db->query("select id from kuesioner where id = '".$_SESSION['DATA_SESSION']['id']."'");
        
        //session
        // $sql1 = "select id from kuesioner where id = '".$_SESSION['DATA_SESSION']['id']."'";
        // $result = $this->query($sql1);
        //$id= $result->fetchAssoc();
        //$id= $result->_toString(); 
        
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
                    // while (($id = $result->fetchAssoc())){
                        $sql = "INSERT INTO subscribers (id_user, name_user, kota_user, endpoints, auth, p256dh, status_user) VALUES ('$id_user','$name_user','$kota_user','$endpoint', '$auth', '$key', '1')";
                        $this->query($sql);
                        break; 
                    // };
                    
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
	
	function hapusdata($id_subs){
	    return $this->db->table('subscribers')->delete(['id_subs'=>$id_subs]); 
	}
	
	function ambildata($endpoints, $p256dh, $auth){
	    return $this->db->table('subscribers')->getWhere(['enpoints' => $endpoints, 'p256dh' =>$p256dh, 'auth' => $auth ]); 
	}

    function kirimdata()
    {
        $this-> db = db_connect();
        $table = $this->db->table('subscribers')->get();
		$subscriptions = [];
        // $endpoints = []; 
		
		// while($row = mysqli_fetch_array($table))
        foreach($table as $row)
		{
            // $endpoints = [
			// 	'endpoint' => $row->endpoints,
			// 	'expirationTime' => null,
			// 	'keys' => [
			// 		'auth' => $row->auth,
			// 		'p256dh' => $row->p256dh
			// 		],
			// ];
			// $endpoints = '{"endpoint":"'. $row['endpoints'] .'","expirationTime":null,"keys":{"auth":"' . $row['auth'] . '","p256dh":"' . $row['p256dh'] . '"}}';
			$endpoints = '{"endpoint":"'. $row->endpoints .'","expirationTime":null,"keys":{"p256dh":"' . $row->p256dh . '","auth":"' . $row->auth . '"}}';
			$subscriptions[] = Subscription::create(json_decode($endpoints, true));
		}
		
		$payload = 'Pasti Bisa Nyook!';
		
		$auth = [
		    'VAPID' => [
		        'subject' => 'mailto:mufadil98@gmail.com', // can be a mailto: or your website address
		        'publicKey' => 'BHugL3rwhWzHwhmHW14GmXLeKesJdVr2mZ7bmm1ZFplknHj8sTjrW3T-cXGYn8zAZJn-HWMN5Aiulwg1PNf_jXE', // (recommended) uncompressed public key P-256 encoded in Base64-URL
		        'privateKey' => '-QIJ_6d2Wg50ZJewUD0MjEbmhW85pJj4wYf16uZ9Goo', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
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
		
			if ($report->isSucceshs()) {
				echo "[v] Message sent successfully for subscription {$endpoint}. <br>";
			} else {
				echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
			}
		}
        
        // return $this->db->table('subscribers')->getWhere(['p256dh'=>$p256dh, 'auth'=>$auth]);
        // return $this->db->table('subscribers')->insert($data);

    }

    function status ($data){
        return $this->db->table('status_subscriber')->insert($data); 
    }
}