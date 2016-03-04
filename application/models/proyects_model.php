<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyects_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	}

	 function newProyect($data){
		$this->db->insert('proyects',array('nameProyect'=>$data['nameProyect'],'departament'=>$data['departament'], 
			'price'=>$data['price'],'dateCreation'=>$data['dateCreation'],'dateTermination'=>$data['dateTermination'],'idClient'=>$data['idClient']);
	}

	 function deleteProyect($id){
		
		$this->db->delete('proyects', array('idproyect'=>$id));
	}

	 function getAllProyects($id){
		$query = $this->db->get('proyects');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function getProyect($id){
		$this->db->where('idproyect',$id);
		$query = $this->db->get('proyects');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateProyect($id,$data){
		$info = array(
			'nameProyect'=>$data['nameProyect'],
			'departament'=>$data['departament'], 
			'price'=>$data['price'],
			'dateCreation'=>$data['dateCreation'],
			'dateTermination'=>$data['dateTermination'],
			'idClient'=>$data['idClient']
		 );
		$this->db->where('idproyect',$id);
		$this->db->update('proyects',$info);
	}
	
}
?>