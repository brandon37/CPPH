<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Users extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('usuario_model','',TRUE);
 }
 
 function index()
 {

 	 if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $tipo = 'General';
     $data['username'] = $session_data['nombre'];
     $data['users'] = $this->usuario_model->getAllUsers($tipo);
     $this->load->view('ehtml/header',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/users',$data);
     $this->load->view('ehtml/footer');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 	

 }
  function newUser(){
      $data = array(
      'username'=>$this->input->post('username'),
      'email'=>$this->input->post('email'),
      'passwd'=>$this->input->post('password'),
      'tipo'=>"General"
    );

    $this->usuario_model->newUser($data);
    redirect('users');
  }
  function updateUser($id){
    $data['curso'] = $this->hydralab_model->obtenerCurso($id);
    $data['id'] = $id;
    $this->load->view('ehtml/header',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/users',$data);
    $this->load->view('ehtml/footer');
  }
  function deleteUser(){
    $id = $this->uri->segment(3);
    $this->usuario_model->deleteUser($id);
    redirect('users');
  }
  
 
}