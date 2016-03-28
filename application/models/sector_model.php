<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sector_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function newSector($data){
		$this->db->insert('sector',array('typeSector'=>$data['typeSector']));
	}

	function deleteSector($id){
		
		$this->db->delete('sector', array('idSector'=>$id));
	}

	function getAllSectors(){
		$query = $this->db->get('sector');
		if($query->num_rows()>0) return $query;
		else return false;
	}

	function getSector($id){
		$this->db->where('idSector',$id);
		$query = $this->db->get('sector');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateSector($id,$data){
		$info = array(
			'typeSector'=>$data['typeSector']
		 );
		$this->db->where('idSector',$id);
		$this->db->update('sector',$info);
	}
	
	function no_page(){
		$number = $this->db->query("SELECT count(*) as number FROM sector")->row()->number;

		return intval($number);
	}

	function get_pagination($number_per_page){

		return $this->db->get("sector", $number_per_page, $this->uri->segment(3));

	}
}
?>