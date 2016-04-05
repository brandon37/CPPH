      <?= form_open('ordershopping/updateordershopping/'.$id); ?>    
        <?php 
            if ($ordershopping){
               ?>    
                 <div class="form-group">
                     <?= form_error('nameProyect') ?>
                     <label class="sr-only" for="nameProyect">Name Proyect:</label>
                     <input type="text" size="20" id="nameProyect" name="nameProyect" placeholder="Name Proyect" class="form-nameProyect form-control" value="<?=$ordershopping->nameProyect ?>" required/>
                     
                 </div>
                 <div class="form-group">
                    <?= form_error('concept') ?>
                    <label class="sr-only" for="text">concept:</label>
                    <input type="text" size="20" id="concept" name="concept"placeholder="concept" class="form-concept form-control" value="<?= $ordershopping->concept ?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('amount') ?>
                    <label class="sr-only" for="amount">amount:</label>
                    <input type="text" size="20" id="amount" name="amount" placeholder="amount" class="form-amount form-control" value="<?= $ordershopping->amount ?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateCreation') ?>
                    <label class="sr-only" for="dateCreation">Date Creation:</label>
                    <input type="date" size="20" id="dateCreation" name="dateCreation" placeholder="Date Creation"  class="form-dateCreation form-control" value="<?= $ordershopping->dateCreation ?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateTermination') ?>
                    <label class="sr-only" for="dateTermination">Date Termination:</label>
                    <input type="date" size="20" id="dateTermination" name="dateTermination" placeholder="Date Termination" class="form-dateTermination form-control" value="<?= $ordershopping->dateTermination ?>" required/>
                 </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Save</button> 
               </div> 

               </div> 
             </form>
            <?php 
            }else{
                echo "Error No Existe Ningun Usuario Favor De Agregar";
            }
        ?>           
                           