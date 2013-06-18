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
		show_404();
	}
	public function add()
	{
		$user_id = $this->session->userdata('user_id');
		$cata_name=$this->input->post("cata_name",TRUE);
		if($user_id&&$cata_name!=""){
			$cata_id=$this->mcata->add_cata($user_id,$cata_name);
			echo $cata_id;
		}		
	}
	public function update()
	{
		$user_id = $this->session->userdata('user_id');
		$cata_id=$this->input->post("cata_id",TRUE);
		$cata_name=$this->input->post("cata_name",TRUE);
		if($user_id&&$cata_name!=""&&cata_id!=""){
			$cata_id=$this->mcata->update_cata($user_id,$cata_id,$cata_name);
		}		
	}
	public function delete()
	{
		$user_id = $this->session->userdata('user_id');
		$cata_id=$this->input->post("cata_id",TRUE);
		if($user_id&&$cata_id!=""){
			$cata_id=$this->mcata->delete_cata($user_id,$cata_id);
		}		
	}
}
?>