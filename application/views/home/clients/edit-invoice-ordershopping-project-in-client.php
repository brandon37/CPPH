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
                             <i class="fa fa-table"> <a href="<?=base_url()?>invoices"> Facturas </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Editar Factura
                          </li>
                     
                      </ol>
                  </div>
              </div>
              <?= form_open('invoices/updateInvoiceOrderShoppingProjectInClient/'.$idInvoice.'/'.$idOrderShopping.'/'.$idProject.'/'.$idClient); ?>    
                <?php 
                    if ($invoice){
                       ?>
                    <div class="col-xs-6 col-sm-6 well"> 
                      <div class="form-group">
                          <label class="" for="invoice">Number Invoice:</label>
                          <?= form_error('noInvoice') ?>
                          <input type="text" size="20" id="invoice" name="noinvoice" placeholder="Factura" value="<?= $invoice->noInvoice ?>" class="form-invoice form-control" required/>
                       </div>
                       <div class="form-group">
                          <label class="" for="status">status:</label>
                          <?= form_error('status') ?>
                          <input type="text" size="20" id="status" name="status" placeholder="Estado" class="form-status form-control" value="<?= $invoice->status ?>" required/>             
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
      
            
