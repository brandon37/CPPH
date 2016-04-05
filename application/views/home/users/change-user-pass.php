         <?= form_open('users/updateUserPass/'.$idUser); ?>     
          <?php 
              if ($user){
                 ?>
                
                <div class="form-group">
                  <?= form_error('oldpassword') ?>
                  <label class="sr-only" for="username">Older Password:</label>
                  <input type="password" size="20" id="oldpassword" name="oldpassword" placeholder="Old Password" class="form-username form-control" value="" required/>
                </div>
                <div class="form-group">
                  <?= form_error('password') ?>
                  <label class="sr-only" for="pass">New Password:</label>
                  <input type="password" size="20" id="password" name="password" placeholder="New Password:" class="form-password form-control" value="" required/>
                </div>
                <div class="form-group">
                  <?= form_error('passwordconf') ?>
                  <label class="sr-only" for="password">Repeat Password:</label>
                  <input type="password" size="20" id="passwordconf" name="passwordconf"placeholder="Repeat Password:" class="form-password form-control" value="" required/>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button> 
          </form>
              <?php 
              }else{
                  echo "Error No Se Encontro En La Base de Datos";
              }
     ?>           
                    
           
        
