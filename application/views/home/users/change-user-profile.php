               <?= form_open('users/updateUserProfile/'.$idUser); ?>     
              <?php 
                  if ($user){
                     ?>
     
                      <div class="form-group">
                        <?= form_error('username') ?>
                        <label class="sr-only" for="username">Name User:</label>
                        <input type="text" size="20" id="nameUser" name="username" placeholder="nameUser" class="form-password form-control" value="<?= $user->nameUser?>" required/>
                      </div>
                      <div class="form-group">
                        <?= form_error('mail') ?> 
                        <label class="sr-only" for="pass">Email:</label>
                        <input type="email" size="20" id="email" name="mail" placeholder="New email:" class="form-password form-control" value="<?= $user->email?>" required/>
                      </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button> 
              </form>
                  <?php 
                  }else{
                      echo "Error No Se Encontro En La Base de Datos";
                  }
         ?>           
                      

