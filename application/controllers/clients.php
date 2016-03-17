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
     $data = array('titulo' => 'Buscador con múltiples criterios', 
            'clients' => $this->busqueda());
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $data['clients'] = $this->client_model->getAllActiveClients();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/clients/active-clients',$data);
     $this->load->view('ehtml/footercrud');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 	
 }


 function inactiveClients()
 {

   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $type = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $data['clients'] = $this->client_model->getAllInactiveClients();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/clients/inactive-clients',$data);
     $this->load->view('ehtml/footercrud');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
  
 }

  function newClient(){
    if($this->session->userdata('logged_in'))
     {
        $data = array(
        'nameClient'=>$this->input->post('clientname'),
        'status'=>$this->input->post('status'),
        'idSector'=>$this->input->post('sector')
      );

      $this->client_model->newclient($data);
      redirect('clients');
     }
      else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }
  }

  function updateActiveClient(){
    if($this->session->userdata('logged_in'))
     {
        $data = array(
          'nameClient'=>$this->input->post('clientname'),
          'status'=>$this->input->post('status'),
          'idSector'=>$this->input->post('sector')
        );
        $this->client_model->updateClient($this->uri->segment(3),$data);
        redirect('clients');
      }
      else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }
  }
  function updateInactiveClient(){
    if($this->session->userdata('logged_in'))
     {
        $data = array(
          'nameClient'=>$this->input->post('clientname'),
          'status'=>$this->input->post('status'),
          'idSector'=>$this->input->post('sector')
        );
        $this->client_model->updateClient($this->uri->segment(3),$data);
        redirect('clients/inactiveClients');
      }
      else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }
  }

  function runViewEditActiveClient($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['client'] = $this->client_model->getClient($id);
        $data['id'] = $id;
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/clients/edit-active-client',$data);
        $this->load->view('ehtml/footercrud');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }

  function runViewEditInactiveClient($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['client'] = $this->client_model->getClient($id);
        $data['id'] = $id;
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/clients/edit-inactive-client',$data);
        $this->load->view('ehtml/footercrud');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }

  function deleteActiveClient(){
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

  function deleteInactiveClient(){
    if($this->session->userdata('logged_in'))
     {
        $id = $this->uri->segment(3);
        $this->client_model->deleteClient($id);
        redirect('clients/inactiveClients');
      }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

  

}