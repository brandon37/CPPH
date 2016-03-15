<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Users extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model','',TRUE);

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
     $data['users'] = $this->user_model->getAllUsers($type);
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/users/users',$data);
     $this->load->view('ehtml/footercrud');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 	

 }
  function newUser(){
      $data = array(
      'nameUser'=>$this->input->post('username'),
      'email'=>$this->input->post('email'),
      'passwd'=>$this->input->post('password'),
      'type'=>"General"
    );

    $this->user_model->newUser($data);
    redirect('users');
  }
  function updateUser(){
    $data = array(
      'nameUser'=>$this->input->post('username'),
      'email'=>$this->input->post('email'),
      'passwd'=>$this->input->post('password'),
      'type'=>"General"
    );
    $this->user_model->updateUser($this->uri->segment(3),$data);
    redirect('users');
  }

  function runViewEditUser($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['email'] = $session_data['email'];
        $data['user'] = $this->user_model->getUser($id);
        $data['id'] = $id;
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/users/edit-user',$data);
        $this->load->view('ehtml/footercrud');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }

  function runViewChangePassUser(){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['email'] = $session_data['email'];
        $data['user'] = $this->user_model->getUser($data['idUser']);
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/users/change-user-pass',$data);
        $this->load->view('ehtml/footercrud');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }
  function runViewChangeProfileUser(){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['email'] = $session_data['email'];
        $data['user'] = $this->user_model->getUser($data['idUser']);
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/users/change-user-profile',$data);
        $this->load->view('ehtml/footercrud');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }

  function deleteUser(){
    if($this->session->userdata('logged_in'))
     {
        $id = $this->uri->segment(3);
        $this->user_model->deleteUser($id);
        redirect('users');
      }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }
  

  function updateUserPass(){
      if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
          $data = array(
          'nameUser'=>$session_data['nameUser'],
          'email'=>$session_data['email'],
          'pass'=>$this->input->post('password'),
          'type'=>"Admin"
        );
        $this->user_model->updateUser($this->uri->segment(3),$data);
        redirect('users');
    } else{
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
 
}

  function updateUserProfile(){
      if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
          $data = array(
          'nameUser'=>$session_data['nameUser'],
          'email'=>$this->input->post['email']
        );
        $this->user_model->updateUser($this->uri->segment(3),$data);
        redirect('users');
    } else{
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
 
}


}