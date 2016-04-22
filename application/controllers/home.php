<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('client_model', '',TRUE);
   $this->load->model('projects_model','',TRUE);
   $this->load->model('user_model','',TRUE);
   $this->load->model('ordershopping_model', '', TRUE);
 }
 
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] = $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $data['countClients'] = $this->client_model->getCountClients();
     $data['countProjects'] = $this->projects_model->getCountProjects();
     $data['countUsers'] = $this->user_model->getCountUsers();
     $data['countPayments'] = $this->ordershopping_model->getPaidOrderShoppingProject();
     $this->load->view('ehtml/header',$data);
     $this->load->view('home/index');
     $this->load->view('ehtml/footer');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
 
}