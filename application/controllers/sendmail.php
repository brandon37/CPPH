<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Sendmail extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('usuario_model','',TRUE);
 }
 
public function index(){
    
    $this->load->library('email');
    $mail = $this->input->post('name');
	$this->email->from('brandonedu9@gmail.com', 'Hydralab');
	$this->email->to($mail);
    $pass = $this->usuario_model->obtenerusuariopass($mail);
	$this->email->subject('Recupera Tu Contraseña');
	$this->email->message('Tu contraseña es:',$pass,'<br> <a href="http://localhost:8888/CPPH/"> Ingresa tu contraseña</a>.');
	if($this->email->send()){
			 redirect('sendmail');
			 echo($this->email->print_debugger());
		}
		else{
			 echo($this->email->print_debugger());
	}
     
  }
 
}