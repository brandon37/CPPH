
        <?= validation_errors() ?>
        <?= form_open('clients/updateActiveClient/'.$id); ?>    
          <?php 
              if ($client){
              foreach ($client->result() as $opc) { 
                 ?>
                
                 <div class="form-group">
                     <label class="sr-only" for="clientname">NameClient:</label>
                     <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control" value="<?= $opc->nameClient?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="sr-only" for="text">Status:</label>
                    <input type="text" size="20" id="status" name="status"placeholder=""value="Activo"  class="form-status form-control" value="<?= $opc->status?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="sr-only" for="sector">Sector:</label>
                    <input type="sector" size="20" id="sector" name="sector" placeholder="sector" value="1" class="form-sector form-control" value="<?= $opc->idSector?>" required/>
                 </div>
                 <button type="submit" class="btn btn-primary">Save</button> 

           </form>
              <?php } 
              }else{
                  echo "Error No Existe Ningun Usuario Favor De Agregar";
              }
          ?>           
                           