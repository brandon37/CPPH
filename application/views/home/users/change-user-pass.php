    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                     Control De Usuarios
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard </a>
                            <i class="fa fa-table"> <a href="<?=base_url()?>users"> Usuarios </a></i> 
            
                        </li>
                        <li class="active">
                            <i class="fa fa-edit">Editar Usuario</i>
                        </li>
                   
                    </ol>
                </div>
            </div>
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
                  redirect('home');
              }
     ?>           
                    
           
        
