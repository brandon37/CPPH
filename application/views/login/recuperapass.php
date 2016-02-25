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
                                    <p>Introduce tu Usuario para recibir un enlace para rescuperar tu contraseña.</p>
                                </div>
                            </div>
                            <div class="form-bottom">
                               <?= form_open('sendmail') ?>
                                    <div class="form-group">
                                         <label class="sr-only" for="username">Username:</label>
                                         <input type="text" size="20" id="user" name="name" placeholder="Username" class="form-username form-control"/>
                                     </div>
                                   <button type="submit" class="btn">Recuperar</button>  
                               </form> <br>
                                <a href="<?=base_url()?>">Regresar</a>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
            
        </div>