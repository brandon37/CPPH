<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Ordershopping extends CI_Controller {
 
 function __construct(){
   parent::__construct();
   $this->session_user();
   $this->load->model('ordershopping_model','',TRUE);
   $this->load->model('projects_model', '',TRUE);
   $this->load->library('form_validation');
   $this->load->library("pagination");
 }
 
 function index()
   {
     $session_data = $this->session->userdata('logged_in');
     $type = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['idUser'] =  $session_data['idUser'];
     $data['email'] = $session_data['email'];
     $config = $this->pagination();
     $this->pagination->initialize($config);
     $result = $this->ordershopping_model->get_pagination($config['per_page']);
     $data['query'] = $result;
     $data['pagination'] = $this->pagination->create_links();
     $this->load->view('ehtml/headercrud',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/ordershopping/ordershopping',$data);
     $this->load->view('ehtml/footercrud');
   }

  function session_user(){
    if($this->session->userdata('logged_in')){
       return TRUE;
     }
     else{
        //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  }

  function pagination(){
     $config['base_url'] = base_url()."ordershopping/index/";
     $config['total_rows'] = $this->ordershopping_model->no_page();
     $config['per_page'] = 5;
     $config['use_page_numbers'] = TRUE;
     //$config['uri_segment'] = 3;
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
     return $config;
  }
 
  function check_project($nameProject){
    $queryProject = $this->projects_model->getProjectId($this->input->post('nameProject'));
    $nameProject_db = null;
    if ($queryProject) {
       $nameProject_db = $queryProject->nameProject;
    }

    if ($nameProject == $nameProject_db) {
       return TRUE;

     }else{
        $this->form_validation->set_message('check_project', "Sorry, This Project Doesn't Exist.");
        return false;
     }
    
  }

  function check_nameProyect($nameProject, $projectid){
    $Project = $this->projects_model->getProjectId($nameProject);
    if($Project){
        if ($Project->idProject == $projectid) {
              return true;
        }else{
            $this->form_validation->set_message('check_nameProyect',"Sorry, The project name does not match the OrderShopping.");
            return false;
        }
    }else{
      $this->form_validation->set_message('check_nameProyect',"Sorry, This Name Project Doesn't Exist.");
      return false;
    }
  }

  function check_date($dateCreation){ 
      trim($dateCreation); 
      $trozos = explode ("-", $dateCreation); 
      if (count($trozos)==3) {
        $year=$trozos[0]; 
        $month=$trozos[1]; 
        $day=$trozos[2]; 
      }     
      if (isset($year)&&($year!=null)&&isset($month)&&($month!=null)&&isset($day)&&($day!=null)) {

        if(is_numeric($year)&&is_numeric($month)&&is_numeric($day)) {
           if(checkdate ($month,$day,$year)){ 
            return true; 
            } 
            else{ 
              $this->form_validation->set_message('check_date', "Sorry, This Date Doesn't Correct.");
              return false;
            }
         }else{
           $this->form_validation->set_message('check_date', "Sorry, This Date Doesn't Correct.");
            return false;
         }
    
      }else{
        $this->form_validation->set_message('check_date', "Sorry, This Date Doesn't Correct.");
        return false;
      }      
  }  

  function check_idProject($idProject){
      if ($this->projects_model->getProject($idProject)) {
         return true;
      }else
        {
          $this->form_validation->set_message('check_idProject', "Sorry, This Id Project Doesn't Correct.");
          return false;
        }  
  }

  function neworderShopping(){
     $data = array(
      'nameProject'=>$this->input->post('nameProject'),
      'concept'=>$this->input->post('concept'),
      'amount'=>$this->input->post('amount'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>'',
      'idproject'=>''
     );
      $this->form_validation->set_rules('nameProject', 'Name Project', 'required|callback_check_project');
      $this->form_validation->set_rules('concept', 'Concept', 'required');
      $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
      $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
     if($this->form_validation->run() == FALSE)
      {
         $this->index();

      }else{
          $data['idproject'] = $this->projects_model->getProjectId($data['nameProject'])->idProject;
          $this->ordershopping_model->newOrderShopping($data);
          redirect('ordershopping');
      }

  }

  function newOrderShoppingProjectClientSector(){
     $data = array(
      'idproject'=>$this->input->post('idProject'),
      'concept'=>$this->input->post('concept'),
      'amount'=>$this->input->post('amount'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>''
     );
      $data['idProject']= $this->uri->segment(3);
      $data['idClient'] = $this->uri->segment(4);
      $data['idSector'] = $this->uri->segment(5);
      $this->form_validation->set_rules('idProject','Id Project', 'required|numeric|callback_check_idProject');
      $this->form_validation->set_rules('concept', 'Concept', 'required');
      $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
      $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
     if($this->form_validation->run() == FALSE)
      {
         $this->runViewOrderShoppingsProjectClientInSector($data['idProject'],$data['idClient'],$data['idSector']);
      }else{
          $this->ordershopping_model->newOrderShopping($data);
          redirect('ordershopping/runViewOrderShoppingsProjectClientInSector/'.$data['idProject'].'/'.$data['idClient'].'/'.$data['idSector']);
      }
  }

  function newOrderShoppingProject(){
     $data = array(
      'idproject'=>$this->input->post('idProject'),
      'concept'=>$this->input->post('concept'),
      'amount'=>$this->input->post('amount'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>''
     );
      $data['idProject']= $this->uri->segment(3);
      $this->form_validation->set_rules('idProject','Id Project', 'required|numeric|callback_check_idProject');
      $this->form_validation->set_rules('concept', 'Concept', 'required');
      $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
      $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
     if($this->form_validation->run() == FALSE)
      {
         $this->runViewOrderShoppingsProject($data['idProject']);
      }else{
          $this->ordershopping_model->newOrderShopping($data);
          redirect('ordershopping/runViewOrderShoppingsProject/'.$data['idProject']);
      }
  }

  function updateorderShopping(){
    $data = array(
      'concept'=>$this->input->post('concept'),
      'amount'=>$this->input->post('amount'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>$this->input->post('dateTermination')
    );
    $idOrderShopping = $this->uri->segment(3);
    $this->form_validation->set_rules('concept', 'Concept', 'required');
    $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
    $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
    $this->form_validation->set_rules('dateTermination','Date', 'required|callback_check_date');

    if($this->form_validation->run() == FALSE)
    {
      $this->runViewEditorderShopping();
    }else{
      $this->ordershopping_model->updateorderShopping($idOrderShopping ,$data);
      redirect('ordershopping');
    }
  }

  function updateorderShoppingProyectClientinSector(){
    $data = array(
      'concept'=>$this->input->post('concept'),
      'amount'=>$this->input->post('amount'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>$this->input->post('dateTermination')
    );
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['idProject'] = $this->uri->segment(4);
    $data['idClient']  = $this->uri->segment(5);
    $data['idSector']  = $this->uri->segment(6);   
    $projectid = $this->ordershopping_model->getorderShopping($data['idOrderShopping'])->idproject;
    $this->form_validation->set_rules('nameProject', 'Project Name' , 'required|callback_check_nameProyect['.$projectid.']');
    $this->form_validation->set_rules('concept', 'Concept', 'required');
    $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
    $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
    $this->form_validation->set_rules('dateTermination','Date', 'required|callback_check_date');

    if($this->form_validation->run() == FALSE)
    {
      $this->runViewEditOrderShoppingsProjectClientInSector($data['idOrderShopping'],$data['idProject'],$data['idClient'],$data['idSector']);
    }else{
      $this->ordershopping_model->updateOrderShopping($data['idOrderShopping'] ,$data);
      redirect('ordershopping/runViewOrderShoppingsProjectClientInSector/'.$data['idProject'].'/'.$data['idClient'].'/'.$data['idSector']);
    }
  }

  function updateorderShoppingInProyect(){
    $data = array(
      'concept'=>$this->input->post('concept'),
      'amount'=>$this->input->post('amount'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>$this->input->post('dateTermination')
    );
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['idProject'] = $this->uri->segment(4);
    $projectid = $this->ordershopping_model->getorderShopping($data['idOrderShopping'])->idproject;
    $this->form_validation->set_rules('nameProject', 'Project Name' , 'required|callback_check_nameProyect['.$projectid.']');
    $this->form_validation->set_rules('concept', 'Concept', 'required');
    $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
    $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
    $this->form_validation->set_rules('dateTermination','Date', 'required|callback_check_date');

    if($this->form_validation->run() == FALSE)
    {
      $this->runViewProjectOrderShoppings($data['idProject']);
    }else{
      $this->ordershopping_model->updateOrderShopping($data['idOrderShopping'] ,$data);
      redirect('ordershopping/runViewProjectOrderShoppings/'.$data['idProject']);
    }
  }

  function runViewOrderShoppingsProjectClientInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idProject'] = $this->uri->segment(3);
    $data['idClient'] = $this->uri->segment(4);
    $data['idSector'] = $this->uri->segment(5);
    $data['query'] =  $this->ordershopping_model->get_OrderShoppingsProjectClientInSector($data['idProject']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/sector-client-project-ordershoppings',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditorderShopping(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $this->uri->segment(3);
    $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['id']);
    $data['projects'] = $this->projects_model->getAllProjects();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/ordershopping/edit-ordershopping',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditOrderShoppingsProjectClientInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
    $data['idProject'] = $this->uri->segment(4);
    $data['idClient'] = $this->uri->segment(5);
    $data['idSector'] = $this->uri->segment(6);
    $data['projects'] = $this->projects_model->getAllProjects();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-ordershopping-proyect-client-in-sector',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewProjectOrderShoppings(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idProject'] = $this->uri->segment(3);
    $data['Project'] = $this->projects_model->getProject($data['idProject']);
    if ($data['Project']) {
      $data['query'] = $this->ordershopping_model->getProjectOrderShoppings($data['idProject']);
      $this->load->view('ehtml/headercrud',$data);
      $this->load->helper(array('form'));
      $this->load->view('home/projects/project_ordershoppings',$data);
      $this->load->view('ehtml/footercrud');
    }else{
      redirect('projects');
    }
    
  }

  function runViewEditOrderShoppingsInProject(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idOrderShopping'] = $this->uri->segment(3);
    $data['ordershopping'] = $this->ordershopping_model->getorderShopping($data['idOrderShopping']);
    $data['idProject'] = $this->uri->segment(4);
    $data['projects'] = $this->projects_model->getAllProjects();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/projects/edit-ordershopping-in-project',$data);
    $this->load->view('ehtml/footercrud');
  }

  function deleteorderShopping(){
    $id = $this->uri->segment(3);
    $this->ordershopping_model->deleteorderShopping($id);
    redirect('ordershopping');
  }

  function deleteorderShoppingProjectClientInSector(){
    $id = $this->uri->segment(3);
    $idProject = $this->uri->segment(4);
    $idClient = $this->uri->segment(5);
    $idSector = $this->uri->segment(6);
    $this->ordershopping_model->deleteorderShopping($id);
    redirect('ordershopping/runViewOrderShoppingsProjectClientInSector/'.$idProject.'/'.$idClient.'/'.$idSector);
  }

}
