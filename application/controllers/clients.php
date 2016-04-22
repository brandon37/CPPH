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
   $this->load->model('projects_model','',TRUE);
   $this->load->model('department_model','',TRUE);
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
   $data['sectors'] = $this->sector_model->getAllSectors();
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
    $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
    $this->form_validation->set_rules('clientname', 'Name Client', 'is_unique[clients.nameClient]|required');
    $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');

     if($this->form_validation->run() == FALSE)
      {
        $this->index();
      }else{           
          $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
          $this->client_model->newclient($data);
          redirect('clients');
       }
          
  }

  function newClientInSector(){
    $data = array(
          'nameClient'=>$this->input->post('clientname'),
          'status'=>$this->input->post('status'),
          'typeSector'=>$this->input->post('typeSector'),
          'idSector'=>''
          );
    $data['idSector'] = $this->uri->segment(3);
    $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
    $this->form_validation->set_rules('clientname', 'Name Client', 'is_unique[clients.nameClient]|required');
    $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');

     if($this->form_validation->run() == FALSE)
      {
        $this->runViewSectorClients($data['idSector']);
      }else{           
          $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
          $this->client_model->newclient($data);
          redirect('clients/runViewSectorClients/'.$data['idSector']);
       }   
  }
 
 function check_status($status){
  //Field validation succeeded.  Validate against database
   $status = $this->input->post('status');
   
     if($status == "Activo" || $status == "Inactivo") {
        return TRUE;
     }else{
       $this->form_validation->set_message('check_status', "Sorry, This Status Doesn't Exist.");
       return false;
     }
 }

 function check_sector($typeSector){
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
      $this->form_validation->set_message('check_sector', "Sorry, This Sector Doesn't Exist.");
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
      $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
      $this->form_validation->set_rules('clientname', 'Name Client', 'is_unique[clients.nameClient]|required');
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
      $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
      $this->form_validation->set_rules('clientname', 'Name Client', 'required');
      $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');
      if($this->form_validation->run() == FALSE)
        {
          $this->runViewEditActiveClient($id);
        }else{
          $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
          $this->client_model->updateClient($id,$data);
          redirect('clients');
        }
     }

  }
  
  function updateClientInSector(){
    $data = array(
        'nameClient'=>$this->input->post('clientname'),
        'status'=>$this->input->post('status'),
        'typeSector'=>$this->input->post('typeSector'),
        'idSector'=>''
        );
    $data['id'] = $this->uri->segment(3);
    $data['idSect'] = $this->uri->segment(4);
    $data['client'] = $this->client_model->getClient($data['id']);
    if ($data['client']->nameClient != $data['nameClient']) 
    {   
      $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
      $this->form_validation->set_rules('clientname', 'Name Client', 'is_unique[clients.nameClient]|required');
      $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');

      if($this->form_validation->run() == FALSE)
        {
          $this->runViewEditClientInSector($data['id'],$data['idSect']);
        }else{
          $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
          $this->client_model->updateClient($data['id'],$data);
          redirect('clients/runViewSectorClients/'.$data['idSect']);
        }
    }else{ 
      $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
      $this->form_validation->set_rules('clientname', 'Name Client', 'required');
      $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');
      if($this->form_validation->run() == FALSE)
        {
          $this->runViewEditActiveClient($data['id']);
        }else{
          $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
          $this->client_model->updateClient($data['id'],$data);
          redirect('clients/runViewSectorClients/'.$data['idSect']);
        }
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
        $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
        $this->form_validation->set_rules('clientname', 'Name Client', 'is_unique[clients.nameClient]|required');
        $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditInactiveClient($id);
          }else{
            $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
            $this->client_model->updateClient($id,$data);
            redirect('clients/inactiveClients');
          }

     }else{
        $this->form_validation->set_rules('typeSector', 'Sector', 'required|trim|callback_check_sector');
        $this->form_validation->set_rules('clientname', 'Name Client', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditInactiveClient($id);
          }else{
            $data['idSector'] = $this->sector_model->getSectorId($data['typeSector'])->idSector;
            $this->client_model->updateClient($id,$data);
            redirect('clients/inactiveClients');
          }
     }
  }

 function runViewEditActiveClient(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $this->uri->segment(3);
    $data['client'] = $this->client_model->getClient($data['id']);
    $data['sector'] = $this->sector_model->getSector($data['client']->idSector);
    $data['sectors'] = $this->sector_model->getAllSectors();
    if ($data['client']) {  
      $this->load->view('ehtml/headercrud',$data);
      $this->load->helper(array('form'));
      $this->load->view('home/clients/edit-active-client',$data);
      $this->load->view('ehtml/footercrud');
    }else{
      redirect('clients');
    }
  }

  function runViewEditClientInSector(){
   $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $this->uri->segment(3);
    $data['idSector'] = $this->uri->segment(4);
    $data['client'] = $this->client_model->getClient($data['id']);
    $data['sector'] = $this->sector_model->getSector($data['client']->idSector);
    $data['sectors'] = $this->sector_model->getAllSectors();
    if ($data['client']) {
      $this->load->view('ehtml/headercrud',$data);
      $this->load->helper(array('form'));
      $this->load->view('home/sectors/edit-client',$data);
      $this->load->view('ehtml/footercrud'); 
    }else{
      redirect('sectors');
    }
    
  }

  function runViewSectorClients(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idSector'] = $this->uri->segment(3);
    $this->load->model('client_model','',TRUE);
    $data['query'] = $this->client_model->getSectorClients($data['idSector']);
    $data['sector'] = $this->sector_model->getSector($data['idSector']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/sector_clients',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewClientProjectsInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idClient'] = $this->uri->segment(3);
    $data['idSector'] = $this->uri->segment(4);
    $data['query'] = $this->projects_model->getclientProjects($data['idClient']);
    $data['client'] = $this->client_model->getClient($data['idClient']);
    $data['departments'] = $this->department_model->getAllDepartments();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/sector_client_projects',$data);
    $this->load->view('ehtml/footercrud');
  }

 function runViewEditInactiveClient(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $this->uri->segment(3);
    $data['client'] = $this->client_model->getClient($data['id']);
    $data['sector'] = $this->sector_model->getSector($data['client']->idSector);
    $data['sectors'] = $this->sector_model->getAllSectors();
    if ($data['client']) {
      $this->load->view('ehtml/headercrud',$data);
      $this->load->helper(array('form'));
      $this->load->view('home/clients/edit-inactive-client',$data);
      $this->load->view('ehtml/footercrud');
    }else{
      redirect('clients');
    }
    
  }

 function deleteActiveClient(){
    $id = $this->uri->segment(3);
    $this->client_model->deleteClient($id);
    redirect('clients'); 
  }

  function deleteClientInSector($idClient, $idSector){
    $this->client_model->deleteClient($idClient);
    redirect('clients/runViewSectorClients/'.$idSector);
  }

 function deleteInactiveClient(){
    $id = $this->uri->segment(3);
    $this->client_model->deleteClient($id);
    redirect('clients/inactiveClients');
  }

}
