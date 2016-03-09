        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Clientes
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>

                
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Clientes
                            </li>

                       <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createUserModal" data-whatever="@fat">New Client</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Clientes</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Satuts</th>
                                        <th>Sector</th>
                                        <th>Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php 
                                        if ($clients){
                                        foreach ($clients->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameClient?></td>
                                                <td><?= $opc->status?></td>
                                                <td><?= $opc->idSector?></td>
                                                <td><a href="<?=base_url()?>clients/runViewEditClient/<?=$opc->idClient?>" >Edit</a></td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>clients/deleteClient/<?=$opc->idClient?>">X</a>  
                                                </td>
                                            </tr>


                                        <?php } 
                                        }else{
                                            echo "Error No Existe Ningun Cliente Favor De Agregar";
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


        <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title text-center" id="exampleModalLabel">New Client</h3>
                    </div>
                    <div class="modal-body">
                       <?= validation_errors() ?>
                       <?= form_open('clients/newClient') ?>
                          <div class="form-group">
                               <label class="sr-only" for="clientname">NameClient:</label>
                               <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control "required/>
                           </div>
                           <div class="form-group">
                              <label class="sr-only" for="text">Status:</label>
                              <input type="text" size="20" id="status" name="status"placeholder=""value="Activo"  class="form-status form-control "required/>
                           </div>
                           <div class="form-group">
                              <label class="sr-only" for="sector">Sector:</label>
                              <input type="sector" size="20" id="sector" name="sector" placeholder="sector" value="1" class="form-sector form-control" required/>
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
         