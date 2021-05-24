<?php

namespace App\Models;

use CodeIgniter\Model;

class PushModel extends Model
{

    function __construct()
    {
        $this->db = db_connect();
    }
    protected $table = "subscriber";


    public function getData($enpoints = false)
    {
        if ($enpoints == false) {
            return $this->findAll();
        }

        return $this->where(['enpoint' => $enpoints])->first();
    }

    function tampil()
    {
        return $this->db->table('subscriber')->get();
    }

    function simpan($data)
    {
        return $this->db->table('subscriber')->insert($data);
    }
}
