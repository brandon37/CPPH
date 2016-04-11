 <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Clientes
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                          </li>

                          <li>
                             <i class="fa fa-table"> <a href="<?=base_url()?>clients"> Clientes </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Edit Clientes
                          </li> 
                       
                        </ol>
                    </div>
                </div>
        <?= form_open('clients/updateActiveClient/'.$id); ?>    
          <?php 
              if ($client){
                 ?>
                
                 <div class="form-group">
                    <?= form_error('clientname') ?>
                    <label class="sr-only" for="clientname">NameClient:</label>
                    <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control" value="<?= $client->nameClient?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('status') ?>
                    <label class="sr-only" for="text">Status:</label>
                    <select name="status"  class="form-control" value="<?=$client->status ?>" required>
                       <option value="Activo">Activo</option> 
                       <option value="Inactivo">Inactivo</option> 
                    </select>
                 </div>
                 <div class="form-group">
                    <?= form_error('sector') ?>
                    <label class="sr-only" for="sector">Sector:</label>
                    <select name="typeSector"  class="form-control" value="<?= $client->typeSector ?>" required>
                        <?php 
                        foreach ($sectors->result() as $opt) { 
                        ?>
                          <option value="<?=$opt->typeSector ?>"><?=$opt->typeSector?></option> 
                       <?php
                        }
                        ?>
                    </select>

                 </div>
                 <button type="submit" class="btn btn-primary">Save</button> 

           </form>
              <?php
              }else{
                  redirect('clients');
              }
          ?>           
                           