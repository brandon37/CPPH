        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Clientes de Sectores
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-table"></i> <a href="<?= base_url()?>sectors">Sectores</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Clientes
                            </li>

                         <p class="text-right">
                              <a href="<?=base_url()?>clients/inactiveClients" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Clients</a>
                        
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
                                        if ($query){
                                        foreach ($query->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameClient?></td>
                                                <td><?= $opc->status?></td>
                                                <td><?= $opc->typeSector?></td>
                                                <td><a href="<?= base_url()?>clients/runViewClientProjectsInSector/<?= $opc->idClient?>/<?=$opc->idSector?>">Mostrar</a></td>
                                                <td><a href="<?=base_url()?>clients/runViewEditClientInSector/<?=$opc->idClient?>/<?=$id?>" >Edit</a></td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>clients/deleteClientInSector/<?=$opc->idClient?>/<?=$id?>" class="confirmationDeleteClient">X</a>  
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
                              <?= form_error('clientname') ?>
                              <label class="" for="">NameClient:</label>
                              <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control "required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('status') ?>
                              <label class="sr-only" for="text">Status:</label>
                              <select name="status"  class="form-control" required>
                                 <option value="Activo">Activo</option> 
                                 <option value="Inactivo">Inactivo</option> 
                              </select>
                           </div>
                           <div class="form-group">
                              <?= form_error('typeSector') ?>
                              <label class="sr-only" for="sector">Sector:</label>
                              <input type="text" size="20" id="sector" name="typeSector" placeholder="Sector" value="" class="form-sector form-control" required/>
                              
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
