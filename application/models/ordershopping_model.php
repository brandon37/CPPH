<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordershopping_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newOrderShopping($data){
		$this->db->insert('orderShoppings',array('concept'=>$data['concept'],'amount'=>$data['amount'], 
			'dateCreationOS'=>$data['dateCreation'],'dateTerminationOS'=>$data['dateTermination'],'idProject'=>$data['idProject'], 'idDepartment'=>$data['idDepartment']));
	}

	function deleteOrderShopping($idOrderShopping){
		$this->db->delete('orderShoppings', array('idOrderShopping'=>$idOrderShopping));
	}

	function getAllOrderShopping($idOrderShopping){
		$this->db->join('projects', 'orderShoppings.idProject = projects.idProject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('departments', 'orderShoppings.idDepartment = departments.idDepartment');
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function get_OrderShoppingsProjectClientInSector($idProject){
		$this->db->join('projects', 'orderShoppings.idProject = projects.idProject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('sectors','clients.idSector = sectors.idSector');
		$this->db->join('departments', 'orderShoppings.idDepartment = departments.idDepartment');
		$this->db->where('projects.idProject',$idProject);
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getOrderShopping($idOrderShopping){
		$this->db->join('projects', 'orderShoppings.idProject = projects.idProject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('departments', 'orderShoppings.idDepartment = departments.idDepartment');
		$this->db->where('idOrderShopping',$idOrderShopping);
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function getProjectOrderShoppings($idProject){
		$this->db->join('projects', 'orderShoppings.idProject = projects.idProject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('departments', 'orderShoppings.idDepartment = departments.idDepartment');
		$this->db->where('projects.idProject',$idProject);
		$query = $this->db->get('orderShoppings');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function updateOrderShopping($idOrderShopping,$data){
		$info = array(
			'concept'=>$data['concept'],
			'amount'=>$data['amount'],
			'dateCreationOS'=>$data['dateCreation'],
			'dateTerminationOS'=>$data['dateTermination'],
			'idProject'=>$data['idProject'],
			'idDepartment'=>$data['idDepartment']
		 );
		$this->db->where('idOrderShopping',$idOrderShopping);
		$this->db->update('orderShoppings',$info);
	}

	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM orderShoppings")->row()->number;
		return intval($number);
	}

	function sumAmountOrderShoppingProject($idProject){
		$number = $this->db->query("SELECT SUM(amount) as number FROM orderShoppings WHERE idProject='$idProject' ")->row()->number;
		return intval($number);
	}

	function paidOrderShoppingProject($idProject){
		$query = $this->db->query("SELECT (dateTerminationOS)  FROM orderShoppings WHERE idProject='$idProject' AND dateTerminationOS='' ");
		if($query->num_rows() >0) return false;
		else return true;
	}

	function get_pagination($number_per_page){
		$this->db->join('projects', 'orderShoppings.idProject = projects.idProject');
		$this->db->join('clients', 'projects.idClient = clients.idClient');
		$this->db->join('departments', 'orderShoppings.idDepartment = departments.idDepartment');
		$query = $this->db->get("orderShoppings", $number_per_page, $this->uri->segment(3));
		if($query->num_rows() >0) return $query;
		else return false;
	}
	
}







?>