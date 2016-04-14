<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Sectors extends CI_Controller {
 
  function __construct(){
   	parent::__construct();
    $this->session_user();
    $this->load->library('form_validation');
   	$this->load->model('sector_model','',TRUE);
    $this->load->library("pagination");
  }

  function index(){
     $session_data = $this->session->userdata('logged_in');
     $type = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $config = $this->pagination();
     $this->pagination->initialize($config);
     $result = $this->sector_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/sectors/sectors',$data);
     $this->load->view('ehtml/footercrud');
	}

  function session_user(){
    if($this->session->userdata('logged_in'))
     {
        return TRUE;
     }
     else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
     }
  }

  function pagination(){
     $config['base_url'] = base_url()."sectors/index/";
     $config['total_rows'] = $this->sector_model->no_page();
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

  function newSector(){
    $data = array(
      'typeSector'=>$this->input->post('sector')
    );
    $this->form_validation->set_rules('sector', 'Sector', 'is_unique[sectors.typeSector]|required');
   if($this->form_validation->run() == FALSE)
    {
      $this->index();
    }else
    {
      $this->sector_model->newSector($data);
      redirect('sectors');
    }
  }

  function updateSector($id){
    $data = array(
      'typeSector'=>$this->input->post('sector')
    );

    $data['sector'] = $this->sector_model->getSector($id);
   if ($data['sector']->typeSector != $data['typeSector']) 
    {   
    
      $this->form_validation->set_rules('sector', 'Type Sector', 'required|is_unique[sectors.typeSector]');
      if($this->form_validation->run() == FALSE)
        {
          $session_data = $this->session->userdata('logged_in');
          $type = 'General';
          $data['nameUser'] = $session_data['nameUser'];
          $data['idUser'] =  $session_data['idUser'];
          $data['email'] = $session_data['email'];
          $data['id'] = $id;
          $this->load->view('ehtml/headercrud',$data);
          $this->load->helper(array('form'));
          $this->load->view('home/sectors/edit-Sector',$data);
          $this->load->view('ehtml/footercrud');

        }else{
          $this->sector_model->updateSector($id,$data);
          redirect('sectors');
        }

     }else{
        $this->sector_model->updateSector($id,$data);
        redirect('sectors');
          }  
  }

  function runViewSectorProjects($idSector){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idSector'] = $idSector;
    $this->load->model('projects_model','',TRUE);
    $data['query'] = $this->projects_model->getSectorProjects($data['idSector']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/sector_projects',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewSectorInClients($id){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $id;
    $this->load->model('client_model','',TRUE);
    $data['query'] = $this->client_model->getSectorClients($id);
    $data['sector'] = $this->sector_model->getSector($id);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/sector_clients',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditsector($id){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['sector'] = $this->sector_model->getsector($id);
    $data['id'] = $id;
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-sector',$data);
    $this->load->view('ehtml/footercrud');
  }

  function deletesector(){
    $id = $this->uri->segment(3);
    $this->sector_model->deletesector($id);
    redirect('sectors');
  }  

}
