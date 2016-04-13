<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Projects extends CI_Controller {
 
 function __construct(){
   parent::__construct();
   $this->session_user();
   $this->load->library('form_validation');
   $this->load->model('client_model','',TRUE);
   $this->load->model('department_model','',TRUE);
   $this->load->model('projects_model','',TRUE); 
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
   $data['query'] = $this->projects_model->getAllProjects();
   $data['pagination'] = $this->pagination->create_links();
   $this->load->view('ehtml/headercrud',$data);
   $this->load->helper(array('form'));
   $this->load->view('home/projects/projects',$data);
   $this->load->view('ehtml/footercrud');
 }

function pagination(){
   $config['base_url'] = base_url()."projects/index/";
   $config['total_rows'] = $this->projects_model->no_page();
   $config['per_page'] = 6;
   //$config['use_page_numbers'] = TRUE;
   $config['uri_segment'] = 3;
   $config['num_links'] = 6;
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

 function session_user(){
    if ($this->session->userdata('logged_in')) {
      return TRUE;
    }else{
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

  function newproject(){
      $data = array(
      'idProject'=>"",
      'idDepartment'=>"",
      'nameProject'=>$this->input->post('projectname'),
      'nameDepartment'=>$this->input->post('department'),
      'price'=>$this->input->post('price'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>"",
      'nameClient'=>$this->input->post('nameClient')
    );

      $this->form_validation->set_rules('projectname', 'Name Project', 'required|is_unique[projects.nameProject]');
      $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
      $this->form_validation->set_rules('price', 'Price', 'required|numeric');
      $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
      $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
     if($this->form_validation->run() == FALSE)
      {
         $this->index();
      }else{

          $queryclient =  $this->client_model->getClientId($data['nameClient']);
          $data['idClient'] = $queryclient->idClient;
          
          $this->projects_model->newproject($data);
          $queryProject =  $this->projects_model->getProjectId($data['nameProject']);
          $data['idProject'] = $queryProject->idProyect;

          $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
          $data['idDepartment'] = $queryDepartment->idDepartment;
          $this->projects_model->indexDepartment($data);
          redirect('projects');
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

  function check_department($nameDepartment){
      $queryDepartment =  $this->department_model->getDepartmentId($this->input->post('department'));
      $nameDepartment_db = null;
      if ($queryDepartment) {
        $nameDepartment_db = $queryDepartment->nameDepartment;
      }

      if ($nameDepartment == $nameDepartment_db) 
        {
          return TRUE;
        }
       else
        {
          $this->form_validation->set_message('check_department', "Sorry, This Department Doesn't Exist.");
          return false;
        }

  } 

  function check_project($nameProject){
    $queryProject = $this->projects_model->getProjectId($this->input->post('projectname'));
    $nameProject_db = null;
    if ($queryProject) 
      {
        $nameProject_db = $queryProject->nameProject;
      }

    if($nameProject == $nameProject_db) 
       {
         $this->form_validation->set_message('check_project', "Sorry, This Project Exist.");
         return false;
       }
     else
       {
         return TRUE;
       }
  } 

  function check_client($nameclient){
    $queryclient =  $this->client_model->getClientId($this->input->post('nameClient'));
    $nameclient_db = null;
    if ($queryclient) 
      {
        $nameclient_db = $queryclient->nameClient;
      }

    if($nameclient == $nameclient_db) 
       {
         return TRUE;

       }else
         {
            $this->form_validation->set_message('check_client', "Sorry, This Client Doesn't Exist.");
            return false;
         }

  }   

  function updateProject(){
      $data = array(
      'idProject'=>"",
      'idDepartment'=>"",
      'nameProject'=>$this->input->post('projectname'),
      'nameDepartment'=>$this->input->post('department'),
      'price'=>$this->input->post('price'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>$this->input->post('dateTermination'),
      'nameClient'=>$this->input->post('nameClient')
    );  
      $id = $this->uri->segment(3);
      $queryProject = $this->projects_model->getProject($id);
    if($queryProject) 
     {
        if ($data['nameProject'] != $queryProject->nameProject) 
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required|is_unique[projects.nameProject]');
          }
        else
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required');
          }
        $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('dateTermination','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
        
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditProject();
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($id,$data);

            $this->projects_model->updateIndexDepartment($id,$data);
            redirect('projects');
          }

     }
    else
     {
      redirect('projects');
     }
        
  }
  
  function updateProjectClientInSector($idProject, $idClient){
    $data = array(
      'idProject'=>"",
      'idDepartment'=>"",
      'nameProject'=>$this->input->post('projectname'),
      'nameDepartment'=>$this->input->post('department'),
      'price'=>$this->input->post('price'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>$this->input->post('dateTermination'),
      'nameClient'=>$this->input->post('nameClient')
    );  
      $data['idProject'] = $idProject;
      $data['idClient'] = $idClient;
      $queryProject = $this->projects_model->getProject($idProject);
    if($queryProject) 
     {
        if ($data['nameProject'] != $queryProject->nameProject) 
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required|is_unique[projects.nameProject]');
          }
        else
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required');
          }
        $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('dateTermination','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
        
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditProjectClientInSector($idProject,$idClient);
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($idProject,$data);

            $this->projects_model->updateIndexDepartment($idProject,$data);
            redirect('clients/runViewClientProjects/'.$idClient);
          }

     }
    else
     {
      redirect('clients/runViewClientProjects/'.$idClient);
     }
  }

  function updateProjectInSector($idProject,$idSector){
    $data = array(
      'idProject'=>"",
      'idDepartment'=>"",
      'nameProject'=>$this->input->post('projectname'),
      'nameDepartment'=>$this->input->post('department'),
      'price'=>$this->input->post('price'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>$this->input->post('dateTermination'),
      'nameClient'=>$this->input->post('nameClient')
    );  
      $data['idProject'] = $idProject;
      $data['idSector'] = $idSector;
      $queryProject = $this->projects_model->getProject($idProject);
    if($queryProject) 
     {
        if ($data['nameProject'] != $queryProject->nameProject) 
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required|is_unique[projects.nameProject]');
          }
        else
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required');
          }
        $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('dateTermination','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
        
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditProjectInSector($idProject,$idSector);
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($idProject,$data);

            $this->projects_model->updateIndexDepartment($idProject,$data);
            redirect('sectors/runViewSectorProyects/'.$idSector);
          }

     }
    else
     {
      redirect('sectors/runViewSectorProyects/'.$idSector);
     }
  }

  function updateProjectInClient($idProject,$idClient){
      $data = array(
      'idProject'=>"",
      'idDepartment'=>"",
      'nameProject'=>$this->input->post('projectname'),
      'nameDepartment'=>$this->input->post('department'),
      'price'=>$this->input->post('price'),
      'dateCreation'=>$this->input->post('dateCreation'),
      'dateTermination'=>$this->input->post('dateTermination'),
      'nameClient'=>$this->input->post('nameClient')
    );  
      $data['idProject'] = $idProject;
      $data['idClient'] = $idClient;
      $queryProject = $this->projects_model->getProject($idProject);
    if($queryProject) 
     {
        if ($data['nameProject'] != $queryProject->nameProject) 
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required|is_unique[projects.nameProject]');
          }
        else
          {
            $this->form_validation->set_rules('projectname', 'Name Project', 'required');
          }
        $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('dateTermination','Date', 'required|callback_check_date');
        $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
        
        if($this->form_validation->run() == FALSE)
          {
            $this->runViewEditProjectInClient($idProject,$idClient);
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($idProject,$data);

            $this->projects_model->updateIndexDepartment($idProject,$data);
            redirect('clients/runViewClientProjects/'.$idClient);
          }

     }
    else
     {
      redirect('clients/runViewClientProjects/'.$idClient);
     }
  }

  function runViewProyectOrderShoppings($id){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $id;
    $this->load->model('ordershopping_model','',TRUE);
    $data['query'] = $this->ordershopping_model->getProjectOrderShoppings($data['id']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/projects/project_ordershoppings',$data);
    $this->load->view('ehtml/footercrud');
  }

  function runViewEditProject($id){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['project'] = $this->projects_model->getProject($id);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $data['id'] = $id;
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/projects/edit-project',$data);
    $this->load->view('ehtml/footercrud'); 
  }

  function runViewEditProjectInClient($idProject,$idClient){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['project'] = $this->projects_model->getProject($idProject);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $data['idProject'] = $idProject;
    $data['idClient'] = $idClient;
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/clients/edit-project',$data);
    $this->load->view('ehtml/footercrud'); 
  }

  function runViewEditProjectInSector($idProject,$idSector){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['project'] = $this->projects_model->getProject($idProject);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $data['idProject'] = $idProject;
    $data['idSector'] = $idSector;
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-project-in-sector',$data);
    $this->load->view('ehtml/footercrud'); 
  }

  function runViewEditProjectClientInSector($idProject,$idClient,$idSector){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['project'] = $this->projects_model->getProject($idProject);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $data['idProject'] = $idProject;
    $data['idClient'] = $idClient;
    $data['idSector'] =$idSector;
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-project',$data);
    $this->load->view('ehtml/footercrud'); 
  }

  function deleteProject(){
    $id = $this->uri->segment(3);
    $this->projects_model->deleteproject($id);
    redirect('projects');
  }

  function deleteProjectInClient($idProject, $idClient){
    $this->projects_model->deleteproject($idProject);
    redirect('clients/runViewClientProjects/'.$idClient);
  }

  function deleteProjectInSector($idProject, $idSector){
    $this->projects_model->deleteproject($idProject);
    redirect('sectors/runViewSectorProyects/'.$idSector);
  }
  function deleteProjectClientInSector($idProject, $idClient){
    $this->projects_model->deleteproject($idProject);
    redirect('client/runViewClientProjects/'.$idClient);
  }

}
