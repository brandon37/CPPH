<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyectos_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newProyecto($data){
		$this->db->insert('proyectos',array('nomProyecto'=>$data['nombrep'],'departamento'=>$data['depa'], 
			'precio'=>$data['precio'],'fCreacion'=>$data['fC'],'fTerm'=>$data['fT'],'idCliente'=>$data['idClient']);
	}

	 function deleteProyecto($id){
		
		$this->db->delete('proyectos', array('idproyecto'=>$id));
	}

	 function getAllProyectos($id){
		$query = $this->db->get('proyectos');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getProyecto($id){
		$this->db->where('idproyecto',$id);
		$query = $this->db->get('proyectos');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateProyecto($id,$data){
		$datos = array(
			'nomProyecto'=>$data['nombrep'],
			'departamento'=>$data['depa'], 
			'precio'=>$data['precio'],
			'fCreacion'=>$data['fC'],
			'fTerm'=>$data['fT'],
			'idCliente'=>$data['idClient']
		 );
		$this->db->where('idproyecto',$id);
		$this->db->update('proyectos',$datos);
	}
	
}
?>