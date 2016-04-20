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
                          <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                      </li>

                      <li>
                         <i class="fa fa-table"> <a href="<?=base_url()?>users"> Usuarios</a></i> 
          
                      </li>
                       
                      <li class="active">
                          <i class="fa fa-edit"></i> Editar Usuario
                      </li>
                   
                    </ol>
                </div>
            </div>
                  <!-- /.row -->
           <?= form_open('users/updateUser/'.$id); ?>     
               <?php 
              if ($user){
                 ?>
                <div class="col-xs-6 col-sm-6 well"> 
                <div class="form-group">
                    <label class="" for="username">User Name:</label>
                    <?= form_error('username') ?>
                    <input type="text" size="20" id="username" name="username" placeholder="Username" class="form-username form-control" value="<?= $user->nameUser?>" required/>
                </div>
                <div class="form-group">
                    <label class="" for="email">Email:</label>
                    <?= form_error('email') ?>
                    <input type="email" size="20" id="email" name="email" placeholder="Email" class="form-email form-control" value="<?= $user->email?>" required/>
                </div>
                <div class="form-group">
                    <label class="" for="password">Password:</label>
                    <?= form_error('password') ?>
                    <input type="password" size="20" id="passowrd" name="password"placeholder="Password" class="form-password form-control" value="" required/>
                </div>
                <div class="form-group">
                    <label class="" for="password">Repeat Password:</label>
                    <?= form_error('passwordconf') ?>
                    <input type="password" size="20" id="passowrd" name="passwordconf"placeholder="Repeat Password" class="form-password form-control" value="" required/>
                </div>
               <button type="submit" class="btn btn-primary">Save</button> 
           </form>

              <?php
              }else{
                  redirect('users');
              }
          ?>     
          
       </div> 

    </div>

  </div>            
      
                         
