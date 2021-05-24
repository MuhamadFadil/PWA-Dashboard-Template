<?php 

namespace App\Models; 
use CodeIgniter\Model; 

class ShareModel extends Model
{
    
    function __construct(){
        $this-> db = db_connect(); 
    }
    protected $table ="aktivitas";
    
    
    public function getData($id_user = false)
    {
        if ($id_user == false) {
            return $this->findAll();
        }

        return $this->where(['id_user' => $id_user])->first();
    }
    
    function tampil()
    {
        return $this->db->table('aktivitas')->get(); 
        
    }
    
    function simpan($data){
	    return $this->db->table('aktivitas')->insert($data); 
	}
	
	function hapusdata($user_id){
	    return $this->db->table('aktivitas')->delete(['id_user'=>$user_id]); 
	}
	
	function ambildata($id){
	    return $this->db->table('aktivitas')->getWhere(['id_user' => $id]); 
	}
	
	function simpanfile($upload){
	    return $this->db->table('aktivitas')->insert($upload)->getWhere(['upload_file' => $upload]); 
	}
	
	function uploadFile($upload){
	    return $this->db->table('aktivitas')->getWhere(['upload_file' => $upload]); 
	}

}