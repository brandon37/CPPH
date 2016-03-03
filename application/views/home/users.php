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
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>

                
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Usuarios
                            </li>

                       <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">New User</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Usuarios</h2>
                        <div class="table-responsive">
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
                                        if ($users){
                                        foreach ($users->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nombre?></td>
                                                <td><?= $opc->email?></td>
                                                <td><a href="">Edit</a></td>
                                                <td class="text-center text-danger">
                                                    <a href="users/deleteUser/<?=$opc->idusuarios?>">X</a>  
                                                </td>
                                            </tr>


                                        <?php } 
                                        }else{
                                            echo "Error No Existe Ningun Usuario Favor De Agregar";
                                        }
                                    ?>           
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title text-center" id="exampleModalLabel">New User</h3>
                              </div>
                              <div class="modal-body">
                                 <?= validation_errors() ?>
                               <?= form_open('users/newUser') ?>
                                    <div class="form-group">
                                         <label class="sr-only" for="username">Username:</label>
                                         <input type="text" size="20" id="username" name="username" placeholder="Username" class="form-username form-control "required/>
                                     </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="email">Email:</label>
                                        <input type="email" size="20" id="passowrd" name="email"placeholder="Email" class="form-email form-control "required/>
                                     </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="password">Password:</label>
                                        <input type="password" size="20" id="passowrd" name="password"placeholder="Password" class="form-password form-control" required/>
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
