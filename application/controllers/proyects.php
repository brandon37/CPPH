<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Proyects extends CI_Controller {
 
 function __construct(){
   parent::__construct();
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
     $data['proyects'] = $this->proyects_model->getAllProyects();
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
        'nameProyect'=>$this->input->post('proyectname'),
        'department'=>$this->input->post('department'),
        'price'=>$this->input->post('price'),
        'dateCreation'=>$this->input->post('dateCreation'),
        'dateTermination'=>"",
        'idClient'=>$this->input->post('idClient')
      );

      $this->proyects_model->newproyect($data);
      redirect('proyects');
     }
      else{
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }
  }

  function updateProyect(){
    if($this->session->userdata('logged_in'))
     {
        $data = array(
          'nameProyect'=>$this->input->post('nameProyect'),
          'department'=>$this->input->post('department'),
          'price'=>$this->input->post('price'),
          'dateCreation'=>$this->input->post('dateCreation'),
          'dateTermination'=>$this->input->post('dateTermination'),
          'idClient'=>$this->input->post('idClient')
        );
        $this->proyects_model->updateproyect($this->uri->segment(3),$data);
        redirect('proyects');
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