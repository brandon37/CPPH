        <?= validation_errors() ?>
        <?= form_open('departments/updateDepartment/'.$id); ?>    
          <?php 
              if ($department){
              foreach ($department->result() as $opc) { 
                 ?>
                 <div class="form-group">
                     <label class="sr-only" for="clientname">Departamento:</label>
                     <input type="text" size="20" id="clientname" name="department" placeholder="Departmento" class="form-clientname form-control" value="<?= $opc->nameDepartment?>" required/>
                 </div>
               
                 <button type="submit" class="btn btn-primary">Save</button> 

           </form>
              <?php } 
              }else{
                  echo "Error No Existe Ningun Usuario Favor De Agregar";
              }
          ?>           
                               