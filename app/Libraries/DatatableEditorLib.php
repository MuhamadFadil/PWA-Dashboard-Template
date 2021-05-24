<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DatatableEditorLib {
	private $CI = null;
	function __construct(){
		$this->CI = &get_instance();
	}   
	public function process($post){ 
		require dirname(__FILE__).'/DatatableEditor/DataTables.php';  // DataTables PHP library
		$this->CI->load->model('TagihanModel','M'); //Load the model which will give us our data
		$this->CI->M->init($db); //Pass the database object to the model
		$this->CI->M->get($post); //Let the model produce the data
	}
	public function processMajorTiming($post,$timingId=0){ 
		require dirname(__FILE__).'/DatatableEditor/DataTables.php'; 
		$this->CI->load->model('MajorTimingModel','M');
		$this->CI->M->init($db);
		$this->CI->M->get($post,$timingId);
	}
}
?>