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
                  <label class="" for="username">Older Password:</label>
                  <?= form_error('oldpassword') ?>
                  <input type="password" size="20" id="oldpassword" name="oldpassword" placeholder="Old Password" class="form-username form-control" value="" required/>
                </div>
                <div class="form-group">
                  <label class="" for="pass">New Password:</label>
                  <?= form_error('password') ?>
                  <input type="password" size="20" id="password" name="password" placeholder="New Password:" class="form-password form-control" value="" required/>
                </div>
                <div class="form-group">
                  <label class="" for="password">Repeat Password:</label>
                  <?= form_error('passwordconf') ?>
                  <input type="password" size="20" id="passwordconf" name="passwordconf"placeholder="Repeat Password:" class="form-password form-control" value="" required/>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button> 
          </form>
              <?php 
              }else{
                  redirect('home');
              }
     ?>           
                    
           
        
