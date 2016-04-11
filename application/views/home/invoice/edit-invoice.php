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
                           <li>
                             <i class="fa fa-table"> <a href="<?=base_url()?>invoices"> Facturas </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Edit Facturas
                          </li>
                     
                      </ol>
                  </div>
              </div>
        <?= form_open('invoices/updateinvoice/'.$id); ?>    
          <?php 
              if ($invoice){
                 ?>
                <div class="form-group">
                    <?= form_error('noInvoice') ?>
                    <label class="sr-only" for="invoice">invoice:</label>
                    <input type="text" size="20" id="invoice" name="noinvoice" placeholder="Factura" value="<?= $invoice->noInvoice ?>" class="form-invoice form-control" required/>
                        
                 </div>
                 <div class="form-group">
                    <?= form_error('status') ?>
                    <label class="sr-only" for="status">status:</label>
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
                               