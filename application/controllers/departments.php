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
	     $data['departments'] = $this->department_model->getAllDepartments();
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

      $this->department_model->newDepartment($data);
      redirect('departments');
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
  	    $this->department_model->updateDepartment($this->uri->segment(3),$data);
  	    redirect('departments');
      }
    else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
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