<?php

class Catas extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mcata');
		$this->load->helper('url');
		$this->load->library('session');
	}
	public function index()
	{
		
	}
}
?>