<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderShopping_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newOrderShopping($data){
		$this->db->insert('orderShopping',array('concept'=>$data['concept'],'amount'=>$data['amount']), 
			'dateCreation'=>$data['dateCreation'],'dateTermination'=>$data['dateTermination'],'idProyect'=>$data['idProyect']);
	}

	 function deleteOrderShopping($id){
		$this->db->delete('orderShopping', array('idorderShopping'=>$id));
	}
	function getAllOrderShopping($id){
		$query = $this->db->get('orderShopping');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getOrderShopping($id){
		$this->db->where('idorderShopping',$id);
		$query = $this->db->get('orderShopping');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateOrderShopping($id,$data){
		$info = array(
			'concept'=>$data['concept'],
			'amount'=>$data['amount'],
			'dateCreation'=>$data['dateCreation'],
			'dateTermination'=>$data['dateTermination'],
			'idProyect'=>$data['idProyect']
		 );
		$this->db->where('idorderShopping',$id);
		$this->db->update('orderShopping',$info);
	}
	
}
?>