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
    function getAllUsers($tipo){
	  	$this->db->where('tipo',$tipo);
		$query = $this->db->get('usuarios');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getUserPass($mail){
	  	$this->db->where('email',$mail);
		$query = $this->db->get('usuarios');
		if($query->num_rows() >0) return $query->result();
		else return false;
	}
	function newUser($data){
		$this->db->insert('usuarios',array('nombre'=>$data['username'], 'email'=>$data['email'],'pass'=>MD5($data['passwd']),'tipo'=>$data['tipo']));
	}

	function deleteUser($id){
		
		$this->db->delete('usuarios', array('idusuarios'=>$id));
	}

	 function getUser($id){
		$this->db->where('idusuarios',$id);
		$query = $this->db->get('usuarios');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	 function updateUser($id,$data){
		$datos = array('nombre'=>$data['nomre'],'email'=>$data['email'],
		'pass'=>$data['passwd'],'tipo'=>$data['tipo']);
		$this->db->where('idusuarios',$id);
		$this->db->update('usuarios',$datos);
	}
	}
?>