    <div id="page-wrapper">

      <div class="container-fluid">

            <!-- Page Heading -->
          <div class="col-xs-12 col-sm-12">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                       Control De Usuarios
                      </h1>
                      <ol class="breadcrumb">
                          <li>
                              <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard </a>
                          </li>
                          <li class="active">
                              <i class="fa fa-edit">Editar Usuario</i>
                          </li>
                     
                      </ol>
                  </div>
              </div>           
               <?= form_open('users/updateUserProfile/'.$idUser); ?>     
              <?php 
                  if ($user){
                     ?>
                  <div class="col-xs-6 col-sm-6 well"> 
                      <div class="form-group">
                        <label class="" for="username">Name User:</label>
                        <?= form_error('username') ?>
                        <input type="text" size="20" id="nameUser" name="username" placeholder="nameUser" class="form-password form-control" value="<?= $user->nameUser?>" required/>
                      </div>
                      <div class="form-group">
                        <label class="" for="pass">Email:</label>
                        <?= form_error('mail') ?>
                        <input type="email" size="20" id="email" name="mail" placeholder="New email:" class="form-password form-control" value="<?= $user->email?>" required/>
                      </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button> 
              </form>
                  <?php 
                  }else{
                      redirect('home');
                  }
         ?>           
                   
            </div> 
        </div>

  </div>            
      
                  

