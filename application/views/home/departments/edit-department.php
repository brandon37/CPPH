        <?= validation_errors() ?>
        <?= form_open('departaments/updateDepartament/'.$id); ?>    
          <?php 
              if ($departament){
              foreach ($departament->result() as $opc) { 
                 ?>
                
                 <div class="form-group">
                     <label class="sr-only" for="clientname">Departamento:</label>
                     <input type="text" size="20" id="clientname" name="departament" placeholder="Departamento" class="form-clientname form-control" value="<?= $opc->nameDepartament?>" required/>
                 </div>
               
                 <button type="submit" class="btn btn-primary">Save</button> 

           </form>
              <?php } 
              }else{
                  echo "Error No Existe Ningun Usuario Favor De Agregar";
              }
          ?>           
                               