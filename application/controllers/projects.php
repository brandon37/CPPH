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
   $this->load->model('sector_model','', TRUE);
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
   $data['departments'] = $this->department_model->getAllDepartments();
   $data['clients'] = $this->client_model->getAllClients();
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

 function form_validation_newProyect(){
   $this->form_validation->set_rules('projectname', 'Name Project', 'required|is_unique[projects.nameProject]');
   $this->form_validation->set_rules('department', 'Department', 'required|callback_check_department');
   $this->form_validation->set_rules('price', 'Price', 'required|numeric');
   $this->form_validation->set_rules('dateCreation','Date', 'required|callback_check_date');
   $this->form_validation->set_rules('nameClient', 'Name Client', 'required|callback_check_client');
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

      $this->form_validation_newProyect();
     if($this->form_validation->run() == FALSE)
      {
         $this->index();
      }else{
          $queryclient =  $this->client_model->getClientId($data['nameClient']);
          $data['idClient'] = $queryclient->idClient;
          
          $this->projects_model->newproject($data);
          $queryProject =  $this->projects_model->getProjectId($data['nameProject']);
          $data['idProject'] = $queryProject->idProject;

          $queryDepartment =  $this->client_models->department_model->getDepartmentId($data['nameDepartment']);
          $data['idDepartment'] = $queryDepartment->idDepartment;
          $this->projects_model->indexDepartment($data);
          redirect('projects');
      }

  }

  function newProjectClientInSector(){
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
      $idClient = $this->uri->segment(3);
      $idSector = $this->uri->segment(4);
      $this->form_validation_newProyect();
     if($this->form_validation->run() == FALSE)
      {
         $this->index(); //pendiente de arreglar
      }else{
          $queryclient =  $this->client_model->getClientId($data['nameClient']);
          $data['idClient'] = $queryclient->idClient;
          
          $this->projects_model->newproject($data);
          $queryProject =  $this->projects_model->getProjectId($data['nameProject']);
          $data['idProject'] = $queryProject->idProject;

          $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
          $data['idDepartment'] = $queryDepartment->idDepartment;
          $this->projects_model->indexDepartment($data);
          redirect('clients/runViewClientProjectsInSector/'.$idClient.'/'.$idSector);
      }

  }

  function newProjectInClient(){
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
      $idClient = $this->uri->segment(3);
      $this->form_validation_newProyect();
     if($this->form_validation->run() == FALSE)
      {
         $this->runViewClientProjects($idClient);
      }else{
          $queryclient =  $this->client_model->getClientId($data['nameClient']);
          $data['idClient'] = $queryclient->idClient;
          
          $this->projects_model->newproject($data);
          $queryProject =  $this->projects_model->getProjectId($data['nameProject']);
          $data['idProject'] = $queryProject->idProject;

          $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
          $data['idDepartment'] = $queryDepartment->idDepartment;
          $this->projects_model->indexDepartment($data);
          redirect('clients/runViewClientProjects/'.$idClient);
      }

  }
 
  function newProjectInSector(){
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
      $idSector = $this->uri->segment(3);
      $this->form_validation_newProyect();
     if($this->form_validation->run() == FALSE)
      {
         $this->runViewSectorProjects($idSector);
      }else{
          $queryclient =  $this->client_model->getClientId($data['nameClient']);
          $data['idClient'] = $queryclient->idClient;
          
          $this->projects_model->newproject($data);
          $queryProject =  $this->projects_model->getProjectId($data['nameProject']);
          $data['idProject'] = $queryProject->idProject;

          $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
          $data['idDepartment'] = $queryDepartment->idDepartment;
          $this->projects_model->indexDepartment($data);
          redirect('projects/runViewSectorProjects/'.$idSector);
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
  
  function updateProjectClientInSector(){
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
      $data['idProject'] = $this->uri->segment(3);
      $data['idClient'] = $this->uri->segment(4);
      $data['idSector'] = $this->uri->segment(5);
      $queryProject = $this->projects_model->getProject($data['idProject']);
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
            $this->runViewEditProjectClientInSector($data['idProject'],$data['idClient'],$data['idSector']);
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($data['idProject'],$data);

            $this->projects_model->updateIndexDepartment($data['idProject'],$data);
            redirect('clients/runViewClientProjectsInSector/'.$data['idClient'].'/'.$data['idSector']);
          }

     }
    else
     {
      redirect('clients/runViewClientProjectsInSector/'.$data['idClient']);
     }
  }

  function updateProjectInDeparment(){
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
      $data['idProject'] = $this->uri->segment(3);
      $data['idDepartment'] = $this->uri->segment(4);
      $queryProject = $this->projects_model->getProject($data['idProject']);
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
            $this->runViewEditProjectInSector($data['idProject'],$data['idDepartment']);
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($data['idProject'],$data);

            $this->projects_model->updateIndexDepartment($data['idProject'],$data);
            redirect('projects/runViewDeparmentProjects/'.$data['idDepartment']);
          }

     }
    else
     {
      redirect('projects/runViewDeparmentProjects/'.$data['idDepartment']);
     }
  }

  function updateProjectInSector(){
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
      $data['idProject'] = $this->uri->segment(3);
      $data['idSector'] = $this->uri->segment(4);
      $queryProject = $this->projects_model->getProject($data['idProject']);
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
            $this->runViewEditProjectInSector($data['idProject'],$data['idSector']);
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($data['idProject'],$data);

            $this->projects_model->updateIndexDepartment($data['idProject'],$data);
            redirect('projects/runViewSectorProjects/'.$data['idSector']);
          }

     }
    else
     {
      redirect('projects/runViewSectorProjects/'.$data['idSector']);
     }
  }

  function updateProjectInClient(){
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
      $data['idProject'] = $this->uri->segment(3);
      $data['idClient'] = $this->uri->segment(4);
      $queryProject = $this->projects_model->getProject($data['idProject']);
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
            $this->runViewEditProjectInClient($data['idProject'],$data['idClient']);
          }
        else
          {
            $queryclient =  $this->client_model->getClientId($data['nameClient']);
            $data['idClient'] = $queryclient->idClient;

            $queryDepartment =  $this->department_model->getDepartmentId($data['nameDepartment']);
            $data['idDepartment'] = $queryDepartment->idDepartment;

            $this->projects_model->updateProject($data['idProject'],$data);

            $this->projects_model->updateIndexDepartment($data['idProject'],$data);
            redirect('clients/runViewClientProjects/'.$data['idClient']);
          }

     }
    else
     {
      redirect('clients/runViewClientProjects/'.$idClient);
     }
  }

  function runViewSectorProjects(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idSector'] = $this->uri->segment(3);
    $data['query'] = $this->projects_model->getSectorProjects($data['idSector']);
    $data['sector'] = $this->sector_model->getSector($data['idSector']);
    if ($data['sector']) {
        $data['departments'] = $this->department_model->getAllDepartments();
        $data['clients'] = $this->client_model->getAllClients();
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/sectors/sector_projects',$data);
        $this->load->view('ehtml/footercrud');
    }else{
      redirect('sectors');
    }
  }

  function runViewDeparmentProjects(){
    $session_data = $this->session->userdata('logged_in');
    $name = 'General';
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['email'] = $session_data['email'];
    $data['idDepartment'] = $this->uri->segment(3);
    $data['clients'] = $this->client_model->getAllClients();
    $data['department'] = $this->department_model->getDepartment($data['idDepartment']);
    if ($data['department']) {
      $this->load->model('projects_model','',TRUE);
    $data['query'] = $this->projects_model->getDepartmentProjects($data['idDepartment']);
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/departments/department_projects',$data);
    $this->load->view('ehtml/footercrud');
    }else{
      redirect('departments');
    }
    
  }

  function runViewEditProject(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['id'] = $this->uri->segment(3);
    $data['project'] = $this->projects_model->getProject($data['id']);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/projects/edit-project',$data);
    $this->load->view('ehtml/footercrud'); 
  }

  function runViewEditProjectInClient(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idProject'] = $this->uri->segment(3);
    $data['idClient'] = $this->uri->segment(4);
    $data['project'] = $this->projects_model->getProject($data['idProject']);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/clients/edit-project',$data);
    $this->load->view('ehtml/footercrud'); 
  }

  function runViewEditProjectInDepartment(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idProject'] = $this->uri->segment(3);
    $data['idDepartment'] = $this->uri->segment(4);
    $data['department'] = $this->department_model->getDepartment($data['idDepartment']);
    $data['departments'] = $this->department_model->getAllDepartments();
    if ($data['department']) {
        $data['Project'] = $this->projects_model->getProject($data['idProject']);
        $data['client'] = $this->client_model->getClient($data['Project']->idClient);
        $data['clients'] = $this->client_model->getAllActiveClients();
        $this->load->view('ehtml/headercrud',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/departments/edit-project-in-deparment',$data);
        $this->load->view('ehtml/footercrud'); 
    }else{
        redirect('departments');
    }
   
  }

  function runViewEditProjectInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idProject'] = $this->uri->segment(3);
    $data['idSector'] =$this->uri->segment(4);
    $data['project'] = $this->projects_model->getProject($data['idProject']);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-project-in-sector',$data);
    $this->load->view('ehtml/footercrud'); 
  }

  function runViewEditProjectClientInSector(){
    $session_data = $this->session->userdata('logged_in');
    $data['nameUser'] = $session_data['nameUser'];
    $data['idUser'] =  $session_data['idUser'];
    $data['idProject'] = $this->uri->segment(3);
    $data['idClient'] = $this->uri->segment(4);
    $data['idSector'] =$this->uri->segment(5);
    $data['project'] = $this->projects_model->getProject($data['idProject']);
    $data['department'] = $this->department_model->getAllDepartments();
    $data['client'] = $this->client_model->getAllActiveClients();
    $this->load->view('ehtml/headercrud',$data);
    $this->load->helper(array('form'));
    $this->load->view('home/sectors/edit-project-client-in-sector',$data);
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
    redirect('projects/runViewSectorProjects/'.$idSector);
  }

  function deleteProjectClientInSector($idProject, $idClient, $idSector){
    $this->projects_model->deleteproject($idProject);
    redirect('clients/runViewClientProjectsInSector/'.$idClient.'/'.$idSector);
  }

}
