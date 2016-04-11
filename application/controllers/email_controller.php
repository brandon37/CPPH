c<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_controller extends CI_Controller {

    function __construct() { 
        parent::__Construct();
        $this->load->library(array('form_validation','email'));
        $this->load->helper(array('url','html'));
       }

function index(){
        
       $data['title'] = 'Formulario de Contacto'; 
       $data['msg'] = NULL;
      
       $this->form_validation->set_rules('name', 'Nombre', 'required|alpha|min_length[3]');
       $this->form_validation->set_rules('phone', 'Celular', 'required|numeric');
       $this->form_validation->set_rules('address', 'Ciudad y dirección', 'required');
       $this->form_validation->set_rules('email', 'Email', 'required|valid_email');   
       $this->form_validation->set_rules('message', 'Mensaje', 'required');   
      
       $this->form_validation->set_message('required', 'el campo %s es requerido');
       $this->form_validation->set_message('valid_email', 'El email no es válido');
          
           $this->form_validation->set_error_delimiters('<ul><li>', '</li></ul>');
      
       $this->form_validation->set_message('required', 'el campo %s es requerido');
       $this->form_validation->set_message('valid_email', 'El email no es válido');
          
           $this->form_validation->set_error_delimiters('<ul><li>', '</li></ul>');
       
       
    if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('send_mail', $data);  

           
            }else{
                       
            $name = $this->input->post('name');
            $mobil = $this->input->post('phone');
            $email = $this->input->post('email');
            $message = $this->input->post('message');
                       
        // Datos para enviar el correo
            $this->email->from('ejemplo@gmail.com', 'Ejemplo');
            $this->email->to($email);
            $this->email->subject('Email enviado con CI y Gmail');               
            $this->email->message($message); 
           	

            if($this->email->send()){
           
            $data['title']='Mensaje Enviado';
            $data['msg'] = 'Mensaje enviado a su email';
                     // echo $this->email->print_debugger(); exit;                             
            $this->load->view('send_mail', $data); 
            $this->email->print_debugger()
           
             }else{
                $data['title']='El mensaje no se pudo enviar';
                $this->load->view('send_mail', $data); 
            	$this->email->print_debugger() 
             } 
                         
           } 
        } 
    }