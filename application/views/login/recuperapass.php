       <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Control De Pagos De Proyectos Hydralab</strong></h1>
                            <div class="description">
                              
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left text-justify">
                                    <h3>Recuperar contraseña</h3>
                                    <p>Introduce tu Email para recibir un enlace para rescuperar tu contraseña.</p>
                                </div>
                            </div>
                            <div class="form-bottom">
                             <?= validation_errors() ?>
                               <?= form_open('verifymail') ?>
                                    <div class="form-group">
                                     <?php
                                     $email = array(
                                         'size'=>"20",
                                         'type' => "email",
                                         'id' => "user", 
                                         'name' => 'mail',
                                         'placeholder' => 'Email',
                                         'class'=>"form-username form-control",
                                       );

                                    ?>
                                    <?= form_label('', '')?>
                                    <?= form_input($email)?>
                                  
                               <br>
                                     <?= form_button(array(
                                        'type'=>"submit",
                                        'class'=>"btn",
                                        'name' => 'Enviar',
                                        'content' => 'Recuperar'
                                        )); ?>
                                    <?= form_close() ?>
                                <a href="<?=base_url()?>">Regresar</a>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
            
        </div>