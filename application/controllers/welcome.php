<?php

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('muser');
		$this->load->library('session');
	}
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		if($user_id){
			$data['user'] = $this->muser->get_user_by_id($user_id);
			if(!empty($data['user'])) {
				$this->load->view('user_index',$data);
				return;
			}
		}
		
		$data['holder']= "用户名";
		$this->load->view('welcome',$data);
	}
}
?>