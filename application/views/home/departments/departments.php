        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Departamentos
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>

                
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Departamentos
                            </li>

                       <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createdepartamentModal" data-whatever="">New Departament</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Departamentos</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php 
                                        if ($departments){
                                        foreach ($departments->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameDepartment?></td>
                                                <td><a href="<?=base_url()?>departments/runViewEditdepartament/<?=$opc->idDepartament?>" >Edit</a></td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>departments/deletedepartament/<?=$opc->idDepartament?>" class="confirmationDeletedepartament">X</a>  
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


        <div class="modal fade" id="createdepartamentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New departament</h3>
                    </div>
                    <div class="modal-body">
                       <?= validation_errors() ?>
                       <?= form_open('departments/newDepartment') ?>
                           <div class="form-group">
                              <label class="sr-only" for="departament">departament:</label>
                              <input type="text" size="20" id="departament" name="departament" placeholder="Departamento" value="" class="form-departament form-control" required/>
                              
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