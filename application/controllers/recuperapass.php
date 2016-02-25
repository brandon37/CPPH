<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Recuperapass extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('usuario_model','',TRUE);
 }
 
public function index(){  
      $this->load->view("ehtml/headerL");
      $this->load->helper(array('form'));
      $this->load->view("login/recuperapass");
      $this->load->view("ehtml/footerL");
     
  }
 
}