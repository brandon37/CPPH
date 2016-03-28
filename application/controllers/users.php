<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Users extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model','',TRUE);

 }

 function index(){
    if($this->session->userdata('logged_in'))
      {
         $session_data = $this->session->userdata('logged_in');
         $type = 'General';
         $data['nameUser'] = $session_data['nameUser'];
         $data['idUser'] =  $session_data['idUser'];
         $data['email'] = $session_data['email'];
         $data['pass'] = $session_data['pass'];
         $data['type'] = $session_data['type'];
         $this->load->library("pagination");
         $config['base_url'] = base_url()."users/index/";
         $config['total_rows'] = $this->user_model->no_page();
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
         $result = $this->user_model->get_pagination($config['per_page']);
         $data['query'] = $result;
         $data['pagination'] = $this->pagination->create_links();
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
    if($this->session->userdata('logged_in'))
     {
        $data = array(
        'nameUser'=>$this->input->post('username'),
        'email'=>$this->input->post('email'),
        'pass'=>$this->input->post('password'),
        'type'=>"General");

      $this->user_model->newUser($data);
      redirect('users');
    }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

  function updateUser(){
     if($this->session->userdata('logged_in'))
     {
        $data = array(
          'nameUser'=>$this->input->post('username'),
          'email'=>$this->input->post('email'),
          'pass'=>$this->input->post('password'),
          'type'=>"General"
        );
        $this->user_model->updateUser($this->uri->segment(3),$data);
        redirect('users');
    }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

  function runViewEditUser($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['email'] = $session_data['email'];
        $data['pass'] = $session_data['pass'];
        $data['type'] = $session_data['type'];
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
        $data['pass'] = $session_data['pass'];
        $data['type'] = $session_data['type'];
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
        $data['pass'] = $session_data['pass'];
        $data['type'] = $session_data['type'];
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
          'type'=>$session_data['type']
        );
        $this->user_model->updateUser($this->uri->segment(3),$data);
        redirect('users');
    } else{
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
 
  }


}