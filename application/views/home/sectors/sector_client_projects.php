    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                     Control De Proyectos Del Cliente <?php if (isset($client->nameClient)) {
                            echo $client->nameClient;
                     }  ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>

                        <li>
                           <i class="fa fa-table"> <a href="<?=base_url()?>sectors"> Sectores </a></i> 
                        </li>

                        <li>
                           <i class="fa fa-table"> <a href="<?=base_url()?>sectors/runViewSectorInClients/<?=$idSector?>"> Clientes </a></i> 
                        </li>
                         
                        <li class="active">
                            <i class="fa fa-table"></i> Proyectos del Cliente
                        </li> 

                        <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createProjectModal" data-whatever="">New Project</button>
                        </p>
                         
                    </ol>
                </div>
            </div>
            <!-- /.row -->

              <div class="row">
                    <div class="col-lg-10">
                        <h2>Proyectos</h2>
                        <div class="table-responsive">
                        <?php 
                             if ($query){ ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Price</th>
                                        <th>DC</th>
                                        <th>DT</th>
                                        <th>Ordenes de Compra</th>
                                        <th>Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php
                                        foreach ($query->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameProject?></td>
                                                <td><?= $opc->nameDepartment?></td>
                                                <td><?= $opc->price?></td>
                                                <td><?= $opc->dateCreation?></td>
                                                <td><?= $opc->dateTermination?></td>
                                                <td><a href="<?= base_url()?>ordershopping/runViewOrderShoppingsProjectClientInSector/<?=$opc->idProject?>/<?=$opc->idClient?>/<?=$idSector?>">Ver</a></td>
                                                <td><a href="<?= base_url()?>projects/runViewEditProjectClientInSector/<?=$opc->idProject?>/<?=$opc->idClient?>/<?=$idSector?>" >Edit</a>
                                                </td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>projects/deleteProjectClientInSector/<?=$opc->idProject?>/<?=$idClient ?>/<?=$idSector ?>" class="confirmationDeleteProject">X</a>  
                                                </td>
                                            </tr>   
                                   
                               <?php } ?>
                               </tbody>
                            </table><?php
                                        }else{
                                            echo "<h4 class='text-danger'>El Cliente "; if(isset($client->nameClient)) {
                                              echo $client->nameClient;
                                            } echo " No Contiene Proyectos</h4>";
                                        }
                                    ?>  
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

        <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New Project</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('projects/newProjectClientInSector/'.$idClient.'/'.$idSector) ?>
                          <div class="form-group">
                              <label class="" for="projectname">Name Project:</label>
                              <?=  form_error('projectname') ?>
                              <input type="text" size="20" id="projectname" name="projectname" placeholder="Name Project" class="form-projectname form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="text">Department:</label>
                              <?= form_error('department')?>
                              <input type="text" size="20" id="department" name="department"placeholder="Departamento" class="form-department form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="price">Price:</label>
                              <?= form_error('price')?>
                              <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="dateCreation">Date Creation:</label>
                              <?= form_error('dateCreation')?>
                              <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" required/>
                           </div>
                           <div class="form-group">
                              <input type="hidden" size="20" id="client" name="nameClient" value="<?= $client->nameClient ?>" class="form-client form-control" required/>
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

         