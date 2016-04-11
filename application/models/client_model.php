<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newClient($data){
		$this->db->insert('clients',array('nameClient'=>$data['nameClient'],
			'status'=>$data['status'], 
			'idSector'=>$data['idSector']));
	}

	function deleteClient($id){
		$this->db->delete('clients', array('idClient'=>$id));
	}

	function getAllActiveClients(){
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('status',"Activo");
		$this->db->join('sector', 'sector.idSector = clients.idSector');
		$query = $this->db->get();
		if($query->num_rows() >0) return $query;
		else return false;
	}
	
	function getAllInactiveClients(){
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('status',"Inactivo");
		$this->db->join('sector', 'sector.idSector = clients.idSector');
		$query = $this->db->get();
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getClient($id){
		$this->db->where('idClient',$id);
		$this->db->join('sector', 'clients.idSector = sector.idSector');
		$query = $this->db->get('clients');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function getClientId($nameClient){
		$this->db->where('nameClient',$nameClient);
		$query = $this->db->get('clients');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function updateClient($id,$data){
		$info = array(
			'nameClient'=>$data['nameClient'],
			'status'=>$data['status'],
			'idSector'=>$data['idSector']
		 );
		$this->db->where('idClient',$id);
		$this->db->update('clients',$info);
	}

	function getSectorClients($id){
		$this->db->join('sector', 'clients.idSector = sector.idSector');
		$this->db->where('clients.idSector', $id);
		return $this->db->get("clients");
	}

	function no_pageActiveClients(){
		$number = $this->db->query("SELECT count(*) as number FROM clients WHERE status='Activo'")->row()->number;
		return intval($number);
	}
	
	function no_pageInactiveClients(){
		$number = $this->db->query("SELECT count(*) as number FROM clients WHERE status='Inactivo'")->row()->number;
		return intval($number);
	}

	function get_paginationActiveClients($number_per_page){
		$this->db->where('status',"Activo");
		$this->db->join('sector', 'clients.idSector = sector.idSector');
		return $this->db->get("clients", $number_per_page, $this->uri->segment(3));
	}

	function get_paginationInactiveClients($number_per_page){
		$this->db->where('status',"Inactivo");
		$this->db->join('sector', 'clients.idSector = sector.idSector');
		return $this->db->get("clients", $number_per_page, $this->uri->segment(3));
	}

}
?>