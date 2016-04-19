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

	function deleteProject($idProject){
		$this->db->delete('projects', array('idProject'=>$idProject));
	}

	function getProjectId($nameProject){
		$this->db->where('nameProject',$nameProject);
		$query = $this->db->get('projects');
		if($query->num_rows > 0) return $query->row();
		else return false;
	}

	function getAllProjects(){
		$this->db->select('*');
		$this->db->from('projects_has_departments');
		$this->db->join('projects', 'projects_has_departments.idProject = projects.idProject');
		$this->db->join('departments', 'projects_has_departments.idDepartment = departments.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		return $this->db->get();
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getProject($idProject){
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('idProject',$id);
		$query = $this->db->get('projects');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function updateProject($idProject,$data){
		$info = array(
			'nameProject'=>$data['nameProject'],
			'price'=>$data['price'],
			'dateCreation'=>$data['dateCreation'],
			'dateTermination'=>$data['dateTermination'],
			'idClient'=>$data['idClient']
		 );
		$this->db->where('projects.idProject',$idProject);
		$this->db->update('projects',$info);
	}

	function getclientProjects($idClient){
		$this->db->join('projects', 'projects_has_departments.idProject = projects.idProject');
		$this->db->join('departments', 'projects_has_departments.idDepartment = departments.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('projects.idClient', $idClient);
		$query = $this->db->get("projects_has_departments");
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getDepartmentProjects($idDepartment){
		$this->db->join('projects', 'projects_has_departments.idProject = projects.idProject');
		$this->db->join('departments', 'projects_has_departments.idDepartment = departments.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('departments.idDepartment', $idDepartment);
		return $this->db->get("projects_has_departments");
	}

	function getSectorProjects($idSector){
		$this->db->join('projects', 'projects_has_departments.idProject = projects.idProject');
		$this->db->join('departments', 'projects_has_departments.idDepartment = departments.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('sectors', 'sectors.idSector = clients.idSector');
		$this->db->where('sectors.idSector', $idSector);
		return $this->db->get("projects_has_departments");
	}

	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM projects")->row()->number;
		return intval($number);
	}
	function getCountProjects(){
		$number = $this->db->query("SELECT count(*) as number FROM projects")->row()->number;
		return intval($number);
	}

	function get_pagination($number_per_page){
		$this->db->join('projects', 'projects_has_departments.idProject = projects.idProject');
		$this->db->join('departments', 'projects_has_departments.idDepartment = departments.idDepartment');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		return $this->db->get("projects_has_departments", $number_per_page, $this->uri->segment(3));
	}

}
?>