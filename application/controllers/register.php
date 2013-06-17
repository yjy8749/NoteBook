<?php

class Register extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('muser');
		$this->load->model('mcata');
		$this->load->helper('url');
		$this->load->library('session');
	}
	public function index()
	{
		$username=$this->input->post('username',TRUE);
		$password=$this->input->post('password2',TRUE);
		$name=$this->input->post('name',TRUE);
		if(   
			preg_match("/^[a-zA-Z0-9]{2,12}$/",$username)&&
			preg_match("/^[^\x{4e00}-\x{9fa5}]{6,12}$/u",$password)&&
			preg_match("/^[\x{4e00}-\x{9fa5}|\w]{1,10}$/u",$name)
		){
			$data['user']['id']=$this->muser->add_user($username,$password,$name);
			if($data['user']['id']){
				$this->session->set_userdata('user_id', $data['user']['id']);
				$this->mcata->add_cata($data['user']['id']);
				$data['catas']=$this->mcata->get_catas($data['user']['id']);
				$data['user']['name']=$name;
				$this->load->view('user_index',$data);
				return;
			}
		}

		$data['holder']= "用户名";
		$this->load->view('welcome',$data);
	}
	public function checkUsernameIsExist(){
		$username=$this->input->post('username',TRUE);
		if(preg_match("/^[a-zA-Z0-9]{2,12}$/",$username)){
			$result= $this->muser->get_user($username);
			if(empty($result)) echo "ok";
		}
	}
}
?>