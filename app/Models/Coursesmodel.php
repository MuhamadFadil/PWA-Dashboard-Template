<?php
namespace App\Models;
use CodeIgniter\Model;
defined('BASEPATH') OR exit('No direct script access allowed');

class Coursesmodel extends Model {
	public function getCurrentTerm(){
			$q = $this->db->query("select *,concat(year_start,'/',year_start+1 ,' ',semester) as name from timing where start_date <= CURRENT_TIMESTAMP and end_date >= CURRENT_TIMESTAMP limit 1");
		$r1 = $q->row();
		if(isset($r1)){ //if(count($r1)==0){
			$q = $this->db->query("select *,concat(year_start,'/',year_start+1 ,' ',semester) as name from timing where end_date <= CURRENT_TIMESTAMP order by end_date desc limit 1");
			$r1 = $q->row();
		}
		return $r1;
	}
	public function getLastTerm(){
		$q = $this->db->query("select * from timing where end_date < CURRENT_TIMESTAMP order by end_date desc limit 1");
		return $q->row();
	}
}
