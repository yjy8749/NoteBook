<?php

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('muser');
		$this->load->model('mcata');
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function index()
	{
		$username=$this->input->post('username',TRUE);
		$password=$this->input->post('password',TRUE);
		if(
			$username!=""&&$password!=""&&
			preg_match("/^[a-zA-Z0-9]{2,12}$/",$username)&&
			preg_match("/^[^\x{4e00}-\x{9fa5}]{6,12}$/u",$password)
			){
			
			$data['user'] = $this->muser->get_user($username,$password);
			if(!empty($data['user'])) {
				$this->session->set_userdata('user_id', $data['user']['id']);
				$data['catas']=$this->mcata->get_catas($data['user']['id']);
				$this->load->view('user_index',$data);
			}
			else {
				$data["holder"]="用户名或密码错误请重新输入";
				$this->load->view('welcome',$data);
			}
		}
		else{
			$data["holder"]="用户名";
			$this->load->view('welcome',$data);
		}
	}
	public function safeexit(){
		$this->session->sess_destroy();
		header("Location: ".base_url()); 
	}
}
?>