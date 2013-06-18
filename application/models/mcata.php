<?php
class Mcata extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function add_cata($user_id , $name="默认目录"){
		$data=array(
			'user_id'=>$user_id,
			'name'=>$name
			);
		$value=$this->db->insert('catas',$data);
		if($value) $value=$this->db->insert_id();
		return $value;
	}
	public function update_cata($user_id , $cata_id,$name){
 		$this->db->update('catas',array("name"=>$name), array('id' => $cata_id,"user_id"=>$user_id));
	}

	public function delete_cata($user_id , $cata_id){
 		$this->db->delete('catas', array('id' => $cata_id,"user_id"=>$user_id)); 
	}
	public function get_catas($user_id){
		$query=$this->db->get_where('catas' , array('user_id' =>$user_id));
		return $query->result() ;
	}
}
?>