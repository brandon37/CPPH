<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sector_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function crearSector($data){
		$this->db->insert('sector',array('tipoSector'=>$data['tipoSector']);
	}

	 function eliminarSector($id){
		
		$this->db->delete('sector', array('idsector'=>$id));
	}

	 function obtenerSectores(){
		$query = $this->db->get('sector');
		if($query->num_rows()>0) return $query;
		else return false;
	}

	 function obtenerSector($id){
		$this->db->where('idsector',$id);
		$query = $this->db->get('sector');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function actualizarSector($id,$data){
		$datos = array(
			'tipoSector'=>$data['tipoSector']
		 );
		$this->db->where('idsector',$id);
		$this->db->update('sector',$datos);
	}
	
}
?>