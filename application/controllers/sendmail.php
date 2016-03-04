<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Sendmail extends CI_Controller  {
 
 function __construct()
 {
   parent::__construct();
   $this->load->helper('form');
   $this->load->model('user_model','',TRUE);
   $this->load->library(array('form_validation','email'));
   $this->load->helper(array('url','html'));
   $this->load->library('email','','correo');
 }
 
public function index(){

	/*
	 $this->load->library('email');

    $this->email->from('brandon@hydralab.mx', 'Brandon Rosales');
    $this->email->to('brandon@hydralab.mx');

    $this->email->subject('Sending Email from CodeIgniter with Mandrill');
    $this->email->message('If you forgot how to do this, go ahead and refer to: <a href="http://the-amazing-php.blogspot.com/2015/05/codeigniter-send-email-with-mandrill.html">The Amazing PHP</a>.');

    if($this->email->send()){
    		 $this->load->view('ehtml/headerL');
			 $this->load->helper(array('form'));
			 $this->load->view('login/emailsent');
			 $this->load->view('ehtml/footerL');
		}
		else{
			 echo($this->email->print_debugger());
	}

*/

	//This method will have the credentials validation


	    //Send us some email!
	    $flash_data  = $this->session->flashdata('my_data');
		if ($flash_data)
		{
		   $data['passwd'] = $flash_data;
		
	  /*  $email = array(
	        'html' => '<p>This is my message<p>', //Consider using a view file
	        'text' => 'This is my plaintext message',
	        'subject' => 'This is my subject',
	        'from_email' => $mail,
	        'from_name' => 'Brandon Rosales',
	        'to' => array(array('email' => 'brandon@hydralab.mx' )) //Check documentation for more details on this one
	        //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
	        );
			 
		     $data['passwd'] =  $this->usuario_model->obtenerUsuarioPass($mail);
		     if ($data['passwd']) {*/
		     $this->email->from('brandon@hydralab.mx', 'Hydralab');
             $this->email->to($data['passwd']);
             $this->email->subject('Email enviado con CI y Gmail');     
             $message = 'Tu contraseña es:<?= $pass ?> <br> <a href="http://localhost:8888/CPPH/"> Ingresa tu contraseña</a>.';      
             $this->email->message($message); 
           
            if($this->email->send()){
			 redirect('sendmail');
			 echo($this->email->print_debugger());
		}
		else{
			 echo($this->email->print_debugger());
			}	

		 }else{
				 redirect('login');
				 }
		     	/*
		     }else{
		     	 echo "error en la contraseña";
		     }
	   // $result = $this->mandrill->messages_send($email);

*/


    
   /* $this->load->library('email');
    $mail = $this->input->post('name');
	$this->email->from('brandonedu9@gmail.com');
	$this->email->to($mail);
    $pass = $this->usuario_model->obtenerusuariopass($mail);
	$this->email->subject('Recupera Tu Contraseña');
	$this->email->message('Tu contraseña es:<?= $pass ?> <br> <a href="http://localhost:8888/CPPH/"> Ingresa tu contraseña</a>.');
	if($this->email->send()){
			 redirect('sendmail');
			 echo($this->email->print_debugger());
		}
		else{
			 echo($this->email->print_debugger());
	}
     */
  }
 
}

