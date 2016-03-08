<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifypass extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model','',TRUE);
 }
 private $pass;
 function index()
 {
  if($this->session->userdata('logged_in'))
     {
  $pass = $this->input->post('oldpassword');
  //This method will have the credentials validation
   $this->load->library('form_validation');
 
   $this->form_validation->set_rules('pass', 'pass', 'trim|required|xss_clean|callback_check_database');
 
   if($this->form_validation->run() == FALSE)
   {
     $session_data = $this->session->userdata('logged_in');
     
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $this->load->view('ehtml/header',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/change-user-pass/'.$data['idUser'],$data);
     $this->load->view('ehtml/footer');
   }
   else
   {
    $this->session->set_flashdata('my_data', $pass);
    redirect('users');
   }
 } else
   {
    $this->session->set_flashdata('my_data', $pass);
    redirect('login');
   }

 
 }
 
 function check_database($pass)
 {
   //Field validation succeeded.  Validate against database
  
   //query the database
   $result = $this->user_model->getUserPass($pass);
 
   if($result)
   {
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', "Sorry, This Pass Does not valid.");
     return false;
   }
 }


}



?>