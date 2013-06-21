<?php
class Mrecord extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function add_record($cata_id , $title){
		$data=array(
			'cata_id'=>$cata_id,
			'title'=>$title
			);
		$value=$this->db->insert('records',$data);
		if($value) $value=$this->db->insert_id();
		return $value;
	}
	
	public function get_record_by_cataid($cata_id){
		$this->db->order_by("state", "asc"); 
		$query=$this->db->get_where('records' , array('cata_id' =>$cata_id));
		return $query->result() ;
	}

	public function delete_record($id){
		$this->db->delete('records', array('id' => $id)); 
	}

	public function comp_record($id){
		$this->db->select('state');
		$this->db->where('id',$id);
		$query=$this->db->get('records');
		foreach ($query->result() as $row)
		{
		    if($row->state==0){
		    	$this->db->update('records',array("state"=>1), array('id' => $id));
		    	return 1;
		    }
		    else{
		    	$this->db->update('records',array("state"=>0), array('id' => $id));
		    	return 0;
		    }
		}
	}
	public function update_record($id , $title,$remark){
 		$this->db->update('records',array("title"=>$title,"remark"=>$remark), array('id' => $id));
	}
}

?>