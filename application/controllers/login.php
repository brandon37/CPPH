<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();

	}
	
	public function index(){
		if (isset($_POST['pass'])) {
			$this->load->model("usuario_model");
		if ($this->usuario_model->login($_POST['name'],$_POST['pass'])) {
			$this->load->view('welcome_message');
		}else{
			$this->load->view("ehtml/headerL");
			$this->load->helper(array('form'));
			$this->load->view("login/login");
			$this->load->view("ehtml/footerl");
		}
			
		}
			$this->load->view("ehtml/headerL");
			$this->load->helper(array('form'));
			$this->load->view("login/login");
			$this->load->view("ehtml/footerl");
		 
	}
}
