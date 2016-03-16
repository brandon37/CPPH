<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newDepartment($data){
		$this->db->insert('department',array('nameDepartment'=>$data['namedepartment']));
	}

	 function deleteDepartment($id){
		
		$this->db->delete('department', array('idDepartament'=>$id));
	}

	 function getAllDepartments(){
		$query = $this->db->get('department');
		if($query->num_rows()>0) return $query;
		else return false;
	}

	 function getDepartment($id){
		$this->db->where('idDepartament',$id);
		$query = $this->db->get('department');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateDepartment($id,$data){
		$info = array(
			'nameDepartment'=>$data['nameDepartment']
		 );
		$this->db->where('idDepartament',$id);
		$this->db->update('department',$info);
	}
	
}
?>