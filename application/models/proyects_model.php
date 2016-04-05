<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyects_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newProyect($data){
		$this->db->insert('proyects',
			array('nameProyect'=>$data['nameProyect'],
				'price'=>$data['price'],
				'dateCreation'=>$data['dateCreation'],
				'dateTermination'=>$data['dateTermination'],
				'idClient'=>$data['idClient']));
	}

	function deleteProyect($id){
		$this->db->delete('proyects', array('idProyect'=>$id));
	}

	function indexDepartment($data){
		$this->db->insert('proyects_has_department',
			array('idProyect'=>$data['idProyect'],
				'idDepartment'=>$data['idDepartment']));
	}
	function updateIndexDepartment($id, $data){
		$info = array('idProyect'=>$id,
				'idDepartment'=>$data['idDepartment']);
		$this->db->where('idProyect',$id);
		$this->db->update('proyects_has_department',$info);
	}

	function getProyectId($nameProyect){
		$this->db->where('nameProyect',$nameProyect);
		$query = $this->db->get('proyects');
		if($query->num_rows > 0) return $query->row();
		else return false;
	}
	

	function getAllProyects(){
	 	$this->db->select('*');
		$this->db->from('proyects');
		$this->db->join('clients', 'proyects.idClient = clients.idClient');
		$this->db->from('proyects_has_department');
		$this->db->join('proyects', 'proyects_has_department.idProyect = proyects.idProyect');
		$this->db->join('department', 'proyects_has_department.idDepartment = department.idDepartment');
		$query = $this->db->get();
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getProyect($id){
		$this->db->select('*');
		$this->db->from('proyects_has_department');
		$this->db->join('proyects', 'proyects_has_department.idProyect = proyects.idProyect');
		$this->db->join('department', 'proyects_has_department.idDepartment = department.idDepartment');
		$this->db->join('clients', 'proyects.idClient = clients.idClient');
		$this->db->where('proyects_has_department.idProyect',$id);
		$query =  $this->db->get();
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function updateProyect($id,$data){
		$info = array(
			'nameProyect'=>$data['nameProyect'],
			'price'=>$data['price'],
			'dateCreation'=>$data['dateCreation'],
			'dateTermination'=>$data['dateTermination'],
			'idClient'=>$data['idClient']
		 );
		$this->db->where('idProyect',$id);
		$this->db->update('proyects',$info);
	}

	function no_page(){

		$number = $this->db->query("SELECT count(*) as number FROM proyects")->row()->number;

		return intval($number);
	}

	function get_pagination($number_per_page){

		$this->db->join('proyects', 'proyects_has_department.idProyect = proyects.idProyect');
		$this->db->join('department', 'proyects_has_department.idDepartment = department.idDepartment');
		$this->db->join('clients', 'proyects.idClient = clients.idClient');
		return $this->db->get("proyects_has_department", $number_per_page, $this->uri->segment(3));
	}
	
	
}
?>