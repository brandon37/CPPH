<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderShopping_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newOrderShopping($data){
		$this->db->insert('orderShopping',array('concept'=>$data['concept'],'amount'=>$data['amount'], 
			'dateCreation'=>$data['dateCreation'],'dateTermination'=>$data['dateTermination'],'idProyect'=>$data['idproyect']));
	}

	function deleteOrderShopping($id){
		$this->db->delete('orderShopping', array('idorderShopping'=>$id));
	}

	function getAllOrderShopping($id){
		$this->db->join('proyects', 'orderShopping.idproyect = proyects.idproyect');
		$this->db->join('clients', 'proyects.idClient = clients.idClient');
		$query = $this->db->get('orderShopping');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getOrderShopping($id){
		$this->db->join('proyects', 'orderShopping.idproyect = proyects.idproyect');
		$this->db->join('clients', 'proyects.idClient = clients.idClient');
		$this->db->where('idorderShopping',$id);
		$query = $this->db->get('orderShopping');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function updateOrderShopping($id,$data){
		$info = array(
			'concept'=>$data['concept'],
			'amount'=>$data['amount'],
			'dateCreation'=>$data['dateCreation'],
			'dateTermination'=>$data['dateTermination']
		 );
		$this->db->where('idorderShopping',$id);
		$this->db->update('orderShopping',$info);
	}

	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM orderShopping")->row()->number;
		return intval($number);
	}

	function get_pagination($number_per_page){
		$this->db->join('proyects', 'orderShopping.idproyect = proyects.idproyect');
		$this->db->join('clients', 'proyects.idClient = clients.idClient');
		return $this->db->get("orderShopping", $number_per_page, $this->uri->segment(3));
	}
	
}
?>