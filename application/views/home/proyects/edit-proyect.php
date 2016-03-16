        <?= validation_errors() ?>
        <?= form_open('proyects/updateProyect/'.$id); ?>    
          <?php 
              if ($proyect){
              foreach ($proyect->result() as $opc) { 
                 ?>
                <div class="form-group">
                     <label class="sr-only" for="proyectname">NameProyect:</label>
                     <input type="text" size="20" id="nameProyect" name="nameProyect" value="<?=$opc->nameProyect?>" placeholder="Name Proyect" class="form-proyectname form-control" required/>
                 </div>
                 <div class="form-group">
                    <label class="sr-only" for="text">Departament:</label>
                    <input type="text" size="20" id="department" name="department"placeholder="Departamento" class="form-department form-control" value="<?=$opc->department?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="sr-only" for="price">Price:</label>
                    <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" value="<?=$opc->price?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="sr-only" for="dateCreation">Date Creation:</label>
                    <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" value="<?=$opc->dateCreation?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="sr-only" for="client">Client:</label>
                    <input type="text" size="20" id="client" name="idClient" placeholder="Client" class="form-client form-control" value="<?=$opc->idClient?>" required/>
                 </div>
                 <button type="submit" class="btn btn-primary">Save</button> 

           </form>
              <?php } 
              }else{
                  echo "Error No Existe Ningun Usuario Favor De Agregar";
              }
          ?>           
                           