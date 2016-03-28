<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyects_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newProyect($data){
		$this->db->insert('proyects',
			array('nameProyect'=>$data['nameProyect'],
				'department'=>$data['department'],
				'price'=>$data['price'],
				'dateCreation'=>$data['dateCreation'],
				'dateTermination'=>$data['dateTermination'],
				'idClient'=>$data['idClient']));
	}

	 function deleteProyect($id){
		$this->db->delete('proyects', array('idProyect'=>$id));
	}

	 function getAllProyects(){
	 	$this->db->select('*');
		$this->db->from('proyects');
		$this->db->join('proyects', 'proyects.idClient = proyects.idClient');
		$query = $this->db->get();
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getProyect($id){
		$this->db->where('idProyect',$id);
		$query = $this->db->get('proyects');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateProyect($id,$data){
		$info = array(
			'nameProyect'=>$data['nameProyect'],
			'department'=>$data['department'], 
			'price'=>$data['price'],
			'dateCreation'=>$data['dateCreation'],
			'dateTermination'=>$data['dateTermination'],
			'idClient'=>$data['idClient']
		 );
		$this->db->where('idProyect',$id);
		$this->db->update('proyects',$info);
	}

	function no_page(){

		$number = $this->db->query("SELECT count(*) as number FROM proyects")->row()->number;

		return intval($number);
	}

	function get_pagination($number_per_page){

		$this->db->join('clients', 'proyects.idClient = clients.idClient');
		return $this->db->get("proyects", $number_per_page, $this->uri->segment(3));
	}
	
	
}
?>