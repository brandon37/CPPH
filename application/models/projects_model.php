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
		$this->db->from('projects');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$query = $this->db->get();
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getProject($idProject){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('projects.idProject',$idProject);
		$query =  $this->db->get();
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
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('projects.idClient', $idClient);
		$query = $this->db->get("projects");
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getSectorProjects($idSector){
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('sectors', 'sectors.idSector = clients.idSector');
		$this->db->where('sectors.idSector', $idSector);
		$query = $this->db->get("projects");
		if($query->num_rows() >0) return $query;
		else return false;
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
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		return $this->db->get("projects", $number_per_page, $this->uri->segment(3));
	}

}
?>