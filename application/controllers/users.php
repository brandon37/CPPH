<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Users extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model','',TRUE);
   $this->load->library('form_validation');
 }

 function index(){
   $this->session_user();
   $session_data = $this->session->userdata('logged_in');
   $type = 'General';
   $data['nameUser'] = $session_data['nameUser'];
   $data['idUser'] =  $session_data['idUser'];
   $data['email'] = $session_data['email'];
   $data['pass'] = $session_data['pass'];
   $data['type'] = $session_data['type'];
   $this->load->library("pagination");
   $config = $this->pagination();
   $this->pagination->initialize($config);
   $result = $this->user_model->get_pagination($config['per_page']);
   $data['query'] = $result;
   $data['pagination'] = $this->pagination->create_links();
   $this->load->view('ehtml/headercrud',$data);
   $this->load->helper(array('form'));
   $this->load->view('home/users/users',$data);
   $this->load->view('ehtml/footercrud');
  }

  function pagination(){
     $this->session_user();
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
  }

  function session_user(){
    if($this->session->userdata('logged_in')){
       $session_data = $this->session->userdata('logged_in');
       $data['type'] = $session_data['type'];
       if ($data['type'] != 'Admin') {
         redirect('home');
       }
     }
     else{
        //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

  function session_userAll(){
    if($this->session->userdata('logged_in')){
       return TRUE;
     }
     else{
        //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }
 
  function newUser(){
    $this->session_user();
    $data = array(
    'nameUser'=>$this->input->post('username'),
    'email'=>$this->input->post('email'),
    'pass'=>$this->input->post('password'),
    'type'=>"General");

    $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconf]|min_length[8]');
    $this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|min_length[8]');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[60]|xss_clean|is_unique[users.nameUser]');
    
    $this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]|trim|required|valid_email');

   if($this->form_validation->run() == FALSE)
    {
       $this->index();
    }else{
      $this->user_model->newUser($data);
      redirect('users');
    }
  }

  function updateUser(){
    $this->session_user();
    $data = array(
      'nameUser'=>$this->input->post('username'),
      'email'=>$this->input->post('email'),
      'pass'=>$this->input->post('password'),
      'type'=>"General"
    );
    $id = $this->uri->segment(3);
    $data['User'] = $this->user_model->getUser($id);

    $this->form_validation_edit_user($data);
      
    if($this->form_validation->run() == FALSE)
      {
         $this->runViewEditUser($id);
      }
    else{
         $this->user_model->updateUser($id,$data);
         redirect('users');
      }    
  }

  function form_validation_edit_user($data){
    $this->session_user();
    $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconf]|min_length[8]');
    $this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|min_length[8]');

    if($data['User']->nameUser != $data['nameUser'] ||  $data['User']->email != $data['email'])
      {

        if($data['User']->nameUser != $data['nameUser']){
            $this->form_validation->set_rules('username', 'Users Name', 'trim|required|min_length[5]|max_length[60]|xss_clean|is_unique[users.nameUser]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        }else{
              $this->form_validation->set_rules('username', 'Users Name', 'trim|required|min_length[5]|max_length[60]|xss_clean');
              $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
          }
      }
  }

  function runViewEditUser(){
    $this->session_user();
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['email'] = $session_data['email'];
    $data['pass'] = $session_data['pass'];
    $data['type'] = $session_data['type'];
    $data['id'] = $this->uri->segment(3);
    $data['user'] = $this->user_model->getUser($data['id']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/users/edit-user',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewChangePassUser(){
    $this->session_userAll();
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

  function runViewChangeProfileUser(){
    $this->session_userAll();
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

  function deleteUser(){
    $this->session_userAll();
    $this->session_user();
    $id = $this->uri->segment(3);
    $this->user_model->deleteUser($id);
    redirect('users');
  }

  function updateUserPass(){
    $this->session_userAll();
    $session_data = $this->session->userdata('logged_in');
      $data = array(
      'nameUser'=>$session_data['nameUser'],
      'email'=>$session_data['email'],
      'pass'=>$this->input->post('password'),
      'type'=>$session_data['type']
    );
    $this->form_validation->set_rules('oldpassword', 'Password', 'required|callback_check_oldpassword');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconf]|min_length[8]');
    $this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|min_length[8]');
    $id = $this->uri->segment(3);
   if($this->form_validation->run() == FALSE)
    {
      $this->runViewChangePassUser($id);
    }else{
      $this->user_model->updateUser($id,$data);
      redirect('users');
    }
 
  }

  function updateUserProfile(){
    $this->session_userAll();
    $session_data = $this->session->userdata('logged_in');
      $data = array(
      'nameUser'=>$this->input->post('username'),
      'email'=>$this->input->post('mail'),
      'pass'=>$session_data['pass'],
      'type'=>$session_data['type']
    );
    $id = $this->uri->segment(3);
    $data['User'] = $this->user_model->getUser($id);

    if($data['User']->nameUser != $data['nameUser'] ||  $data['User']->email != $data['email'])
      {
        if ($data['User']->nameUser != $data['nameUser']) {
          $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[60]|xss_clean|is_unique[users.nameUser]');
          $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email');
        }else{
          $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[60]|xss_clean');
          $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        }

       if($this->form_validation->run() == FALSE)
        {
          $this->runViewChangeProfileUser($id);
        }
        else
        {
          $this->updateSession($id, $data);          
          $this->user_model->updateProfile($id,$data);
          redirect('users');
        }
      }
    else
      {
        $this->updateSession($id, $data);
        $this->user_model->updateProfile($id,$data);
        redirect('users');
      }
}

  function updateSession($id,$data){
       $sess_array = array(
         'idUser'=>$id,
         'nameUser'=>$data['nameUser'],
         'email'=>$data['email'],
         'pass'=>$data['pass'],
         'type'=>$data['type']
       );
       $this->session->unset_userdata('logged_in');
       session_destroy();
       $this->session->set_userdata('logged_in', $sess_array);
   }

  function check_oldpassword($oldpassword){
    $this->session_userAll();
    $session_data = $this->session->userdata('logged_in');
    $oldpassword = $this->input->post('oldpassword');
    $id = $session_data['idUser'];
    $oldpassword_db = $this->user_model->getUser($id)->pass;
    if ($oldpassword_db == md5($oldpassword)) {
      return TRUE;
    }else{
      $this->form_validation->set_message('check_oldpassword', "Sorry, This oldpassword Doesn't Exist.");
      return false;
    }

  }

}

