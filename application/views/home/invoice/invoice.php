        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Facturas
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>

                
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Facturas
                            </li>

                       <p class="text-right">
                            <button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#createinvoiceModal" data-whatever="">New invoice</button>
                       </p>
                       
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Facturas</h2>
                        <div class="table-responsive">
                        <?php 
                          if ($query)
                            { ?>
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
                                        foreach ($query->result() as $opc) 
                                          { ?>
                                            <tr>
                                                <td><?= $opc->noInvoice?></td>
                                                <td><a href="<?=base_url()?>invoices/runViewEditInvoice/<?=$opc->idInvoice?>" >Edit</a></td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>invoices/deleteinvoice/<?=$opc->idInvoice?>" class="confirmationDeleteInvoice">X</a>  
                                                </td>
                                            </tr>
                                  <?php }  ?>                    
                                </tbody>
                            </table>
                      <?php }else{
                                  echo "<h5 class='text-danger'> No Hay Ninguna Factura En El Sistema Favor De Agregar</h5>";
                                 }
                        ?>    
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                  <?= $pagination?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


        <div class="modal fade" id="createinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="myModalLabel text-center" id="exampleModalLabel">New invoice</h3>
                    </div>
                    <div class="modal-body">
                       <?= form_open('invoices/newinvoice') ?>
                           <div class="form-group">
                              <label class="" for="invoice">Number Invoice:</label>
                              <?= form_error('noInvoice') ?>
                              <input type="text" size="20" id="invoice" name="noInvoice" placeholder="Factura" value="" class="form-invoice form-control" required/>
                           </div>
                            <div class="form-group">
                              <label class="" for="text">Status:</label>
                              <?= form_error('status') ?>
                              <select name="status"  class="form-control" required>
                                 <option value="No Pagado">No Pagado</option> 
                                 <option value="Pagado">Pagado</option> 
                              </select>
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