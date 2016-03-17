<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	 }

	 function login($username, $password)
	 {
	   $this->db->select('idUser, nameUser, email, pass, type');
	   $this->db->from('user');
	   $this->db->where('nameUser', $username);
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
    
    function getAllUsers($type){
	  	$this->db->where('type',$type);
		$query = $this->db->get('user');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getUserPass($mail){
	  	$this->db->where('email',$mail);
		$query = $this->db->get('user');
		if($query->num_rows() >0) return $query->result();
		else return false;
	}


	function newUser($data){
		$this->db->insert('user',array('nameUser'=>$data['nameUser'], 'email'=>$data['email'],'pass'=>MD5($data['passwd']),'type'=>$data['type']));
	}

	function deleteUser($id){
		$this->db->delete('user', array('idUser'=>$id));
	}

	 function getUser($id){
		$this->db->where('idUser',$id);
		$query = $this->db->get('user');
		if($query->num_rows() >0) return $query;
		else return false;
	}
	
	function updateUser($id,$data){
		$info = array('nameUser'=>$data['nameUser'],'email'=>$data['email'],
		'pass'=>MD5($data['pass']),'type'=>$data['type']);
		$this->db->where('idUser',$id);
		$this->db->update('user',$info);
	}
	function updateProfile($id,$data){
		$info = array('nameUser'=>$data['nameUser'],'email'=>$data['email'],
		'pass'=>$data['pass'],'type'=>$data['type']);
		$this->db->where('idUser',$id);
		$this->db->update('user',$info);
	}
	}
?>