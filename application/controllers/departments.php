<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Departments extends CI_Controller {
 
  function __construct(){
      parent::__construct();
      $this->load->model('department_model','',TRUE);
  }

  function index(){
	  if($this->session->userdata('logged_in')){
	     $session_data = $this->session->userdata('logged_in');
	     $name = 'General';
	     $data['nameUser'] = $session_data['nameUser'];
	     $data['idUser'] =  $session_data['idUser'];
	     $data['email'] = $session_data['email'];
       $this->load->library("pagination");
       $config['base_url'] = base_url()."departments/index/";
       $config['total_rows'] = $this->department_model->no_page();
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
       $this->pagination->initialize($config);
       $result = $this->department_model->get_pagination($config['per_page']);
       $data['query'] = $result;
       $data['pagination'] = $this->pagination->create_links();
	     $this->load->view('ehtml/headercrud',$data);
	     $this->load->helper(array('form'));
	     $this->load->view('home/departments/departments',$data);
	     $this->load->view('ehtml/footercrud');
	   }
    else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
	}

  function newDepartment(){
    if($this->session->userdata('logged_in')){

      $data = array(
      'nameDepartment'=>$this->input->post('department')
      );

        $this->load->library('form_validation');
        $this->form_validation->set_rules('department', 'Department', 'is_unique[department.nameDepartment]|required');
       if($this->form_validation->run() == FALSE)
        {
           $session_data = $this->session->userdata('logged_in');
           $name = 'General';
           $data['nameUser'] = $session_data['nameUser'];
           $data['idUser'] =  $session_data['idUser'];
           $data['email'] = $session_data['email'];
           $this->load->library("pagination");
           $config['base_url'] = base_url()."departments/index/";
           $config['total_rows'] = $this->department_model->no_page();
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
           $this->pagination->initialize($config);
           $result = $this->department_model->get_pagination($config['per_page']);
           $data['query'] = $result;
           $data['pagination'] = $this->pagination->create_links();
           $this->load->view('ehtml/headercrud',$data);
           $this->load->helper(array('form'));
           $this->load->view('home/departments/departments',$data);
           $this->load->view('ehtml/footercrud');

        }else
        {
          $this->department_model->newDepartment($data);
          redirect('departments');
        }

     }
    else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

  function updateDepartment(){
    if($this->session->userdata('logged_in')){
    	    $data = array(
    	      'nameDepartment'=>$this->input->post('department')
    	    );

          $id = $this->uri->segment(3);

          $data['department'] = $this->department_model->getDepartment($id);
         if ($data['department']->nameDepartment != $data['nameDepartment']) 
         {   
          
            $this->load->library('form_validation');
            $this->form_validation->set_rules('department', 'Department', 'is_unique[department.nameDepartment]|required');
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
                $this->load->view('home/departments/edit-department',$data);
                $this->load->view('ehtml/footercrud');

              }else{
                
                  $this->department_model->updateDepartment($id,$data);
                  redirect('departments');
              }

      }else{
        $this->department_model->updateDepartment($id,$data);
        redirect('departments');
      }
      
    }
    else
      {
       //If no session, redirect to login page
       redirect('login', 'refresh');
      }
  }

  function runViewDeparmentProyects($id){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $id;
    $this->load->model('projects_model','',TRUE);
    $data['query'] = $this->projects_model->getDepartmentProjects($data['id']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/departments/department_projects',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditDepartment($id){
     if($this->session->userdata('logged_in')){
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['department'] = $this->department_model->getDepartment($id);
        $data['id'] = $id;
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/departments/edit-department',$data);
        $this->load->view('ehtml/footercrud');
      }
     else
       {
         //If no session, redirect to login page
         redirect('login', 'refresh');
       }
  }

  function deleteDepartment(){
    if($this->session->userdata('logged_in')){
        $id = $this->uri->segment(3);
        $this->department_model->deleteDepartment($id);
        redirect('departments');
      }
    else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }  
}

}