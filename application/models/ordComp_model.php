<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrdComp_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newOrdenCompre($data){
		$this->db->insert('ordenCompras',array('concepto'=>$data['concepto'],'monto'=>$data['monto']), 
			'fCreacion'=>$data['fC_ordC'],'fTerm'=>$data['fT_ordC'],'idproyecto'=>$data['idproyecto']);
	}

	 function deleteOrdenCompra($id){
		$this->db->delete('ordenCompras', array('idordenCompras'=>$id));
	}
	function getAllOrdenCompras($id){
		$query = $this->db->get('ordenCompras');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getOrdenCompra($id){
		$this->db->where('idordenCompras',$id);
		$query = $this->db->get('ordenCompras');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateOrdenCompras($id,$data){
		$datos = array(
			'concepto'=>$data['concepto'],
			'monto'=>$data['monto'],
			'fCreacion'=>$data['fC_ordC'],
			'fTerm'=>$data['fT_ordC'],
			'idproyecto'=>$data['idproyecto']
		 );
		$this->db->where('idordenCompras',$id);
		$this->db->update('ordenCompras',$datos);
	}
	
}
?>