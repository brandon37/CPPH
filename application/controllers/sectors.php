<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Sectors extends CI_Controller {
 
  function __construct(){
   	parent::__construct();
   	$this->load->model('sector_model','',TRUE);
  }

  function index(){
	  if($this->session->userdata('logged_in'))
	   {
	     $session_data = $this->session->userdata('logged_in');
	     $type = 'General';
	     $data['nameUser'] = $session_data['nameUser'];
	     $data['idUser'] =  $session_data['idUser'];
	     $data['email'] = $session_data['email'];
	     $data['sectors'] = $this->sector_model->getAllsectors();
	     $this->load->view('ehtml/headercrud',$data);
	     $this->load->helper(array('form'));
	     $this->load->view('home/sectors/sectors',$data);
	     $this->load->view('ehtml/footercrud');
	   }
	   else
	   {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
	   }
	 	
	}

  function newSector(){
  	if($this->session->userdata('logged_in'))
     {
      $data = array(
      'typeSector'=>$this->input->post('sector')
    );

    $this->sector_model->newSector($data);
    redirect('sectors');
	}
	else
	{
	   redirect('login', 'refresh');
	}
  }

  function updateSector(){
	if($this->session->userdata('logged_in'))
	 {
	    $data = array(
	      'typeSector'=>$this->input->post('sector')
	    );
	    $this->sector_model->updateSector($this->uri->segment(3),$data);
	    redirect('sectors');
	 }
	 else{
	    redirect('login', 'refresh');
	 }
  }

  function runViewEditsector($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['idUser'] =  $session_data['idUser'];
        $data['sector'] = $this->sector_model->getsector($id);
        $data['id'] = $id;
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/sectors/edit-sector',$data);
        $this->load->view('ehtml/footercrud');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  
  }

  function deletesector(){
    if($this->session->userdata('logged_in'))
     {
        $id = $this->uri->segment(3);
        $this->sector_model->deletesector($id);
        redirect('sectors');
      }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }
  

}