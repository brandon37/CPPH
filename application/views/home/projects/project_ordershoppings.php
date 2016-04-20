        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-left">
                         Control De Ordenes De Compras <br> Del Proyecto <b class="text-primary"><?= $Project->nameProject ?></b>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                            </li>

                            <li>
                                <i class="fa fa-table"> <a href="<?=base_url()?>projects">Proyectos</a> </i>
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
                        <?php 
                          if($query)
                            { ?>
                                <table class="table table-striped">
                                    <thead class="text-center">
                                        <tr class="text-center">
                                            <th>Cliente</th>
                                            <th>Departamento</th>
                                            <th>Concepto</th>
                                            <th>Monto</th>
                                            <th>DC</th>
                                            <th>DT</th>
                                            <th>Factura</th>
                                            <th>Edit</th>
                                            <th >Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($query->result() as $opc) { ?>
                                                <tr>
                                                    <td><?= $opc->nameClient?></td>
                                                    <td><?= $opc->nameDepartment?></td>
                                                    <td><?= $opc->concept?></td>
                                                    <td><?= $opc->amount?></td>
                                                    <td><?= $opc->dateCreationOS?></td>
                                                    <td><?= $opc->dateTerminationOS?></td>
                                                    <td><a href="<?=base_url() ?>Invoices/runViewInvoiceOrderShoppingInProject/<?= $opc->idOrderShopping ?>/<?= $idProject ?>">Mostrar</a></td>
                                                    <td><a href="<?=base_url()?>ordershopping/runViewEditOrderShoppingsInProject/<?=$opc->idOrderShopping?>/<?= $idProject?>" >Edit</a>
                                                    </td>
                                                    <td class="text-center text-danger">
                                                        <a href="<?=base_url()?>ordershopping/deleteorderShoppingInProject/<?=$opc->idOrderShopping?>/<?= $idProject ?>" class="confirmationDeleteOrderShopping">X</a>  
                                                    </td>
                                                </tr>


                                            <?php } ?>           
                                       
                                    </tbody>
                                </table>
                            <?php 
                              }else{
                                      echo "<h5 class='text-danger'>No Existe Ninguna Orden de compra En El Proyecto \" " .$Project->nameProject. " \"  Favor De Agregar</h5>";
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


        <div class="modal fade" id="createordershopping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New Ordershopping</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('ordershopping/newOrderShoppingProject/'.$idProject) ?>
                          <div class="form-group">
                               <?= form_error('idProject') ?>
                               <input type="hidden" size="20" id="idProject" name="idProject" value="<?=
                               $idProject?>" class="form-nameProject form-control" required/>
                           </div>
                          <div class="form-group">
                           <?= form_error('nameDepartment') ?>
                           <label class="" for="nameDepartment">Name Department:</label>
                           <?php 
                              if ($departments) 
                                {?>
                                 <select name="nameDepartment"  class="form-control" value="<?= $ordershopping->nameDepartment ?>" required>
                                    <?php 
                                    foreach ($departments->result() as $opt)
                                     { 
                                       ?>
                                         <option value="<?=$opt->nameDepartment ?>"><?=$opt->nameDepartment?></option>  
                                    <?php
                                   }
                              ?></select> <?php
                                 }else{
                                  echo '<h4 class="text-danger">"No Hay Departamentos Favor De Agregar"</h4>';
                                 }
                              
                              ?>   
                       </div>
                           <div class="form-group">
                              <label class="" for="text">concept:</label>
                              <?= form_error('concept') ?>
                              <input type="text" size="20" id="concept" name="concept"placeholder="Concepto" class="form-concept form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="amount">amount:</label>
                              <?= form_error('amount') ?>
                              <input type="text" size="20" id="amount" name="amount" placeholder="Amount" class="form-amount form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="dateCreation">Date Creation:</label>
                              <?= form_error('dateCreation') ?>
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