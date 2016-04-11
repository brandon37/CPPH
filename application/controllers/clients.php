<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Clients extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->session_user();
   $this->load->model('client_model','',TRUE);
   $this->load->model('sector_model','',TRUE);
   $this->load->library("pagination");
   $this->load->library('form_validation');
 }

 function index(){
   $session_data = $this->session->userdata('logged_in');
   $type = 'General';
   $data['nameUser'] = $session_data['nameUser'];
   $data['idUser'] =  $session_data['idUser'];
   $data['email'] = $session_data['email'];
   $config = $this->pagination(TRUE);
   $this->pagination->initialize($config);
   $result = $this->client_model->get_paginationActiveClients($config['per_page']);
   $data['query'] = $result;
   $data['pagination'] = $this->pagination->create_links();
   $this->load->view('ehtml/headercrud',$data);
   $this->load->helper(array('form'));
   $this->load->view('home/clients/active-clients',$data);
   $this->load->view('ehtml/footercrud');
 }

 function pagination($status){
   $config['base_url'] = base_url()."clients/index/";
   if ($status) {
     $config['total_rows'] = $this->client_model->no_pageActiveClients();
   }else{
     $config['total_rows'] = $this->client_model->no_pageInactiveClients();
   }
   $config['per_page'] = 5;
   $config['use_page_numbers'] = TRUE;
   $config['num_links'] = 5;
   $config['full_tag_open'] = '<ul class="pagination">';
   $config['full_tag_close'] = '</ul>';
   $config['first_link'] = false;
   $config['last_link'] = false;
   $config['first_tag_open'] = '<li>';
   $config['first_tag_close'] = '</li>';
   $config['prev_link'] = '&laquo';
   $config['prev_tag_open'] = '<li class="prev">';
   $config['prev_tag_close'] = '</li>';
   $config['next_link'] = '&raquo';
   $config['next_tag_open'] = '<li>';
   $config['next_tag_close'] = '</li>';
   $config['last_tag_open'] = '<li>';
   $config['last_tag_close'] = '</li>';
   $config['cur_tag_open'] = '<li class="active"><a href="#">';
   $config['cur_tag_close'] = '</a></li>';
   $config['num_tag_open'] = '<li>';
   $config['num_tag_close'] = '</li>';
   return $config;
 }

 function session_user(){
    if ($this->session->userdata('logged_in')) {
      return TRUE;
    }else{
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }
 
 function inactiveClients(){
   $session_data = $this->session->userdata('logged_in');
   $type = 'General';
   $data['nameUser'] = $session_data['nameUser'];
   $data['idUser'] =  $session_data['idUser'];
   $data['email'] = $session_data['email'];
   $config = $this->pagination(false);
   $this->pagination->initialize($config);
   $result = $this->client_model->get_paginationInactiveClients($config['per_page']);
   $data['query'] = $result;
   $data['pagination'] = $this->pagination->create_links();
   $this->load->view('ehtml/headercrud',$data);
   $this->load->helper(array('form'));
   $this->load->view('home/clients/inactive-clients',$data);
   $this->load->view('ehtml/footercrud');
 }

 function newClient(){
    $data = array(
          'nameClient'=>$this->input->post('clientname'),
          'status'=>$this->input->post('status'),
          'typeSector'=>$this->input->post('typeSector'),
          'idSector'=>''
          );
    $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_database');
    $this->form_validation->set_rules('clientname', 'Name Client', 'is_unique[clients.nameClient]|required');
    $this->form_validation->set_rules('status', 'Status', 'required|callback_check_word');

     if($this->form_validation->run() == FALSE)
      {
         $session_data = $this->session->userdata('logged_in');
         $type = 'General';
         $data['nameUser'] = $session_data['nameUser'];
         $data['idUser'] =  $session_data['idUser'];
         $data['email'] = $session_data['email'];
         $config = $this->pagination(TRUE);
         $this->pagination->initialize($config);
         $result = $this->client_model->get_paginationActiveClients($config['per_page']);
         $data['query'] = $result;
         $data['pagination'] = $this->pagination->create_links();

         $this->load->view('ehtml/headercrud',$data);
         $this->load->view('home/clients/active-clients',$data);
         $this->load->view('ehtml/footercrud');
      }else{           
          $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
          $this->client_model->newclient($data);
          redirect('clients');
       }
          
  }
 
 function check_status($status){
     $status = $this->input->post('status');
     if($status == 'Activo' || $status == 'Inactivo') {
        return TRUE;
     }else{
       $this->form_validation->set_message('check_status', "Sorry, This Status Doesn't Exist.");
       return false;
     }
 }

 function check_database($typeSector){
   //Field validation succeeded.  Validate against database
   $typeSector = $this->input->post('typeSector');
 
   //query the database
   $result = $this->sector_model->getSectorId($typeSector);
 
   if($result)
     {  
      return TRUE;
     }
   else
     {
      $this->form_validation->set_message('check_database', "Sorry, This Sector Doesn't Exist.");
      return false;
     }

  }

 function updateActiveClient(){ 
    $data = array(
        'nameClient'=>$this->input->post('clientname'),
        'status'=>$this->input->post('status'),
        'typeSector'=>$this->input->post('typeSector'),
        'idSector'=>''
        );
    $id = $this->uri->segment(3);
    $data['client'] = $this->client_model->getClient($id);
    if ($data['client']->nameClient != $data['nameClient']) 
    {   
      $this->form_validation->set_rules('clientname', 'Name Client', 'is_unique[clients.nameClient]|required');

      $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_database');
      $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');

      if($this->form_validation->run() == FALSE)
        {
          $this->runViewEditActiveClient($id);
        }else{
          $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
          $this->client_model->updateClient($id,$data);
          redirect('clients');
        }
    }else{ 
        $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
        $this->client_model->updateClient($id,$data);
        redirect('clients');
     }

  }

 function updateInactiveClient(){
    $data = array(
        'nameClient'=>$this->input->post('clientname'),
        'status'=>$this->input->post('status'),
        'typeSector'=>$this->input->post('typeSector'),
        'idSector'=>$this->input->post('sector')
        );
    $id = $this->uri->segment(3);
    $data['client'] = $this->client_model->getClient($id);
    if ($data['client']->nameClient != $data['nameClient']) 
     {   
        $this->form_validation->set_rules('clientname', 'nameClient', 'is_unique[clients.nameClient]|required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('typeSector', 'Sector', 'required');
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditInactiveClient($id);
          }else{
            $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
            $this->client_model->updateClient($id,$data);
            redirect('clients/inactiveClients');
          }

     }else{
        $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
        $this->client_model->updateClient($id,$data);
        redirect('clients/inactiveClients');
     }
  }

 function runViewEditActiveClient($id){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['client'] = $this->client_model->getClient($id);
    $data['id'] = $id;
    $data['sectors'] = $this->sector_model->getAllSectors();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/clients/edit-active-client',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewClientProjects($id){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $id;
    $this->load->model('projects_model','',TRUE);
    $data['query'] = $this->projects_model->getclientProjects($data['id']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/clients/client_projects',$data);
    $this->load->view('ehtml/footercrud');
  }

 function runViewEditInactiveClient($id){
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

 function deleteActiveClient(){
    $id = $this->uri->segment(3);
    $this->client_model->deleteClient($id);
    redirect('clients'); 
  }

 function deleteInactiveClient(){
    $id = $this->uri->segment(3);
    $this->client_model->deleteClient($id);
    redirect('clients/inactiveClients');
  }

}