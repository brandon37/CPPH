<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newInvoice($data){
		$this->db->insert('invoice',array('noinvoice'=>$data['noinvoice'],'status'=>$data['status']));
	}

	 function deleteInvoice($id){
		$this->db->delete('idInvoice', array('idInvoice'=>$id));
	}

	function getAllInvoice($id){
		$query = $this->db->get('invoice');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getInvoice($id){
		$this->db->where('idInvoice',$id);
		$query = $this->db->get('invoice');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateInvoice($id,$data){
		$info = array(
			'noinvoice'=>$data['noinvoice'],
			'status'=>$data['status']
		 );
		$this->db->where('idInvoice',$id);
		$this->db->update('invoice',$info);
	}
	
}
?>