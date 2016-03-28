        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De ordershoppingos
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table">ordershoppingos</i>
                            </li>

                       <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createordershopping" data-whatever="">New ordershopping</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-10">
                        <h2>ordershoppingos</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>concept</th>
                                        <th>amount</th>
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
                                                <td><?= $opc->nameordershopping?></td>
                                                <td><?= $opc->concept?></td>
                                                <td><?= $opc->amount?></td>
                                                <td><?= $opc->dateCreation?></td>
                                                <td><?= $opc->dateTermination?></td>
                                                <td><?= $opc->nameClient?></td>
                                                <td><a href="<?=base_url()?>ordershopping/runViewEditordershopping/<?=$opc->idordershopping?>" >Edit</a>
                                                </td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>ordershopping/deleteordershopping/<?=$opc->idordershopping?>" class="confirmationDeleteOrderShopping">X</a>  
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


        <div class="modal fade" id="createordershopping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New ordershopping</h3>
                    </div>
                    <div class="modal-body">
                       <?= validation_errors() ?>
                       <?= form_open('ordershopping/newordershopping') ?>
                          <div class="form-group">
                               <label class="sr-only" for="ordershoppingname">Nameordershopping:</label>
                               <input type="text" size="20" id="ordershoppingname" name="ordershoppingname" placeholder="Name ordershopping" class="form-ordershoppingname form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="sr-only" for="text">concept:</label>
                              <input type="text" size="20" id="concept" name="concept"placeholder="Departamento" class="form-concept form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="sr-only" for="amount">amount:</label>
                              <input type="text" size="20" id="amount" name="amount" placeholder="amount" class="form-amount form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="sr-only" for="dateCreation">Date Creation:</label>
                              <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="sr-only" for="idproyect">idproyect:</label>
                              <input type="text" size="20" id="idproyect" name="idClient" placeholder="idproyect" class="form-idproyect form-control" required/>
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
         