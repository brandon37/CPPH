      <?= form_open('proyects/updateProyect/'.$id); ?>    
        <?php 
            if ($proyect){
               ?>
                 <div class="form-group">
                    <?=  form_error('proyectname') ?>
                     <label class="sr-only" for="proyectname">NameProyect:</label>
                     <input type="text" size="20" id="nameProyect" name="proyectname" value="<?=$proyect->nameProyect?>" placeholder="Name Proyect" class="form-proyectname form-control" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('department')?>
                    <label class="sr-only" for="text">Departament:</label>
                    <input type="text" size="20" id="department" name="department"placeholder="Departamento" class="form-department form-control" value="<?=$proyect->nameDepartment?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('price')?>
                    <label class="sr-only" for="price">Price:</label>
                    <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" value="<?=$proyect->price?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateCreation')?>
                    <label class="sr-only" for="dateCreation">Date Creation:</label>
                    <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" value="<?=$proyect->dateCreation?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateTermination')?>
                    <label class="sr-only" for="dateTermination">Date Termination:</label>
                    <input type="date" size="20" id="dateTermination" name="dateTermination" class="form-dateTermination form-control" value="<?=$proyect->dateTermination?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('nameClient')?>
                    <label class="sr-only" for="client">Client:</label>
                    <input type="text" size="20" id="client" name="nameClient" placeholder="Client" class="form-client form-control" value="<?=$proyect->nameClient?>" required/>
                 </div>

                 <button type="submit" class="btn btn-primary">Save</button> 

         </form>
            <?php 
            }else{
                echo "Error No Existe Ningun Usuario Favor De Agregar";
            }
        ?>           
                           