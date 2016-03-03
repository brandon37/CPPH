<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturas_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newFactura($data){
		$this->db->insert('facturas',array('numFactura'=>$data['numF'],'estado'=>$data['estado']), 
			'idordenCompras'=>$data['idordenCompras']);
	}

	 function deleteFactura($id){
		$this->db->delete('facturas', array('idfactura'=>$id));
	}

	function getAllFacturas($id){
		$query = $this->db->get('facturas');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getFactura($id){
		$this->db->where('idfactura',$id);
		$query = $this->db->get('facturas');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateFactura($id,$data){
		$datos = array(
			'numFactura'=>$data['numF'],
			'estado'=>$data['estado'],
			'idordenCompras'=>$data['idordenCompras']
		 );
		$this->db->where('idfactura',$id);
		$this->db->update('facturas',$datos);
	}
	
}
?>