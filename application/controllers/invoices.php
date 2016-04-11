<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class invoices extends CI_Controller {
 
  function __construct(){
      parent::__construct();
      $this->session_user();
      $this->load->model('invoice_model','',TRUE);
      $this->load->library("pagination");

  }

  function index(){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $config = $this->pagination();
     $this->pagination->initialize($config);
     $result = $this->invoice_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/invoice/invoice',$data);
     $this->load->view('ehtml/footercrud');
    
  }

  function session_user(){
    if($this->session->userdata('logged_in')){
       return TRUE;
     }
     else{
        //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }
  
  function pagination(){
     $config['base_url'] = base_url()."invoices/index/";
     $config['total_rows'] = $this->invoice_model->no_page();
     $config['per_page'] = 5;
     $config['use_page_numbers'] = TRUE;
     $config['num_links'] = 2;
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

  function newinvoice(){
      $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>1
    );

      $this->invoice_model->newinvoice($data);
      redirect('invoices');
  }

  function updateinvoice(){
        $data = array(
          'noinvoice'=>$this->input->post('noinvoice'),
          'status'=>$this->input->post('status')
        );
        $this->invoice_model->updateinvoice($this->uri->segment(3),$data);
        redirect('invoices');
  }

  function runViewEditinvoice($id){
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['invoice'] = $this->invoice_model->getinvoice($id);
        $data['id'] = $id;
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/invoice/edit-invoice',$data);
        $this->load->view('ehtml/footercrud');

  }

  function deleteinvoice(){
        $id = $this->uri->segment(3);
        $this->invoice_model->deleteinvoice($id);
        redirect('invoices');
  
  }

}