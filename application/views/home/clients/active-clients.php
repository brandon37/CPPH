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
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Clientes
                            </li>

                       <p class="text-right">
                            <a href="<?=base_url()?>clients/inactiveClients" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Inactive Clients</a>
                      
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createClientModal" data-whatever="">New Client</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                <div class="row">
                    <div class="col-lg-6">
                        <h2>Clientes</h2>
                        <div class="table-responsive">
                      <?php 
                        if ($query)
                          { ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Satuts</th>
                                        <th>Sector</th>
                                        <th>Proyectos</th>
                                        <th>Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($query->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameClient?></td>
                                                <td><?= $opc->status?></td>
                                                <td><?= $opc->typeSector?></td>
                                                <td><a href="<?= base_url()?>projects/runViewClientProjects/<?= $opc->idClient?>">Mostrar</a></td>
                                                <td><a href="<?=base_url()?>clients/runViewEditActiveClient/<?=$opc->idClient?>" >Edit</a></td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>clients/deleteActiveClient/<?=$opc->idClient?>" class="confirmationDeleteClient">X</a>  
                                                </td>
                                            </tr>
                                        <?php }  ?>           
                                </tbody>
                            </table>
                            <?php 
                             }else{
                                echo "<h5 class='text-danger'>No Hay Clientes En El Sistema Favor De Agregar</h5>";
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


        <div class="modal fade" id="createClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New Client</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('clients/newClient') ?>
                          <div class="form-group">
                              <label class="" for="clientname">Name Client:</label>
                              <?= form_error('clientname') ?>
                              <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control "required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="text">Status:</label>
                              <?= form_error('status') ?>
                              <select name="status"  class="form-control" required>
                                 <option value="Activo">Activo</option> 
                                 <option value="Inactivo">Inactivo</option> 
                              </select>
                           </div>
                           <div class="form-group">
                                  <label for="sector">Sector:</label>
                                  <?= form_error('typeSector') ?>
                                  <?php if ($sectors) 
                                          {   ?>
                                
                                          <select name="typeSector"  class="form-control" required>
                                              <?php 
                                              foreach ($sectors->result() as $opt) { 
                                              ?>
                                                <option value="<?=$opt->typeSector ?>"><?=$opt->typeSector?></option> 
                                             <?php
                                              }
                                        ?>
                                    </select>
                                    <?php }else{
                                      echo "<h5 class='text-danger'>No Hay Sectores Favor de Agregar</h5>";
                                      } ?>
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
         