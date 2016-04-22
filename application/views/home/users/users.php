        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Usuarios
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>

                
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Usuarios
                            </li>

                       <p class="text-right"> 
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createUserModal">New User</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


              <!--  <div class="container">
                     
                     <div class="buscador">
                       <aside>
                          <div class="noticias linea">
                          <h3>Buscador</h3>
                        </aside>
                     </div>

                    <article>
                       <div class="formulario">
                          <input type="text" name="autocompletar" id="autocompletar" class="form-control" placeholder="Buscar...." /> 
                       </div>
                     </article>
                     
                     <aside>
                       <div class="formulario">
                          <div class="contenedor" id="contenedor"></div>
                       </div>
                     </aside>
                    --> 
                    
                   
                   <div class="espacio"></div>
                   
                   
                  </div>



                <div class="row">
                    <div class="col-lg-6">
                        <h2>Usuarios</h2>
                        <div class="table-responsive">
                      <?php if ($query)
                            { ?>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Edit</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach ($query->result() as $opc)
                                             { ?>
                                              <tr>
                                                  <td><?= $opc->nameUser?></td>
                                                  <td><?= $opc->email?></td>
                                                  <td><a href="<?=base_url()?>users/runViewEditUser/<?=$opc->idUser?>" >Edit</a></td>
                                                  <td class="text-center text-danger">
                                                      <a href="<?=base_url()?>users/deleteUser/<?=$opc->idUser?>"
                                                      class="confirmationDeleteUser">X</a>  
                                                  </td>
                                              </tr>
                                        <?php } ?>           
                                    </tbody>
                                </table>
                         <?php   }else{
                                        echo "<h5 class='text-danger'> No Hay Ningun Usuario General En El Sistema Favor De Agregar</h5>";
                                    }
                                ?>   
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                        <?= $pagination ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


        <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New User</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('users/newUser') ?>
                          <div class="form-group">
                               <label class="" for="username">User Name:</label>
                               <?=form_error('username') ?>
                               <input type="text" size="20" id="username" name="username" placeholder="Username" class="form-username form-control "required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="email">Email:</label>
                              <?= form_error('email') ?>
                              <input type="email" size="20" id="email" name="email"placeholder="Email" class="form-email form-control "required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="password">Password:</label>
                              <?= form_error('password') ?>
                              <input type="password" size="20" id="passowrd" name="password"placeholder="Password" class="form-password form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="password">Repeat Password:</label>
                              <?= form_error('passwordconf') ?>
                              <input type="password" size="20" id="passowrd" name="passwordconf"placeholder="Repeat Password" class="form-password form-control" required/>
                           </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary">Save</button> 
                         </div> 
                       </form>
                    </div>
                </div>
             </div>
        </div>
         <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h3 id="myModalLabel">We'd Love to Hear From You</h3>
                    </div>
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center">New User</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('users/newUser') ?>     
                      <?php 
                          if ($users){
                          foreach ($users->result() as $opc) { 
                            if($idUserSelect==$opc->idUser){ ?>
                            
                            <div class="form-group">
                               <?= form_error('username') ?>
                               <label class="" for="username">User Name:</label>
                               <input type="text" size="20" id="username" name="username" placeholder="Username" class="form-username form-control" value="<?= $opc->nameUser?>" required/>
                            </div>
                            <div class="form-group">
                              <?= form_error('email') ?>
                              <label class="" for="email">Email:</label>
                              <input type="email" size="20" id="passowrd" name="email"placeholder="Email" class="form-email form-control" value="<?= $opc->email?>" required/>
                            </div>
                            <div class="form-group">
                              <?= form_error('password') ?>
                              <label class="" for="password">Password:</label>
                              <input type="password" size="20" id="passowrd" name="password"placeholder="Password" class="form-password form-control" value="<?= $opc->pass?>" required/>
                            </div>
                           

                          <?php } }
                          }else{
                              echo "Error No Existe Ningun Usuario Favor De Agregar";
                          }
                      ?>           
                          <div class="modal-footer">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-primary">Save</button> 
                          </div> 
                        
                          
                       </form>
                    </div>
                </div>
             </div>
        </div>
<br><br><br>


