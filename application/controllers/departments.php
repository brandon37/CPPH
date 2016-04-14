<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Departments extends CI_Controller {
 
  function __construct(){
      parent::__construct();
      $this->session();
      $this->load->model('department_model','',TRUE);
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
     $result = $this->department_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/departments/departments',$data);
     $this->load->view('ehtml/footercrud');
	}

  function session(){
    if($this->session->userdata('logged_in')){
       return TRUE;
      }
    else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

  function pagination(){
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
     return  $config;
  }

  function newDepartment(){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $data = array(
      'nameDepartment'=>$this->input->post('department')
      );
        $this->form_validation->set_rules('department', 'Department', 'is_unique[department.nameDepartment]|required');
       if($this->form_validation->run() == FALSE)
        {
          $this->index();
        }else
        {
          $this->department_model->newDepartment($data);
          redirect('departments');
        }
  }

  function updateDepartment($id ){
     $session_data = $this->session->userdata('logged_in');
     $name = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
	    $data = array(
	      'nameDepartment'=>$this->input->post('department')
	    );
      $data['department'] = $this->department_model->getDepartment($id);
     if ($data['department']->nameDepartment != $data['nameDepartment']) 
     {   
        $this->form_validation->set_rules('department', 'Department', 'is_unique[department.nameDepartment]|required');
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditDepartment($id);

          }else{
            
              $this->department_model->updateDepartment($id,$data);
              redirect('departments');
          }

      }else{

        $this->form_validation->set_rules('department', 'Department', 'required');
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditDepartment($id);

          }else{
              $this->department_model->updateDepartment($id,$data);
              redirect('departments');
          }
      }
      
  }

  function runViewDeparmentProyects($id){
    $session_data = $this->session->userdata('logged_in');
    $name = 'General';
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['email'] = $session_data['email'];
    $data['id'] = $id;
    $this->load->model('projects_model','',TRUE);
    $data['query'] = $this->projects_model->getDepartmentProjects($data['id']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/departments/department_projects',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditDepartment($id){
    $session_data = $this->session->userdata('logged_in');
    $name = 'General';
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['email'] = $session_data['email'];
    $data['department'] = $this->department_model->getDepartment($id);
    $data['id'] = $id;
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/departments/edit-department',$data);
    $this->load->view('ehtml/footercrud');
  }

  function deleteDepartment(){
        $id = $this->uri->segment(3);
        $this->department_model->deleteDepartment($id);
        redirect('departments');
     
  }

}