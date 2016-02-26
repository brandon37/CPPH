<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol'] = 'smtp';  // protocolo de envio de correo
$config['smtp_host'] = 'ssl://smtp.gmail.com'; // dirección SMTP del servidor                               
$config['smtp_user'] = 'brandon@hydralab.mx'; // remplazarlo por un cuenta real de Gmail - usuario SMTP 
$config['smtp_pass'] = 'brossel23';  
$config['smtp_port'] = '465'; // o el '587,465' --  Puerto SMTP  
$config['smtp_timeout'] = '6';  // Tiempo de espera SMTP(segundos)
//$config['email']['newline']  = '\r\n';
