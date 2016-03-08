<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newClient($data){
		$this->db->insert('clients',array('nameClient'=>$data['nameClient'],
			'status'=>$data['status'], 
			'idSector'=>$data['sector']));
	}

	 function deleteClient($id){
		
		$this->db->delete('clients', array('idClient'=>$id));
	}
	function getAllClients(){
		$query = $this->db->get('clients');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getClient($id){
		$this->db->where('idClient',$id);
		$query = $this->db->get('clients');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateClient($id,$data){
		$info = array(
			'nameClient'=>$data['nameClient'],
			'status'=>$data['status'],
			'idSector'=>$data['sector']
		 );
		$this->db->where('idClient',$id);
		$this->db->update('clients',$info);
	}
	
}
?>