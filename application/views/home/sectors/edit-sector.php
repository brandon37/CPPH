            <?= validation_errors() ?>
            <?= form_open('sectors/updateSector/'.$id); ?>    
              <?php 
                  if ($sector){
                  foreach ($sector->result() as $opc) { 
                     ?>
                    
                     <div class="form-group">
                         <label class="sr-only" for="clientname">Sector:</label>
                         <input type="text" size="20" id="clientname" name="sector" placeholder="Name Sector" class="form-clientname form-control" value="<?= $opc->typeSector?>" required/>
                     </div>
                   
                     <button type="submit" class="btn btn-primary">Save</button> 

               </form>
                  <?php } 
                  }else{
                      echo "Error No Existe Ningun Usuario Favor De Agregar";
                  }
              ?>           
                               