              <?= validation_errors() ?>
                       <?= form_open('users/updateUser/'.$id); ?>     
                      <?php 
                          if ($user){
                          foreach ($user->result() as $opc) { 
                             ?>
                            
                            <div class="form-group">
                               <label class="sr-only" for="username">Username:</label>
                               <input type="text" size="20" id="username" name="username" placeholder="Username" class="form-username form-control" value="<?= $opc->nameUser?>" required/>
                            </div>
                            <div class="form-group">
                              <label class="sr-only" for="email">Email:</label>
                              <input type="email" size="20" id="email" name="email" placeholder="Email" class="form-email form-control" value="<?= $opc->email?>" required/>
                            </div>
                            <div class="form-group">
                              <label class="sr-only" for="password">Password:</label>
                              <input type="password" size="20" id="passowrd" name="password"placeholder="Password" class="form-password form-control" value="<?= $opc->pass?>" required/>
                            </div>
                           

                          <?php } 
                          }else{
                              echo "Error No Existe Ningun Usuario Favor De Agregar";
                          }
                      ?>           
                               <button type="submit" class="btn btn-primary">Save</button> 
                     
                       </form>