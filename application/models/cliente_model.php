<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function crearCliente($data){
		$this->db->insert('clientes',array('nomCliente'=>$data['nombrec'],
			'status'=>$data['status']), 
			'idsector'=>$data['sector']);
	}

	 function eliminarCliente($id){
		
		$this->db->delete('clientes', array('idCliente'=>$id));
	}
	function obtenerClientes($id){
		$query = $this->db->get('clientes');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function obtenerCliente($id){
		$this->db->where('idCliente',$id);
		$query = $this->db->get('clientes');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function actualizarCliente($id,$data){
		$datos = array(
			'nomCliente'=>$data['nombre'],
			'status'=>$data['status'],
			'idsector'=>$data['sector']
		 );
		$this->db->where('idCliente',$id);
		$this->db->update('clientes',$datos);
	}
	
}
?>