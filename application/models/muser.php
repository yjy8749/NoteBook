<?php
class Muser extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function get_user($username , $password=false){
		if($password){
			$password=md5($password);
			$query=$this->db->get_where('users' , array('username' =>$username,"password"=>$password));
		}else{
			$query=$this->db->get_where('users' , array('username' =>$username));
		}
		return $query->row_array();
	}
	public function get_user_by_id($id){
		$query=$this->db->get_where('users' , array('id' =>$id));
		return $query->row_array();
	}
	public function add_user($username , $password,$name,$rank=1){
		$password=md5($password);
		$data=array(
			'username'=>$username,
			'password'=>$password,
			'name'=>$name,
			'rank'=>$rank
			);
		$value=$this->db->insert('users',$data);
		if($value) $value=$this->db->insert_id();
		return $value;
	}
}
?>