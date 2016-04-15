<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordershopping_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newOrderShopping($data){
		$this->db->insert('orderShoppings',array('concept'=>$data['concept'],'amount'=>$data['amount'], 
			'dateCreationOS'=>$data['dateCreation'],'dateTerminationOS'=>$data['dateTermination'],'idproject'=>$data['idproject']));
	}

	function deleteOrderShopping($id){
		$this->db->delete('orderShoppings', array('idorderShopping'=>$id));
	}

	function getAllOrderShopping($id){
		$this->db->join('projects', 'orderShoppings.idproject = projects.idproject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function get_OrderShoppingsProjectClientInSector($id){
		$this->db->join('projects', 'orderShoppings.idproject = projects.idproject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('sectors','clients.idSector = sectors.idSector');
		$this->db->where('projects.idProject',$id);
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getOrderShopping($id){
		$this->db->join('projects', 'orderShoppings.idproject = projects.idproject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('idorderShopping',$id);
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function getProjectOrderShoppings($id){
		$this->db->join('projects', 'orderShoppings.idproject = projects.idproject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->where('projects.idProject',$id);
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function updateOrderShopping($id,$data){
		$info = array(
			'concept'=>$data['concept'],
			'amount'=>$data['amount'],
			'dateCreationOS'=>$data['dateCreationOS'],
			'dateTerminationOS'=>$data['dateTerminationOS'],
			'idproject'=>$data['idProject']
		 );
		$this->db->where('idorderShopping',$id);
		$this->db->update('orderShoppings',$info);
	}

	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM orderShoppings")->row()->number;
		return intval($number);
	}

	function get_pagination($number_per_page){
		$this->db->join('projects', 'orderShoppings.idproject = projects.idproject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		return $this->db->get("orderShoppings", $number_per_page, $this->uri->segment(3));
	}
	
}
?>