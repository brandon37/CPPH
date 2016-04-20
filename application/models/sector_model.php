<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sector_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newSector($data){
		$this->db->insert('sectors',array('typeSector'=>$data['typeSector']));
	}

	function deleteSector($id){
		
		$this->db->delete('sectors', array('idSector'=>$id));
	}

	function getAllSectors(){
		$query = $this->db->get('sectors');
		if($query->num_rows()>0) return $query;
		else return false;
	}

	function getSector($id){
		$this->db->where('idSector',$id);
		$query = $this->db->get('sectors');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	function getSectorId($typeSector){
		$this->db->where('typeSector',$typeSector);
		$query = $this->db->get('sectors');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}

	 function updateSector($id,$data){
		$info = array(
			'typeSector'=>$data['typeSector']
		 );
		$this->db->where('idSector',$id);
		$this->db->update('sectors',$info);
	}
	
	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM sectors")->row()->number;

		return intval($number);
	}

	function get_pagination($number_per_page){
		$query = $this->db->get("sectors", $number_per_page, $this->uri->segment(3));
		if($query->num_rows() >0) return $query->row();
		else return false;
	}
}
?>