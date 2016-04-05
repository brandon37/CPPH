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
	     $this->load->library("pagination");
       $config['base_url'] = base_url()."sectors/index/";
       $config['total_rows'] = $this->sector_model->no_page();
       $config['per_page'] = 5;
       $config['use_page_numbers'] = TRUE;
       $config['num_links'] = 5;
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
       $result = $this->sector_model->get_pagination($config['per_page']);
       $data['query'] = $result;
       $data['pagination'] = $this->pagination->create_links();
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

        $this->load->library('form_validation');
        $this->form_validation->set_rules('sector', 'Sector', 'is_unique[sector.typeSector]|required');
       if($this->form_validation->run() == FALSE)
        {
           $session_data = $this->session->userdata('logged_in');
           $type = 'General';
           $data['nameUser'] = $session_data['nameUser'];
           $data['idUser'] =  $session_data['idUser'];
           $data['email'] = $session_data['email'];
           $this->load->library("pagination");
           $config['base_url'] = base_url()."sectors/index/";
           $config['total_rows'] = $this->sector_model->no_page();
           $config['per_page'] = 5;
           $config['use_page_numbers'] = TRUE;
           $config['num_links'] = 5;
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
           $result = $this->sector_model->get_pagination($config['per_page']);
           $data['query'] = $result;
           $data['pagination'] = $this->pagination->create_links();
           $this->load->view('ehtml/headercrud',$data);
           $this->load->helper(array('form'));
           $this->load->view('home/sectors/sectors',$data);
           $this->load->view('ehtml/footercrud');
        }else
        {
          $this->sector_model->newSector($data);
          redirect('sectors');
        }

    
  	}
  	else
    {
  	   redirect('login', 'refresh');
  	}
  }

  function updateSector(){
	if($this->session->userdata('logged_in')){
          $data = array(
            'typeSector'=>$this->input->post('sector')
          );

          $id = $this->uri->segment(3);

          $data['sector'] = $this->sector_model->getSector($id);
         if ($data['sector']->typeSector != $data['typeSector']) 
         {   
          
            $this->load->library('form_validation');
            $this->form_validation->set_rules('sector', 'Sector', 'is_unique[Sector.typeSector]');
            $this->form_validation->set_rules('sector', 'Type Sector', 'required');
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
                $this->load->view('home/sectors/edit-Sector',$data);
                $this->load->view('ehtml/footercrud');

              }else{
                
                  $this->sector_model->updateSector($id,$data);
                  redirect('sectors');
              }

      }else{
        $this->sector_model->updateSector($id,$data);
        redirect('sectors');
      }
      
    }
    else
      {
       //If no session, redirect to login page
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