<!DOCTYPE html>
<html>    
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?php echo $title;?></title>
<style type="text/css">
body {
    margin: 0px; color: #444;
    background-color: #ffffff;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px; padding-top: 20px; padding-bottom: 20px;}
    
#container{ 
    -moz-border-radius: 10px;
    -khtml-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px; border: 1px solid #ccc; padding: 20px;
    width:500px;     margin-left: auto; margin-right: auto;
    padding-top:3px; padding-bottom: 2px;}  
   
h1, h2, h3, h4, h5, h6 {font-weight: bold;color: #21759b;}

#content{
width: 790px;padding:5px; min-height:400px;}

#form_email{
    width:500px;
    border: 1px solid #E5E5E5;
    box-shadow: 0 2px 3px #C8C8C8;
    margin-top: 20px;
    margin-bottom:20px; padding: 16px;
    width: 420px; 
}
#error{
    width:400px; 
    border: 1px solid #bf0100;
    background-color: #FFEBE8;
    margin: 5px 30px 10px 30px;

}
</style>
</head>
<body>
<div id="container">
<div>
    <h1><?php echo $title;?></h1>
</div>
<?php if(validation_errors()){ ?>
    
    <div id="error"><?php echo validation_errors();?></div>
    
<?php  } // fin del if que evalua los errores del formulario

  $attributes = array('id' => 'form_email');
  
   if($msg===NULL){
      
 echo form_open('email_controller', $attributes);

       $name = array('name'=>'name', 'id'=>'name','placeholder'=>'Nombre','value'=>set_value('name'), 'size'=> '35',);
       $phone = array('name'=>'phone', 'id'=>'phone','placeholder'=>'Teléfono','value'=>set_value('phone'), 'size'=> '35',);
       $address = array('name'=>'address','id'=>'address','placeholder'=>'Ciudad y dirección','value'=>set_value('address'), 'size'=> '35',);
       $email = array('name'=>'email', 'id'=>'email','placeholder'=>'Email', 'value'=>set_value('email'), 'size'=> '35',);  
       $message =array('name'=>'message', 'cols'=>'50', 'id'=>'message','placeholder'=>'Mensaje...','value'=>set_value('message'),);
 ?> 
      <div><?php echo form_label('Nombre');?></div>
              
      <div><?php echo form_input($name);?></div> 
      <div><?php echo form_label('Teléfono');?></div>   
      <div><?php echo form_input($phone);?></div> 
      <div><?php echo form_label('Ciudad y direccción');?></div>  
      <div><?php echo form_input($address);?></div> 
      <div><?php echo form_label('Email');?></div> 
      <div><?php echo form_input($email);?></div> 
      <div><?php echo form_label('Mensaje');?></div>
      <div><?php echo form_textarea($message)?></div>     
<div>
    <?php echo form_submit('submit', 'Enviar');?>  
</div> 
<?php echo form_close();?>  

 <?php }else
           { echo anchor('email_controller','Enviar otro mensaje').br(2); 
       }?>
</div>
</body>
</html>