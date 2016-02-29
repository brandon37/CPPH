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
     $data['users'] = $this->usuario_model->obtenerUsuarios($tipo);
     $this->load->view('ehtml/header',$data);
     $this->load->view('home/users',$data);
     $this->load->view('ehtml/footer');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 	

 }
 
 
}