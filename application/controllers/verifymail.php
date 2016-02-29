<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifymail extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('usuario_model','',TRUE);
 }
 private $email;
 function index()
 {
  $email = $this->input->post('mail');
  //This method will have the credentials validation
   $this->load->library('form_validation');
 
   $this->form_validation->set_rules('mail', 'email', 'trim|required|xss_clean|callback_check_database');
 
   if($this->form_validation->run() == FALSE)
   {
     
      $this->load->view("ehtml/headerL");
      $this->load->view("login/recuperapass");
      $this->load->view("ehtml/footerL");
   }
   else
   {
    $this->session->set_flashdata('my_data', $email);
    redirect('sendmail');
   }
 
 }
 
 function check_database($email)
 {
   //Field validation succeeded.  Validate against database
  
   //query the database
   $result = $this->usuario_model->obtenerUsuarioPass($email);
 
   if($result)
   {
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', "Sorry, This Email Doesn't Exist.");
     return false;
   }
 }


}





?>