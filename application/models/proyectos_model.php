<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyectos_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function crearProyecto($data){
		$this->db->insert('proyectos',array('nomProyecto'=>$data['nombrep'],'departamento'=>$data['depa'], 
			'precio'=>$data['precio'],'fCreacion'=>$data['fC'],'fTerm'=>$data['fT'],'idCliente'=>$data['idClient']);
	}

	 function eliminarProyecto($id){
		
		$this->db->delete('proyectos', array('idproyecto'=>$id));
	}

	 function obtenerProyectos($id){
		$query = $this->db->get('proyectos');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function obtenerProyecto($id){
		$this->db->where('idproyecto',$id);
		$query = $this->db->get('proyectos');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function actualizarProyecto($id,$data){
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