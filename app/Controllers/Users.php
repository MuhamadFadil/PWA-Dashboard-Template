<?php 
namespace App\Controllers;
use App\Libraries\GroceryCrud;
use Grocery_CRUD;

class Users extends BaseController{	
	public function index(){
		if(Users::check()==0){return redirect()->to('login');}
		
		$o['title'] = 'Users';
		$c = new GroceryCRUD();
		$c->set_subject($o['title']);
	    $c->setTable('users');
	    $c->columns('name','kota','photo','address', 'status', 'role', 'last_login'); 
		//$c->unique_fields(['email']);
		//$c->unset_export(); 
		$c->set_read_fields(['created','last_login','provinsi']);
		//$c->field_type('provinsi','hidden');
		$c->field_type('password','hidden');
		$c->field_type('last_login','hidden');
		$c->display_as('kota','Kota/Kabupaten');
		$c->display_as('photo','Foto');
		$c->set_field_upload('photo','/assets/uploads/user_photo');
		$c->callback_after_upload(array($this, 'example_callback_after_upload'));
        $c->unset_clone();

	    $output = $c->render();
		return $this->_example_output($output,$o);
		
	}
	
	
	public function users_management(){
		if(Users::check()==0){return redirect()->to('login');}
		
		$o['title'] = 'Users';
		$c = $this->_getGroceryCrudEnterprise();
		$c->setTable('users');
		$c->uniqueFields(['email']);
		$c->unsetExport();
		$c->readOnlyEditFields(['created','last_login','provinsi']);
		$c->fieldTypeAddForm('created','hidden');
		$c->fieldTypeAddForm('last_login','hidden');
		$c->fieldTypeAddForm('provinsi','hidden');
		$c->displayAs('kota','Kota/Kabupaten');
		$c->setFieldUpload('photo','/assets/uploads/user_photo','/assets/uploads/user_photo');
		
		// cegah non admin CURD yg lain
		$uid = $_SESSION['DATA_SESSION']['id'];
		$r = $_SESSION['DATA_SESSION']['role'];
		if(in_array($c->getState(),['EditForm','Update','ReadForm']) && $r != 'Admin'){
		  $tmp = $c->getStateInfo();
			$i = isset($tmp->primaryKeyValue) ? $tmp->primaryKeyValue : 0;
			if($uid != $i){
				return redirect()->to('dashboard');
			}
		}
		if($r != 'Admin' && in_array($c->getState(),['RemoveMultiple','RemoveOne','AddForm','Insert'])){
			return redirect()->to('dashboard');
		}
		
		if($r!='Admin'){
			$c->fieldType('email','readonly');
			$c->fieldType('status','readonly');
			$c->fieldType('role','readonly');
			$c->where(['id'=>$uid]);
			$c->unsetAdd()
				->columns(['name','email'])
				->setConfig('open_in_modal', false)
				->unsetExport()
				->unsetPrint()
				->unsetSearchColumns(['name','email']) //ga mempan
				->unsetDelete();
			$o['title'] = 'Your Account';
			// if(in_array($c->getState(),['ReadForm','Initial'])){
			// 	$c->requiredFields([]);
			// }
		}else{
			$c->unsetColumns(['photo','address','password']);
			$c->setRead();
			$c->fieldTypeReadForm('password','hidden');
		}
		
		if(in_array($c->getState(),['AddForm','Insert','Initial'])){ //initial harus termasuk
			$c->requiredFields(['name','kota','email','status','role','password']);
			$c->fieldType('password','password');
		}else{
			$c->requiredFields(['name','email','status','role']); //password ga jadi wajib krn klo operasi edit, bisa diisi bisa nggak.
		}
		
		// $c->callbackAfterUpdate(array($this, 'update_provinsi'));
		// $c->callbackAfterInsert(array($this, 'update_provinsi'));
		//$c->callbackBeforeUpdate(array($this,'_before_update')); //provinsi, password
		//$c->callbackBeforeInsert(array($this,'_before_insert')); //set created = date(), provinsi, password, cek unique field
		//$c->callbackDelete(array($this,'_del'));
		//$c->callbackDeleteMultiple(array($this,'_del'));
		//$c->callbackEditField('password',array($this,'set_password_input_to_empty'));
		// $c->callbackEditField('password', function ($v, $pk, $r){return 'tes';});
		
	  $output = $c->render();
		return $this->_example_output($output,$o);

	}
	
	function example_callback_after_upload($uploader_response, $field_info, $files_to_upload)
    {
        $this->load->library(Image_moo);

        //Is only one file uploaded so it ok to use it with $uploader_response[0].
        // $file_uploaded = $field_info->upload_path . '/assets/uploads/user_photo' . $uploader_response[0]->name;
        $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 

        $this->Image_moo->load($file_uploaded)->resize(800, 600)->save($file_uploaded, true);

        return true;
    }
	
	private function _get_provinsi($kota){
		$contents = file_get_contents("assets/provinsi.json");
		$contents = utf8_encode($contents);
		$results = json_decode($contents, true); 
    return $results[$kota];
	}
	
	// public function _example_output($output = null){
	// 	return view('kuesioner', (array)$output);
  // }

