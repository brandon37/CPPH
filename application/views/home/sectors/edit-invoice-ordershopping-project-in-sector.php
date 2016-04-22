    <div id="page-wrapper">

      <div class="container-fluid">

          <!-- Page Heading -->
        <div class="col-xs-12 col-sm-12">  
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                       Control De Facturas
                      </h1>
                      <ol class="breadcrumb">
                          <li>
                              <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                          </li>

                          <li>
                              <i class="fa fa-table"> <a href="<?=base_url()?>sectors">Sectores</a> </i>
                          </li>

                           <li>
                              <i class="fa fa-table"> <a href="<?=base_url()?>projects/runViewSectorProjects/<?= $idSector?>">Proyectos del Sector</a> </i>
                           </li>

                          <li>
                            <i class="fa fa-table"><a href="<?=base_url()?>ordershopping/runViewProjectOrderShoppingsInSector/<?=$idProject ?>/<?=$idSector?>"> Ordenes de Compra</a></i> 
                        </li> 
                           
                          <li>
                              <i class="fa fa-table"></i> <a href="<?= base_url() ?>invoices/runViewInvoiceOrderShoppingProjectInSector/<?= $idOrderShopping ?>/<?= $idProject ?>/<?= $idSector ?>">Factura</a> 
                          </li> 
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Editar Factura
                          </li>
                     
                      </ol>
                  </div>
              </div>
              <?= form_open('invoices/updateInvoiceOrderShoppingProjectInSector/'.$idInvoice.'/'.$idOrderShopping.'/'.$idProject.'/'.$idSector); ?>    
                <?php 
                    if ($invoice){
                       ?>
                    <div class="col-xs-6 col-sm-6 well"> 
                      <div class="form-group">
                          <?= form_error('idOrderShopping') ?>
                          <input type="hidden" size="20" id="invoice" name="idOrderShopping" placeholder="Factura" value="<?= $invoice->idOrderShopping ?>" class="form-invoice form-control" required/>
                       </div>
                      <div class="form-group">
                          <label class="" for="invoice">Number Invoice:</label>
                          <?= form_error('noInvoice') ?>
                          <input type="text" size="20" id="invoice" name="noinvoice" placeholder="Factura" value="<?= $invoice->noInvoice ?>" class="form-invoice form-control" required/>
                       </div>
                       <div class="form-group">
                            <label>Status:</label>
                            <?= form_error('status') ?>
                            <select name="status"  class="form-control" required>
                            <?php if($invoice->status == 'Pagado')
                                 { ?>
                                    <option value="Pagado" selected="Selected">Pagado</option> 
                                    <option value="No Pagado" >No Pagado</option> 
                             <?php } else 
                                    {?>
                                      <option value="No Pagado" selected="Selected">No Pagado</option> 
                                      <option value="Pagado">Pagado</option> 
                                <?php } ?>
                            </select>
                         </div>
                       <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Save</button> 
                       </div> 
                       </form>
                    <?php 
                    }else{
                        redirect('invoices');
                    }
                ?>              
         </div> 

      </div>

    </div>            
      
            
