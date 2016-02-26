<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Sendmail extends CI_Controller  {
 
 function __construct()
 {
   parent::__construct();
   $this->load->helper('form');
   $this->load->model('usuario_model','',TRUE);
   
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
   



	$this->load->config('mandrill');
	$this->load->library('mandrill');

	$mandrill_ready = NULL;

	try {

	    $this->mandrill->init( $this->config->item('mandrill_api_key') );
	    $mandrill_ready = TRUE;

	} catch(Mandrill_Exception $e) {

	    $mandrill_ready = FALSE;

	}

	if( $mandrill_ready ) {

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
		    	 $this->load->view('ehtml/headerL');
				 $this->load->helper(array('form'));
				 $this->load->view('login/emailsent',$data);
				 $this->load->view('ehtml/footerL');
				 }
		     	/*
		     }else{
		     	 echo "error en la contraseña";
		     }
	   // $result = $this->mandrill->messages_send($email);

*/

	}

    
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

