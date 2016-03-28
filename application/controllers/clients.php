<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Clients extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('client_model','',TRUE);
 }
 function index(){
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $type = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $this->load->library("pagination");
     $config['base_url'] = base_url()."clients/index/";
     $config['total_rows'] = $this->client_model->no_pageActiveClients();
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
     $this->pagination->initialize($config);
     $result = $this->client_model->get_paginationActiveClients($config['per_page']);
     $data['query'] = $result;
     $data['pagination'] = $this->pagination->create_links();
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
     $this->load->library("pagination");
     $config['base_url'] = base_url()."clients/inactiveClients/";
     $config['total_rows'] = $this->client_model->no_pageInactiveClients();
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
     $this->pagination->initialize($config);
     $result = $this->client_model->get_paginationInactiveClients($config['per_page']);
     $data['query'] = $result;
     $data['pagination'] = $this->pagination->create_links();
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