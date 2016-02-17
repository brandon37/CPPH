<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		

	}

	function login($username, $password)
	 {
	   $this->db->select('idusuarios, nombre, email, pass, tipo');
	   $this->db->from('usuarios');
	   $this->db->where('nombre', $username);
	   $this->db->where('pass', MD5($password));
	   $this->db->limit(1);
	 
	   $query = $this->db->get();
	 
	   if($query->num_rows() == 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	 }
	
}
?>