	public static function check(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['LAST_ACTIVITY']) && isset($_SESSION['DATA_SESSION']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1000*60*60)) { //unit: second

			//ini saya disable karena saya belum menemukan pentingnya menyimpan session key.
			// $builder = $db->table('users');
			// $builder->set('session', '');
			// $builder->where('id', $_SESSION['DATA_SESSION']['id']);
			// $builder->update(); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2

			// last request was more than 30 minutes ago
			session_unset();     // unset $_SESSION variable for the run-time 
			session_destroy();   // destroy session data in storage
			return 0;
		}

		if (!isset($_SESSION['LAST_ACTIVITY'])) {
			return 0;
		}

		$_SESSION['LAST_ACTIVITY'] = time();

		$db = \Config\Database::connect();
		$builder = $db->table('users');
		$builder->set('last_login', date('Y-m-d H:i:s'));
		$builder->where('id', $_SESSION['DATA_SESSION']['id']);
		$builder->update(); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
		return 1;
	}
	
	function set_password_input_to_empty($v, $primary_key, $r) {
		return '<div class="form-input-box" id="password_box"><input id="field-password" name="password" type="password" class="form-control"><small><em>leave it blank to use the current password</small></em></div>';
		// return "Encrypted: <input class='form-control' name='password' value='$primary_key' disabled /><br/> New: <input class='form-control' name='passwordnew'  />";
	}
 
	function _before_update($i) {
		$post_array = $i->data;
		$primary_key = $i->primaryKeyValue;
		if(!empty($post_array['password'])){
			$post_array['password']=md5($post_array['password']);
		}else{
			unset($post_array['password']); //dont update password
		}
		$db = \Config\Database::connect();
		$k = $db->query("select kota from users where id = $primary_key")->getRow()->kota;
		
		if($post_array['kota']!=$k){
			$e = new \GroceryCrud\Core\Error\ErrorMessage();
			return $e->setMessage("Sorry you cannot change Kota.\n");
		}
		$i->data = $post_array;
		return $i;
	}
	
	function _before_insert($i) {
		$post_array = $i->data;
		$post_array['created'] = date('Y-m-d H:i:s');
		$post_array['password']=md5($post_array['password']);
		$e = new \GroceryCrud\Core\Error\ErrorMessage();
		if($post_array['kota']!=''){
			$post_array['provinsi'] = $this->_get_provinsi($post_array['kota']);
		}else{
			return $e->setMessage("Invalid value for Kota.\n");
		}
		$i->data = $post_array;
		return $i;
	}
	
	function _del($i){
		$ids = [];
		if(isset($i->primaryKeyValue)){
			if(is_numeric($i->primaryKeyValue)){
				$ids[] = $i->primaryKeyValue;
			}
		}elseif(isset($i->primaryKeys)){
			foreach($i->primaryKeys as $pk){
				if(is_numeric($pk)){
					$ids[] = $pk;
				}
			}
		}
		header('Content-Type: application/json; charset=utf-8');
		$t = '<ol>';
		$s = 0; //num of success
		$f = 0; //num of failed
		if(!empty($ids)){
			$db = \Config\Database::connect();
			foreach($ids as $id){
				$q = $db->query("select name,kota from users where id = $id")->getRow();
				if(!isset($q)){
					$t .= '<li><b>Unknown</b> : User ini sudah dihapus.';
					$f++;
				}else{
					$t .= '<li><b>'.$q->name.' ('.$q->kota.')</b> : ';
					$c = $db->query("select count(*) c from jawaban j join users u on j.user = u.id where u.status = 'Active' and u.id = $id")->getRow()->c;
					if($c>0){ //status aktif dan sudah pernah isi jawaban --> set as blocked
						$db->query("update users set status = 'Blocked' where id = $id");
						$t .= 'Status diubah menjadi Blocked (tidak bisa login) karena sudah pernah mengisi kuesioner (bila dihapus, mungkin akan mempengaruhi ranking yang sudah dupublikasikan).';
						$f++;
					}else{ //status blocked atau blm pernah isi jawaban --> hapus
						$c = $db->query("select count(*) c from jawaban_final j join users u on j.user = u.id where u.id = $id")->getRow()->c;
						if($c>0){
							$t .= 'Tidak dihapus karena sudah pernah submit jawaban (bila dihapus, mungkin akan mempengaruhi ranking yang sudah dupublikasikan).';
							$f++;
						}else{
							$db->transStart();
							$db->query("delete from jawaban where user = $id");
							$db->query("delete from users where id = $id");
							$db->transComplete();
							if($db->transStatus() === FALSE){
								$t .= 'Gagal dihapus.';
								$f++;
							}else{
								$t .= 'User dan semua jawaban draft yang pernah disimpan sudah dihapus.';
								$s++;
							}							
						}
						
					}
				}
				$t .= '</li>';
			}
		}else{
			$t .= 'Nothing deleted.';
		}
		$t2 = $f>0?'failure':'success';
		$t3 = $s>0?'Harap refresh halaman ini':'';
		echo '{"message":"'.$t.'</ol>'.$t3.'","status":"'.$t2.'"}';
		exit;
	}
	public function setSesData($k,$v){ //utk simpan state show/hide right sidebar.
		if (session_status() == PHP_SESSION_NONE) { session_start(); }
		$_SESSION[$k] = $v;
	}
}
/*
c
	admin
		otomatis: provinsi, created
	user
		cant
r
	admin
		all
	user
		self
e
	admin
		all
	user
		self. password can be empty/filled. cannot edit: kota, provinsi, status, role, last_login, created
d
	delete: notify dulu emailnya, dan set as hidden, dan user gabisa logi lagi
*/