<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class invoices extends CI_Controller {
 
  function __construct(){
      parent::__construct();
      $this->session_user();
      $this->load->model('invoice_model','',TRUE);
      $this->load->model('ordershopping_model','',TRUE);
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
      redirect('invoices/');
  }

  function newInvoiceOrderShoppingProjectClientInSector(){
     $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $data['idClient'] = $this->uri->segment(5);
     $data['idSector'] = $this->uri->segment(6);
     $this->invoice_model->newinvoice($data);
      redirect('invoices/runViewInvoiceOrderShoppingProjectClientInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient'].'/'.$data['idSector']);
  }

  function newInvoiceOrderShoppingInProject(){
    $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $this->invoice_model->newinvoice($data);
      redirect('invoices/runViewInvoiceOrderShoppingInProject/'.$data['idOrderShopping'].'/'.$data['idProject']);
  }

  function newInvoiceOrderShoppingProjectInSector(){
     $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $data['idSector'] = $this->uri->segment(6);
     $this->invoice_model->newinvoice($data);
      redirect('invoices/runViewInvoiceOrderShoppingProjectInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idSector']);
  }

  function newInvoiceOrderShoppingProjectInClient(){
     $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $data['idClient'] = $this->uri->segment(6);
     $this->invoice_model->newinvoice($data);
      redirect('invoices/runViewInvoiceOrderShoppingProjectInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient']);
  }

  function newInvoiceOrderShoppingProjectInDepartment(){
     $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $data['idDepartment'] = $this->uri->segment(6);
     $this->invoice_model->newinvoice($data);
      redirect('invoices/runViewInvoiceOrderShoppingProjectInDepartment/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idDepartment']);
  }

  function updateinvoice(){
        $data = array(
          'noinvoice'=>$this->input->post('noinvoice'),
          'status'=>$this->input->post('status')
        );
        $this->invoice_model->updateinvoice($this->uri->segment(3),$data);
        redirect('invoices');
  }

  function runViewInvoiceOrderShoppingProjectClientInSector(){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $config = $this->pagination();
     $this->pagination->initialize($config);
     $result = $this->invoice_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
     $data['idProject'] = $this->uri->segment(4);
     $data['idClient'] = $this->uri->segment(5);
     $data['idSector'] = $this->uri->segment(6);
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/sectors/sector-client-project-ordershopping-invoice',$data);
     $this->load->view('ehtml/footercrud');
  }

  function runViewInvoiceOrderShoppingProjectInSector(){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $config = $this->pagination();
     $this->pagination->initialize($config);
     $result = $this->invoice_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
     $data['idProject'] = $this->uri->segment(4);
     $data['idSector'] = $this->uri->segment(5);
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/sectors/sector-project-ordershopping-invoice',$data);
     $this->load->view('ehtml/footercrud');
  }

  function runViewInvoiceOrderShoppingProjectInClient(){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $config = $this->pagination();
     $this->pagination->initialize($config);
     $result = $this->invoice_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
     $data['idProject'] = $this->uri->segment(4);
     $data['idClient'] = $this->uri->segment(5);
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/clients/client-project-ordershopping-invoice',$data);
     $this->load->view('ehtml/footercrud');
  }

  function runViewInvoiceOrderShoppingProjectInDepartment(){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $config = $this->pagination();
     $this->pagination->initialize($config);
     $result = $this->invoice_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
     $data['idProject'] = $this->uri->segment(4);
     $data['idDepartment'] = $this->uri->segment(5);
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/departments/department-project-ordershopping-invoice',$data);
     $this->load->view('ehtml/footercrud');
  }

  function runViewInvoiceOrderShoppingInProject(){
    $session_data = $this->session->userdata('logged_in');
    $name = 'General';
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['email'] = $session_data['email'];
    $config = $this->pagination();
    $this->pagination->initialize($config);
    $result = $this->invoice_model->get_pagination($config['per_page']);
    $data['query'] = $result;
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
    $data['idProject'] = $this->uri->segment(4);
    $data['pagination'] = $this->pagination->create_links();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/projects/project-ordershopping-invoice',$data);
    $this->load->view('ehtml/footercrud');
  
  }

  function runViewInvoiceInOrderShopping(){
    $session_data = $this->session->userdata('logged_in');
    $name = 'General';
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['email'] = $session_data['email'];
    $config = $this->pagination();
    $this->pagination->initialize($config);
    $result = $this->invoice_model->get_pagination($config['per_page']);
    $data['query'] = $result;
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
    $data['pagination'] = $this->pagination->create_links();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/ordershopping/ordershopping-invoice',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditinvoice(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['invoice'] = $this->invoice_model->getinvoice($data['idInvoice']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/invoice/edit-invoice',$data);
    $this->load->view('ehtml/footercrud');
  }
  
  function updateInvoiceOrderShoppingProjectInSector(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idSector'] = $this->uri->segment(6);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    redirect('invoices/runViewInvoiceOrderShoppingProjectInSector/'.$data['idInvoice'].'/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idSector']);
  }

  function updateInvoiceOrderShoppingInProject(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    redirect('invoices/runViewInvoiceOrderShoppingInProject/'.$data['idInvoice'].'/'.$data['idOrderShopping'].'/'.$data['idProject']);
  }

  function updateInvoiceOrderShoppingProjectInClient(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    redirect('invoices/runViewInvoiceOrderShoppingProjectInClient/'.$data['idInvoice'].'/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient']);
  }

  function updateInvoiceOrderShoppingProjectClientInSector(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $data['idSector'] = $this->uri->segment(7);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    redirect('invoices/runViewInvoiceOrderShoppingProjectClientInSector/'.$data['idInvoice'].'/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient'].'/'.$data['idSector']);
  }

  function deleteinvoice(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $id = $this->uri->segment(3);
    $this->invoice_model->deleteinvoice($id);
    redirect('invoices');
  
  }

}