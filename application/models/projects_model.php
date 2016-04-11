<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newProject($data){
		$this->db->insert('projects',
			array('nameProject'=>$data['nameProject'],
				'price'=>$data['price'],
				'dateCreation'=>$data['dateCreation'],
				'dateTermination'=>$data['dateTermination'],
				'idClient'=>$data['idClient']));
	}

	function deleteProject($id){
		$this->db->delete('projects', array('idProject'=>$id));
	}

	function indexDepartment($data){
		$this->db->insert('projects_has_department',
			array('idProject'=>$data['idProject'],
				'idDepartment'=>$data['idDepartment']));
	}
	function updateIndexDepartment($id, $data){
		$info = array('idProject'=>$id,
				'idDepartment'=>$data['idDepartment']);
		$this->db->where('idProject',$id);
		$this->db->update('projects_has_department',$info);
	}

	function getProjectId($nameProject){
		$this->db->where('nameProject',$nameProject);
		$query = $this->db->get('projects');
		if($query->num_rows > 0) return $query->row();
		else return false;
	}
	

	function getAllProjects(){
	 	$this->db->select('*');
		$this->db->from('projects');
		$query = $this->db->get();
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getProject($id){
		$this->db->select('*');
		$this->db->from('projects_has_department');
		$this->db->join('projects', 'projects_has_department.idProject = projects.idProyect');
		$this->db->join('department', 'projects_has_department.idDepartment = department.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('projects_has_department.idProject',$id);
		$query =  $this->db->get();
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function updateProject($id,$data){
		$info = array(
			'nameProject'=>$data['nameProject'],
			'price'=>$data['price'],
			'dateCreation'=>$data['dateCreation'],
			'dateTermination'=>$data['dateTermination'],
			'idClient'=>$data['idClient']
		 );
		$this->db->where('idProject',$id);
		$this->db->update('projects',$info);
	}

	function getclientProjects($id){
		$this->db->join('projects', 'projects_has_department.idProject = projects.idProyect');
		$this->db->join('department', 'projects_has_department.idDepartment = department.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('projects.idClient', $id);
		return $this->db->get("projects_has_department");
	}

	function getDepartmentProjects($id){
		$this->db->join('projects', 'projects_has_department.idProject = projects.idProyect');
		$this->db->join('department', 'projects_has_department.idDepartment = department.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('department.idDepartment', $id);
		return $this->db->get("projects_has_department");
	}

	function getSectorProjects($id){
		$this->db->join('projects', 'projects_has_department.idProject = projects.idProyect');
		$this->db->join('department', 'projects_has_department.idDepartment = department.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('sector', 'sector.idSector = clients.idSector');
		$this->db->where('sector.idSector', $id);
		return $this->db->get("projects_has_department");
	}

	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM projects")->row()->number;
		return intval($number);
	}

	function get_pagination($number_per_page){
		$this->db->join('projects', 'projects_has_department.idProject = projects.idProyect');
		$this->db->join('department', 'projects_has_department.idDepartment = department.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		return $this->db->get("projects_has_department", $number_per_page, $this->uri->segment(3));
	}

}
?>