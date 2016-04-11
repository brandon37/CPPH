        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Ordenes De Compras de Proyecto
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"> Ordenes De Compras</i>
                            </li>

                       <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createordershopping" data-whatever="">New Ordershopping</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-10">
                        <h2>Ordenes De Compras</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="text-center">
                                    <tr class="text-center">
                                        <th>Cliente</th>
                                        <th>Name</th>
                                        <th>Concepto</th>
                                        <th>Monto</th>
                                        <th>DC</th>
                                        <th>DT</th>
                                        <th>Edit</th>
                                        <th >Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php 
                                        if ($query){
                                        foreach ($query->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameClient?></td>
                                                <td><?= $opc->nameProject?></td>
                                                <td><?= $opc->concept?></td>
                                                <td><?= $opc->amount?></td>
                                                <td><?= $opc->dateCreation?></td>
                                                <td><?= $opc->dateTermination?></td>
                                                <td><a href="<?=base_url()?>ordershopping/runViewEditordershopping/<?=$opc->idOrderShopping?>" >Edit</a>
                                                </td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>ordershopping/deleteordershopping/<?=$opc->idOrderShopping?>" class="confirmationDeleteOrderShopping">X</a>  
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


        <div class="modal fade" id="createordershopping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New Ordershopping</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('ordershopping/newordershopping') ?>
                          <div class="form-group">
                               <?= form_error('nameProyect') ?>
                               <label class="sr-only" for="nameProyect">Name Proyect:</label>
                               <input type="text" size="20" id="nameProyect" name="nameProyect" placeholder="Name Proyect" class="form-nameProyect form-control" required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('concept') ?>
                              <label class="sr-only" for="text">concept:</label>
                              <input type="text" size="20" id="concept" name="concept"placeholder="Concepto" class="form-concept form-control" required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('amount') ?>
                              <label class="sr-only" for="amount">amount:</label>
                              <input type="text" size="20" id="amount" name="amount" placeholder="Amount" class="form-amount form-control" required/>
                           </div>
                           <div class="form-group">
                              <?= form_error('dateCreation') ?>
                              <label class="sr-only" for="dateCreation">Date Creation:</label>
                              <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" required/>
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
         