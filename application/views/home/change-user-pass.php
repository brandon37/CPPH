              <?= validation_errors() ?>
                       <?= form_open('verifypass'); ?>     
                      <?php 
                          if ($user){
                          foreach ($user->result() as $opc) { 
                             ?>
                            
                            <div class="form-group">
                               <label class="sr-only" for="username">Older Password:</label>
                               <input type="text" size="20" id="oldpassword" name="oldpassword" placeholder="oldpassword" class="form-username form-control" value="<?= $opc->pass?>" required/>
                            </div>
                            <div class="form-group">
                              <label class="sr-only" for="pass">New Password:</label>
                              <input type="password" size="20" id="password" name="password" placeholder="New Password:" class="form-password form-control" value="" required/>
                            </div>
                            <div class="form-group">
                              <label class="sr-only" for="password">Repeat Password:</label>
                              <input type="password" size="20" id="passowrd2" name="password2"placeholder="Repeat Password:" class="form-password form-control" value="" required/>
                            </div>
                           

                          <?php } 
                          }else{
                              echo "Error No Existe Ningun Usuario Favor De Agregar";
                          }
                      ?>           
                               <button type="submit" class="btn btn-primary">Save Changes</button> 
                     
                 </form>
