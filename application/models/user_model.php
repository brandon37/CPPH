<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	 function __construct(){
		parent::__construct();
		$this->load->database();
	 }

	 function login($username, $password)
	 {
	   $this->db->select('idUser, nameUser, email, pass, type');
	   $this->db->from('users');
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
		$query = $this->db->get('users');
		if($query->num_rows() >0) return $query;
		else return false;
	}

	function getUserPass($pass){
	  	$this->db->where('pass',$pass);
		$query = $this->db->get('users');
		if($query->num_rows() >0) return $query->result();
		else return false;
	}

	function getUserEmail($email)
	{
		$this->db->where('email',$email);
		$query = $this->db->get('users');
		if($query->num_rows() > 0) return $query->result();
		else return false;
	}

	function newUser($data){
		$this->db->insert('users',array('nameUser'=>$data['nameUser'], 'email'=>$data['email'],'pass'=>MD5($data['pass']),'type'=>$data['type']));
	}

	function deleteUser($id){
		$this->db->delete('users', array('idUser'=>$id));
	}

	function getUser($id){
		$this->db->where('idUser',$id);
		$query = $this->db->get('users');
		if($query->num_rows() >0) return $query->row();
		else return false;
	}
	
	function updateUser($id,$data){
		$info = array('nameUser'=>$data['nameUser'],'email'=>$data['email'],
		'pass'=>MD5($data['pass']),'type'=>$data['type']);
		$this->db->where('idUser',$id);
		$this->db->update('users',$info);
	}

	function updateProfile($id,$data){
		$info = array('nameUser'=>$data['nameUser'],'email'=>$data['email'],
		'pass'=>$data['pass'],'type'=>$data['type']);
		$this->db->where('idUser',$id);
		$this->db->update('users',$info);
	}
	
	function no_page(){
		$this->db->where('type','General');
		$number = $this->db->query("SELECT count(*) as number FROM users")->row()->number;

		return intval($number);
	}

	function getCountUsers(){
		$this->db->where('type','General');
		$number = $this->db->query("SELECT count(*) as number FROM users")->row()->number;
		return intval($number);
	}

	function get_pagination($number_per_page){

		$this->db->where('type','General');
		$query = $this->db->get("users", $number_per_page, $this->uri->segment(3));
		if($query->num_rows() >0) return $query;
		else return false;

	}
	
	function search($cadena){
        $this->db->like('nameUser', $cadena, 'both');
        $this->db->or_like('nameUser', $cadena, 'before');
        $this->db->or_like('nameUser', $cadena, 'after');
 
 
        $consulta = $this->db->get('users');
 
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }else{       
            return FALSE;
        }
    }


}
?>