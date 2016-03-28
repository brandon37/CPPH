        <?= validation_errors() ?>
        <?= form_open('ordershopping/updateordershopping/'.$id); ?>    
          <?php 
              if ($ordershopping){
              foreach ($ordershopping->result() as $opc) { 
                 ?>
                  <div class="form-group">
                       <label class="sr-only" for="ordershoppingname">Nameordershopping:</label>
                       <input type="text" size="20" id="ordershoppingname" name="ordershoppingname" placeholder="Name ordershopping" class="form-ordershoppingname form-control" required/>
                   </div>
                   <div class="form-group">
                      <label class="sr-only" for="text">concept:</label>
                      <input type="text" size="20" id="concept" name="concept"placeholder="Departamento" class="form-concept form-control" required/>
                   </div>
                   <div class="form-group">
                      <label class="sr-only" for="amount">amount:</label>
                      <input type="text" size="20" id="amount" name="amount" placeholder="amount" class="form-amount form-control" required/>
                   </div>
                   <div class="form-group">
                      <label class="sr-only" for="dateCreation">Date Creation:</label>
                      <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" required/>
                   </div>
                   <div class="form-group">
                      <label class="sr-only" for="idproyect">idproyect:</label>
                      <input type="text" size="20" id="idproyect" name="idClient" placeholder="idproyect" class="form-idproyect form-control" required/>
                   </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save</button> 
                 </div> 
               </form>
              <?php } 
              }else{
                  echo "Error No Existe Ningun Usuario Favor De Agregar";
              }
          ?>           
                           