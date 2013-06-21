<?php

class Records extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mrecord');
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
		$cata_id=$this->input->post("cata_id",TRUE);
		$title=$this->input->post("title",TRUE);
		if($user_id&&$cata_id!=""&&$title!=""){
			$record_id=$this->mrecord->add_record($cata_id,$title);
			echo $record_id;
		}		
	}

	public function delete()
	{
		$user_id = $this->session->userdata('user_id');
		$record_id=$this->input->post("record_id",TRUE);
		if($user_id&&$record_id!=""){
			$this->mrecord->delete_record($record_id);
		}		
	}

	public function comp()
	{
		$user_id = $this->session->userdata('user_id');
		$record_id=$this->input->post("record_id",TRUE);
		if($user_id&&$record_id!=""){
			echo  $this->mrecord->comp_record($record_id);
		}		
	}
	public function update(){
		$user_id = $this->session->userdata('user_id');
		$record_id=$this->input->post("record_id",TRUE);
		if($user_id&&$record_id!=""){
			$title=$this->input->post("title",TRUE);
			$remark=$this->input->post("remark",TRUE);
			$this->mrecord->update_record($record_id,$title,$remark);
			echo "ok";
		}
	}
}
?>