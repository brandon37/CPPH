<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Proyects extends CI_Controller {
 
 function __construct(){
   parent::__construct();
   $this->load->model('proyects_model','',TRUE);
   $this->load->library('form_validation');
   $this->load->model('client_model','',TRUE);
   $this->load->model('department_model','',TRUE);
   $this->load->model('proyects_model','',TRUE);
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
     $this->load->library("pagination");
     $config['base_url'] = base_url()."proyects/index";
     $config['total_rows'] = $this->proyects_model->no_page();
     $config['per_page'] = 6;
     $config['use_page_numbers'] = TRUE;
     //$config['uri_segment'] = 3;
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
     $this->pagination->initialize($config);
     $result = $this->proyects_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/proyects/proyects',$data);
     $this->load->view('ehtml/footercrud');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 	
 }

  function newproyect(){
    if($this->session->userdata('logged_in'))
     {
        $data = array(
        'idProyect'=>"",
        'idDepartment'=>"",
        'nameProyect'=>$this->input->post('proyectname'),
        'nameDepartment'=>$this->input->post('department'),
        'price'=>$this->input->post('price'),
        'dateCreation'=>$this->input->post('dateCreation'),
        'dateTermination'=>"",
        'nameClient'=>$this->input->post('nameClient')
      );

        $this->form_validation->set_rules('proyectname', 'Name Proyect', 'is_unique[proyects.nameProyect]|required|callback_check_proyect');
        $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');

        $this->form_validation->set_rules('dateCreation','Date', 'required');
        $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
       if($this->form_validation->run() == FALSE)
        {

           $session_data = $this->session->userdata('logged_in');
           $type = 'General';
           $data['nameUser'] = $session_data['nameUser'];
           $data['idUser'] =  $session_data['idUser'];
           $data['email'] = $session_data['email'];
           $this->load->library("pagination");
           $config['base_url'] = base_url()."proyects/index";
           $config['total_rows'] = $this->proyects_model->no_page();
           $config['per_page'] = 6;
           $config['use_page_numbers'] = TRUE;
           //$config['uri_segment'] = 3;
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
           $this->pagination->initialize($config);
           $result = $this->proyects_model->get_pagination($config['per_page']);
           $data['query'] = $result;
           $data['pagination'] = $this->pagination->create_links();
           $this->load->view('ehtml/headercrud',$data);
           $this->load->helper(array('form'));
           $this->load->view('home/proyects/proyects',$data);
           $this->load->view('ehtml/footercrud');
        }else{

            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $this->proyects_model->newproyect($data);

            $queryProyect =  $this->proyects_model->getProyectId($data['nameProyect']);
            $data['idProyect'] = $queryProyect->idProyect;

            
            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;


            $this->proyects_model->indexDepartment($data);
            redirect('proyects');
        }

     }
      else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }
  }

  function check_department($nameDepartment){
    if($this->session->userdata('logged_in'))
     {
        $nameDepartment_db =  $this->department_model->getDepartmentId($this->input->post('department'))->nameDepartment;
        
        if ($nameDepartment == $nameDepartment_db) 
         {
            return TRUE;

         }else
          {
            $this->form_validation->set_message('check_department', "Sorry, This Department Doesn't Exist.");
            return false;
          }

      }else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }

  } 

  function check_proyect($nameProyect){
    if($this->session->userdata('logged_in'))
     {
        $this->load->model('proyects_model','',TRUE);
        $nameProyect_db =  $this->proyects_model->getProyectId($this->input->post('proyectname'))->nameProyect;
        
        if ($nameProyect == $nameProyect_db) 
         {
            return TRUE;

         }else
          {
            $this->form_validation->set_message('check_proyect', "Sorry, This Proyect Doesn't Exist.");
            return false;
          }

      }else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }

  } 

  function check_client($nameclient){
    if($this->session->userdata('logged_in'))
     {
        $queryclient =  $this->client_model->getClientId($this->input->post('nameClient'));
        $nameclient_db = null;
        if ($queryclient) 
          {
            $nameclient_db = $queryclient->nameClient;
          }

        if($nameclient == $nameclient_db) 
           {
             return TRUE;

           }else
             {
                $this->form_validation->set_message('check_client', "Sorry, This Client Doesn't Exist.");
                return false;
             }

      }else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }

  } 


  function updateProyect(){
     if($this->session->userdata('logged_in'))
     {
          $data = array(
          'idProyect'=>"",
          'idDepartment'=>"",
          'nameProyect'=>$this->input->post('proyectname'),
          'nameDepartment'=>$this->input->post('department'),
          'price'=>$this->input->post('price'),
          'dateCreation'=>$this->input->post('dateCreation'),
          'dateTermination'=>$this->input->post('dateTermination'),
          'nameClient'=>$this->input->post('nameClient')
        );

          $this->form_validation->set_rules('proyectname', 'Name Proyect', 'required|callback_check_proyect');
          $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
          $this->form_validation->set_rules('price', 'Price', 'required|numeric');

          $this->form_validation->set_rules('dateCreation','Date', 'required');
          $this->form_validation->set_rules('dateTermination','Date', 'required');
          $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
          $id = $this->uri->segment(3);
          if($this->form_validation->run() == FALSE)
            {
              $session_data = $this->session->userdata('logged_in');
              $data['nameUser'] = $session_data['nameUser'];
              $data['idUser'] =  $session_data['idUser'];
              $data['proyect'] = $this->proyects_model->getProyect($id);
              $data['id'] = $id;
              $this->load->view('ehtml/headercrud',$data);
              $this->load->helper(array('form'));
              $this->load->view('home/proyects/edit-proyect',$data);
              $this->load->view('ehtml/footercrud');

            }else{
              $queryclient =  $this->client_model->getClientId($data['nameClient']);
              $data['idClient'] = $queryclient->idClient;

              $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
              $data['idDepartment'] = $queryDepartment->idDepartment;

              $this->proyects_model->updateProyect($id,$data);

              $this->proyects_model->updateIndexDepartment($id,$data);
              redirect('proyects');
            }
              
     }
      else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }
  }

  function runViewEditProyect($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['proyect'] = $this->proyects_model->getProyect($id);
        $data['id'] = $id;
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/proyects/edit-proyect',$data);
        $this->load->view('ehtml/footercrud');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }


  function deleteProyect(){
    if($this->session->userdata('logged_in'))
     {
        $id = $this->uri->segment(3);
        $this->proyects_model->deleteproyect($id);
        redirect('proyects');
      }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

}