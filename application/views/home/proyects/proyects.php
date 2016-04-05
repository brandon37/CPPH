        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Proyectos
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table">Proyectos</i>
                            </li>

                       <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createProyectModal" data-whatever="">New Proyect</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-10">
                        <h2>Proyectos</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Price</th>
                                        <th>DC</th>
                                        <th>DT</th>
                                        <th>Cliente</th>
                                        <th>Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php 
                                        if ($query){
                                        foreach ($query->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameProyect?></td>
                                                <td><?= $opc->nameDepartment?></td>
                                                <td><?= $opc->price?></td>
                                                <td><?= $opc->dateCreation?></td>
                                                <td><?= $opc->dateTermination?></td>
                                                <td><?= $opc->nameClient?></td>
                                                <td><a href="<?=base_url()?>proyects/runViewEditProyect/<?=$opc->idProyect?>" >Edit</a>
                                                </td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>proyects/deleteProyect/<?=$opc->idProyect?>" class="confirmationDeleteProyect">X</a>  
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
                     <?= $pagination ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


        <div class="modal fade" id="createProyectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New Proyect</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('proyects/newProyect') ?>
                          <div class="form-group">
                              <?=  form_error('proyectname') ?>
                               <label class="sr-only" for="proyectname">NameProyect:</label>
                               <input type="text" size="20" id="proyectname" name="proyectname" placeholder="Name Proyect" class="form-proyectname form-control" required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('department')?>
                              <label class="sr-only" for="text">Departament:</label>
                              <input type="text" size="20" id="department" name="department"placeholder="Departamento" class="form-department form-control" required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('price')?>
                              <label class="sr-only" for="price">Price:</label>
                              <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('dateCreation')?>
                              <label class="sr-only" for="dateCreation">Date Creation:</label>
                              <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('nameClient')?>
                              <label class="sr-only" for="client">Client:</label>
                              <input type="text" size="20" id="client" name="nameClient" placeholder="Client" class="form-client form-control" required/>
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
         