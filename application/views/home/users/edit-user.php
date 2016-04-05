       <?= form_open('users/updateUser/'.$id); ?>     
           <?php 
            if ($user){
               ?>
              
              <div class="form-group">
                  <?= form_error('username') ?>
                  <label class="sr-only" for="username">Username:</label>
                  <input type="text" size="20" id="username" name="username" placeholder="Username" class="form-username form-control" value="<?= $user->nameUser?>" required/>
              </div>
              <div class="form-group">
                  <?= form_error('email') ?>
                  <label class="sr-only" for="email">Email:</label>
                  <input type="email" size="20" id="email" name="email" placeholder="Email" class="form-email form-control" value="<?= $user->email?>" required/>
              </div>
              <div class="form-group">
                  <?= form_error('password') ?>
                  <label class="sr-only" for="password">Password:</label>
                  <input type="password" size="20" id="passowrd" name="password"placeholder="Password" class="form-password form-control" value="" required/>
              </div>
              <div class="form-group">
                  <?= form_error('passwordconf') ?>
                  <label class="sr-only" for="password">Repeat Password:</label>
                  <input type="password" size="20" id="passowrd" name="passwordconf"placeholder="Repeat Password" class="form-password form-control" value="" required/>
              </div>
             <button type="submit" class="btn btn-primary">Save</button> 
       
         </form>

            <?php
            }else{
                echo "Error No Existe Ningun Usuario Favor De Agregar";
            }
      ?>           
                         
