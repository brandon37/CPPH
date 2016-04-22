<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Payments extends CI_Controller {
 
 function __construct(){
   parent::__construct();
   $this->session_user();
   $this->load->library('form_validation');
   $this->load->model('client_model','',TRUE);
   $this->load->model('projects_model','',TRUE);
   $this->load->model('department_model','',TRUE); 
   $this->load->model('sector_model','', TRUE);
   $this->load->library("pagination");
 }

 function index()
 {
   $session_data = $this->session->userdata('logged_in');
   $type = 'General';
   $data['nameUser'] = $session_data['nameUser'];
   $data['idUser'] =  $session_data['idUser'];
   $data['email'] = $session_data['email'];
   $config = $this->pagination();
   $this->pagination->initialize($config);
   $data['query'] = $this->projects_model->getAllProjects();
   $data['clients'] = $this->client_model->getAllClients();
   $data['pagination'] = $this->pagination->create_links();
   $this->load->view('ehtml/headercrud',$data);
   $this->load->helper(array('form'));
   $this->load->view('home/payments/payments',$data);
   $this->load->view('ehtml/footercrud');
 }

 function pagination(){
   $config['base_url'] = base_url()."projects/index/";
   $config['total_rows'] = $this->projects_model->no_page();
   $config['per_page'] = 6;
   //$config['use_page_numbers'] = TRUE;
   $config['uri_segment'] = 3;
   $config['num_links'] = 6;
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

} 