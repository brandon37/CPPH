
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
                  echo "Error No Existe Ninguna Factura Favor De Agregar";
              }
          ?>           
                               