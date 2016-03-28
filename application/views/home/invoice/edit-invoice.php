        <?= validation_errors() ?>
        <?= form_open('invoices/updateinvoice/'.$id); ?>    
          <?php 
              if ($invoice){
              foreach ($invoice->result() as $opc) { 
                 ?>
                <div class="form-group">
                    <label class="sr-only" for="invoice">invoice:</label>
                    <input type="text" size="20" id="invoice" name="noinvoice" placeholder="Factura" value="" class="form-invoice form-control" required/>
                        
                 </div>
                 <div class="form-group">
                    <label class="sr-only" for="status">status:</label>
                    <input type="text" size="20" id="status" name="status" placeholder="Estado" value="" class="form-status form-control" required/>             
                 </div>
                 <div class="modal-footer">
                   <button type="submit" class="btn btn-primary">Save</button> 
                 </div> 
                 </form>
              <?php } 
              }else{
                  echo "Error No Existe Ninguna Factura Favor De Agregar";
              }
          ?>           
                               