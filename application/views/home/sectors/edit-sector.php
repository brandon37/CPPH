            <?= form_open('sectors/updateSector/'.$id); ?>    
              <?php 
                  if ($sector){
                     ?>
                     <div class="form-group">
                         <?= form_error('sector')?>
                         <label class="sr-only" for="clientname">Sector:</label>
                         <input type="text" size="20" id="clientname" name="sector" placeholder="Name Sector" class="form-clientname form-control" value="<?= $sector->typeSector?>" required/>
                     </div>
                   
                     <button type="submit" class="btn btn-primary">Save</button> 

               </form>
                  <?php 
                  }else{
                      echo "Error No Existe Ningun Usuario Favor De Agregar";
                  }
              ?>           
                               