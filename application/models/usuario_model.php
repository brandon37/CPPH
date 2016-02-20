<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
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
	  function obtenerUsuarios($tipo){
	  	$this->db->where('tipo',$tipo);
		$query = $this->db->get('usuarios');
		if($query->num_rows() >0) return $query;
		else return false;
	}
	
}
?>