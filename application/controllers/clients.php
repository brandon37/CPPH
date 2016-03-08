<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Clients extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('client_model','',TRUE);
 }
 
 function index()
 {

 	 if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $type = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $data['clients'] = $this->client_model->getAllClients();
     $this->load->view('ehtml/header',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/clients/clients',$data);
     $this->load->view('ehtml/footer');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 	

 }
  function newClient(){
      $data = array(
      'nameClient'=>$this->input->post('clientname'),
      'status'=>$this->input->post('status'),
      'idSector'=>$this->input->post('idSector')
    );

    $this->client_model->newclient($data);
    redirect('clients');
  }
  function updateClient(){
    $data = array(
      'nameClient'=>$this->input->post('clientname'),
      'status'=>$this->input->post('status'),
      'idSector'=>$this->input->post('idSector')
    );
    $this->client_model->updateClient($this->uri->segment(3),$data);
    redirect('clients');
  }

  function runViewEditClient($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['user'] = $this->user_model->getUser($id);
        $data['id'] = $id;
        $this->load->view('ehtml/header',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/clients/edit-client',$data);
        $this->load->view('ehtml/footer');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }

  function deleteClient(){
    if($this->session->userdata('logged_in'))
     {
        $id = $this->uri->segment(3);
        $this->client_model->deleteClient($id);
        redirect('clients');
      }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }
  

}