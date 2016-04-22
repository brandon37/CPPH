<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newInvoice($data){
		$this->db->insert('invoices',array('noInvoice'=>$data['noInvoice'],'status'=>$data['status'],
			'idOrderShopping'=>$data['idOrderShopping']));
	}

	function deleteInvoice($idInvoice){
		$this->db->delete('invoices', array('idInvoice'=>$idInvoice));
	}

	function getAllInvoices(){
		$query = $this->db->get('invoices');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getInvoiceOrderShopping($idOrderShopping){
		$this->db->select('*');
		$this->db->where('invoices.idOrderShopping', $idOrderShopping);
		$this->db->FROM('invoices');
		$query = $this->db->get();
		if ($query->num_rows()>0) return $query;
		else return false;
	}

	function getInvoice($idInvoice){
		$this->db->where('idInvoice',$idInvoice);
		$query = $this->db->get('invoices');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function getInvoiceId($idOrderShopping){
		$this->db->where('idOrderShopping',$idOrderShopping);
		$query = $this->db->get('invoices');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function updateInvoice($idInvoice,$data){
		$info = array(
			'noinvoice'=>$data['noinvoice'],
			'status'=>$data['status'],
			'idOrderShopping'=>$data['idOrderShopping']
		 );
		$this->db->where('idInvoice',$idInvoice);
		$this->db->update('invoices',$info);
	}

	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM invoices")->row()->number;
		return intval($number);
	}

	function get_pagination($number_per_page){
		$query = $this->db->get("invoices", $number_per_page, $this->uri->segment(3));
		if($query->num_rows() >0) return $query;
		else return false;
	}
	
}
?>