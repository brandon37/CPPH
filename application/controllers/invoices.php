<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class invoices extends CI_Controller {
 
  function __construct(){
      parent::__construct();
      $this->session_user();
      $this->load->model('invoice_model','',TRUE);
      $this->load->model('ordershopping_model','',TRUE);
      $this->load->library("pagination");
      $this->load->library('form_validation');

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

  function newInvoice(){
    $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
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
     $this->form_validation->set_rules('noInvoice',"",'callback_Exist_Invoice');
     if($this->form_validation->run() == FALSE)
      {
        $this->runViewInvoiceOrderShoppingProjectClientInSector($data['idOrderShopping'], $data['idProject'], $data['idClient'], $data['idSector']);
      }else{
        $this->invoice_model->newinvoice($data);
        $invoice = $this->invoice_model->getInvoiceId($data['idOrderShopping']);
        $this->check_paidInvoice($invoice->idInvoice,$data['idOrderShopping']);
        redirect('invoices/runViewInvoiceOrderShoppingProjectClientInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient'].'/'.$data['idSector']);
      }
    
  }

  function newInvoiceOrderShoppingInProject(){
    $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $this->form_validation->set_rules('noInvoice',"",'callback_Exist_Invoice');
     if($this->form_validation->run() == FALSE)
      {
        $this->runViewInvoiceOrderShoppingInProject($data['idOrderShopping'], $data['idProject']);
      }else{
        $this->invoice_model->newinvoice($data);
        $invoice = $this->invoice_model->getInvoiceId($data['idOrderShopping']);
        $this->check_paidInvoice($invoice->idInvoice,$data['idOrderShopping']);
        redirect('invoices/runViewInvoiceOrderShoppingInProject/'.$data['idOrderShopping'].'/'.$data['idProject']);
      }
  }

  function newInvoiceInOrderShopping(){
    $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $this->form_validation->set_rules('noInvoice',"",'callback_Exist_Invoice');
     if($this->form_validation->run() == FALSE)
      {
        $this->runViewInvoiceInOrderShopping($data['idOrderShopping']);
      }else{
        $this->invoice_model->newinvoice($data);
        $invoice = $this->invoice_model->getInvoiceId($data['idOrderShopping']);
        $this->check_paidInvoice($invoice->idInvoice,$data['idOrderShopping']);
        redirect('invoices/runViewInvoiceInOrderShopping/'.$data['idOrderShopping']);
      }
  }

  function newInvoiceOrderShoppingProjectInSector(){
     $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $data['idSector'] = $this->uri->segment(5); 
     $this->form_validation->set_rules('noInvoice',"",'callback_Exist_Invoice');
     if($this->form_validation->run() == FALSE)
      {
        $this->runViewInvoiceOrderShoppingProjectInSector($data['idOrderShopping'],$data['idProject'],$data['idSector']);
      }else{
       $this->invoice_model->newinvoice($data);
       $invoice = $this->invoice_model->getInvoiceId($data['idOrderShopping']);
       $this->check_paidInvoice($invoice->idInvoice,$data['idOrderShopping']);
       redirect('invoices/runViewInvoiceOrderShoppingProjectInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idSector']);
      }
  }

  function newInvoiceOrderShoppingProjectInClient(){
     $data = array(
      'noInvoice'=>$this->input->post('noInvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
      $data['idOrderShopping'] = $this->uri->segment(3);
      $data['idProject'] = $this->uri->segment(4);
      $data['idClient'] = $this->uri->segment(5);
      $this->form_validation->set_rules('noInvoice',"",'callback_Exist_Invoice');
      if($this->form_validation->run() == FALSE)
      {
        $this->runViewInvoiceOrderShoppingProjectInClient($data['idOrderShopping'], $data['idProject'], $data['idClient']);
      }else{
        $this->invoice_model->newinvoice($data);
        $invoice = $this->invoice_model->getInvoiceId($data['idOrderShopping']);
        $this->check_paidInvoice($invoice->idInvoice,$data['idOrderShopping']);
        redirect('invoices/runViewInvoiceOrderShoppingProjectInClient/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient']);
      }
  }

  function updateInvoice(){
        $data = array(
          'noinvoice'=>$this->input->post('noinvoice'),
          'status'=>$this->input->post('status'),
          'idOrderShopping'=>$this->input->post('idOrderShopping')
        );
        $this->invoice_model->updateinvoice($this->uri->segment(3),$data);
        redirect('invoices');
  }

  function updateInvoiceInOrderShopping(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    $this->check_paidInvoice($data['idInvoice'],$data['idOrderShopping']);
    redirect('invoices/runViewInvoiceInOrderShopping/'.$data['idOrderShopping']);
  }

  function updateInvoiceOrderShoppingInProject(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    $this->check_paidInvoice($data['idInvoice'],$data['idOrderShopping']);
    redirect('invoices/runViewInvoiceOrderShoppingInProject/'.$data['idOrderShopping'].'/'.$data['idProject']);
  }

  function check_status($status){
  //Field validation succeeded.  Validate against database
   $status = $this->input->post('status');
   
     if($status == "Pagado" || $status == "No Pagado") {
        return TRUE;
     }else{
       $this->form_validation->set_message('check_status', "Sorry, This Status Doesn't Exist.");
       return false;
     }
  }

  function Exist_Invoice(){
   $idOrderShopping = $this->input->post('idOrderShopping');
   $invoices = $this->invoice_model->getInvoiceOrderShopping($idOrderShopping);
   if ($invoices) 
     {
       if($invoices->num_rows()>0) 
         {
          $this->form_validation->set_message('Exist_Invoice', "No Puedes Crear Mas De Una Factura Por Orden De Compra");
           return false;
         }else
          { 
            return TRUE;
          }
     }else
       {
         return TRUE;
          
       }
  } 

  function check_paidInvoice($idInvoice,$idOrderShopping){
    $data['invoice'] = $this->invoice_model->getinvoice($idInvoice);
    if ($data['invoice']) 
      {
        if ($data['invoice']->status == "Pagado") 
          {
            $date = date("Y") . "-" . date("m") . "-" . date("d");
            $data['ordershopping'] = $this->ordershopping_model->getOrderShopping($data['invoice']->idOrderShopping);
            $info = array(
              'concept'=>$data['ordershopping']->concept,
              'amount'=>$data['ordershopping']->amount,
              'dateCreation'=>$data['ordershopping']->dateCreationOS,
              'dateTermination'=>$date,
              'idProject'=>$data['ordershopping']->idProject,
              'idDepartment'=>$data['ordershopping']->idDepartment
             );
            $this->ordershopping_model->updateOrderShopping($data['invoice']->idOrderShopping, $info);
          }else{
            $data['ordershopping'] = $this->ordershopping_model->getOrderShopping($data['invoice']->idOrderShopping);
            $info = array(
              'concept'=>$data['ordershopping']->concept,
              'amount'=>$data['ordershopping']->amount,
              'dateCreation'=>$data['ordershopping']->dateCreationOS,
              'dateTermination'=>'',
              'idProject'=>$data['ordershopping']->idProject,
              'idDepartment'=>$data['ordershopping']->idDepartment
             );
            $this->ordershopping_model->updateOrderShopping($data['invoice']->idOrderShopping, $info);
          }
      }
  }
  function Check_deleteInvoice($idInvoice){
    $data['invoice'] = $this->invoice_model->getinvoice($idInvoice);
      $data['ordershopping'] = $this->ordershopping_model->getOrderShopping($data['invoice']->idOrderShopping);
        $info = array(
          'concept'=>$data['ordershopping']->concept,
          'amount'=>$data['ordershopping']->amount,
          'dateCreation'=>$data['ordershopping']->dateCreationOS,
          'dateTermination'=>'',
          'idProject'=>$data['ordershopping']->idProject,
          'idDepartment'=>$data['ordershopping']->idDepartment
         );
        $this->ordershopping_model->updateOrderShopping($data['invoice']->idOrderShopping, $info);
  }

/*
  function check_invoice(){
    $idOrderShopping = $this->input->post('idOrderShopping');
    $no_invoice = $this->input->post('noinvoice');
    $invoices = $this->invoice_model->getInvoiceOrderShopping($idOrderShopping);
    if ($invoices) 
      {
       foreach ($invoices->result() as $opt) 
         {
            if ($no_invoice != $opt->noInvoice) {
            }else{
              $this->form_validation->set_message('check_invoice', "Sorry, This Number Invoice Exist In OrderShopping.");
              return false;
            }

          }
      }else{
        $this->form_validation->set_message('check_invoice', "Sorry, This OrderShopping Doesn't Exist.");
        return false;
      }

  }*/

  function updateInvoiceOrderShoppingProjectInClient(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    $this->check_paidInvoice($data['idInvoice'],$data['idOrderShopping']);
    redirect('invoices/runViewInvoiceOrderShoppingProjectInClient/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient']);
  }


  function updateInvoiceOrderShoppingProjectInSector(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idSector'] = $this->uri->segment(6);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    $this->check_paidInvoice($data['idInvoice'],$data['idOrderShopping']);
    redirect('invoices/runViewInvoiceOrderShoppingProjectInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idSector']);
  }

  function updateInvoiceOrderShoppingProjectClientInSector(){
    $data = array(
      'noinvoice'=>$this->input->post('noinvoice'),
      'status'=>$this->input->post('status'),
      'idOrderShopping'=>$this->input->post('idOrderShopping')
    );
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $data['idSector'] = $this->uri->segment(7);
    $this->invoice_model->updateinvoice($data['idInvoice'],$data);
    $this->check_paidInvoice($data['idInvoice'],$data['idOrderShopping']);
    redirect('invoices/runViewInvoiceOrderShoppingProjectClientInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient'].'/'.$data['idSector']);
  }

  function runViewInvoiceOrderShoppingProjectClientInSector(){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
     $result = $this->invoice_model->getInvoiceOrderShopping($data['idOrderShopping']);
     $data['query'] = $result;
     $data['idProject'] = $this->uri->segment(4);
     $data['idClient'] = $this->uri->segment(5);
     $data['idSector'] = $this->uri->segment(6);
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
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['idProject'] = $this->uri->segment(4);
     $data['idSector'] = $this->uri->segment(5);
     $result = $this->invoice_model->getInvoiceOrderShopping($data['idOrderShopping']);
     $data['query'] = $result;
     $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);    
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
     $data['idOrderShopping'] = $this->uri->segment(3);
     $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
     $data['idProject'] = $this->uri->segment(4);
     $data['idClient'] = $this->uri->segment(5);
     $result = $this->invoice_model->getInvoiceOrderShopping($data['idOrderShopping']);
     $data['query'] = $result;
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/clients/client-project-ordershopping-invoice',$data);
     $this->load->view('ehtml/footercrud');
  }

  function runViewInvoiceOrderShoppingInProject(){
    $session_data = $this->session->userdata('logged_in');
    $name = 'General';
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['email'] = $session_data['email'];
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
    $data['idProject'] = $this->uri->segment(4);
    $result = $this->invoice_model->getInvoiceOrderShopping($data['idOrderShopping']);
    $data['query'] = $result;
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
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
    $result = $this->invoice_model->getInvoiceOrderShopping($data['idOrderShopping']);
    $data['query'] = $result;
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

  function runViewEditInvoiceInOrderShopping(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['invoice'] = $this->invoice_model->getinvoice($data['idInvoice']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/ordershopping/edit-invoice-in-ordershopping',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditInvoiceOrderShoppingInProject(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['invoice'] = $this->invoice_model->getinvoice($data['idInvoice']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/projects/edit-invoice-ordershopping-in-project',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditInvoiceOrderShoppingProjectInClient(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $data['invoice'] = $this->invoice_model->getinvoice($data['idInvoice']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/clients/edit-invoice-ordershopping-project-in-client',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditInvoiceOrderShoppingProjectInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idSector'] = $this->uri->segment(6);
    $data['invoice'] = $this->invoice_model->getinvoice($data['idInvoice']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-invoice-ordershopping-project-in-sector',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditInvoiceOrderShoppingProjectClientInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $data['idSector'] = $this->uri->segment(7);
    $data['invoice'] = $this->invoice_model->getinvoice($data['idInvoice']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-invoice-ordershopping-project-client-in-sector',$data);
    $this->load->view('ehtml/footercrud');
  } 

  function deleteInvoice(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $id = $this->uri->segment(3);
    $this->invoice_model->deleteinvoice($id);
    redirect('invoices');
  
  }

  function deleteInvoiceInOrderShopping(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $this->Check_deleteInvoice($data['idInvoice']);
    $this->invoice_model->deleteinvoice($data['idInvoice']);
    redirect('invoices/runViewInvoiceInOrderShopping/'.$data['idOrderShopping']);
  }

  function deleteInvoiceOrderShoppingInProject(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $this->Check_deleteInvoice($data['idInvoice']);
    $this->invoice_model->deleteinvoice($data['idInvoice']);
    redirect('invoices/runViewInvoiceOrderShoppingInProject/'.$data['idOrderShopping'].'/'.$data['idProject']);
  }

  function deleteInvoiceOrderShoppingProjectInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idSector'] = $this->uri->segment(6);
    $this->Check_deleteInvoice($data['idInvoice']);
    $this->invoice_model->deleteinvoice($data['idInvoice']);
    redirect('invoices/runViewInvoiceOrderShoppingProjectInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idSector']);
  }

  function deleteInvoiceOrderShoppingProjectInClient(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $this->Check_deleteInvoice($data['idInvoice']);
    $this->invoice_model->deleteinvoice($data['idInvoice']);
    redirect('invoices/runViewInvoiceOrderShoppingProjectInClient/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient']);
  }

  function deleteInvoiceOrderShoppingProjectClientInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idInvoice'] = $this->uri->segment(3);
    $data['idOrderShopping'] = $this->uri->segment(4);
    $data['idProject'] = $this->uri->segment(5);
    $data['idClient'] = $this->uri->segment(6);
    $data['idSector'] = $this->uri->segment(7);
    $this->Check_deleteInvoice($data['idInvoice']);
    $this->invoice_model->deleteinvoice($data['idInvoice']);
    redirect('invoices/runViewInvoiceOrderShoppingProjectClientInSector/'.$data['idOrderShopping'].'/'.$data['idProject'].'/'.$data['idClient'].'/'.$data['idSector']);
  }

}

