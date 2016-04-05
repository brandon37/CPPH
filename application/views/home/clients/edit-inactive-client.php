      <?= validation_errors() ?>
      <?= form_open('clients/updateInactiveClient/'.$id); ?>    
        <?php 
            if ($client){
               ?>
                 <div class="form-group">
                    <?= form_error('clientname') ?>
                    <label class="sr-only" for="clientname">NameClient:</label>
                    <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control" value="<?= $client->nameClient?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('status') ?>
                    <label class="sr-only" for="text">Status:</label>
                    <select name="status"  class="form-control" required>
                        <option value="Activo">Activo</option> 
                        <option value="Inactivo">Inactivo</option> 
                  </select>
                 </div>
                  <div class="form-group">
                    <?= form_error('sector') ?>
                    <label class="sr-only" for="sector">Sector:</label>
                    <input type="text" size="20" id="sector" name="typeSector" placeholder="Sector" class="form-sector form-control" value="<?= $client->typeSector?>" required/>
                 </div>
                 <button type="submit" class="btn btn-primary">Save</button> 

         </form>
            <?php 
            }else{
                echo "Error No Existe Ningun Usuario Favor De Agregar";
            }
        ?>           
                           