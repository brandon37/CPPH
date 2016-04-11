<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newDepartment($data){
		$this->db->insert('department',array('nameDepartment'=>$data['nameDepartment']));
	}

	function deleteDepartment($id){
		
		$this->db->delete('department', array('idDepartment'=>$id));
	}

	function getAllDepartments(){
		$query = $this->db->get('department');
		if($query->num_rows()>0) return $query;
		else return false;
	}

	function getDepartmentId($nameDepartment){
		$this->db->where('nameDepartment',$nameDepartment);
		$query = $this->db->get('department');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function getDepartment($id){
		$this->db->where('idDepartment',$id);
		$query = $this->db->get('department');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function updateDepartment($id,$data){
		$info = array(
			'nameDepartment'=>$data['nameDepartment']
		 );
		$this->db->where('idDepartment',$id);
		$this->db->update('department',$info);
	}
	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM department")->row()->number;

		return intval($number);
	}

	function get_pagination($number_per_page){

		return $this->db->get("department", $number_per_page, $this->uri->segment(3));

	}
	
}
?>