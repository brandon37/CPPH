 
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
                             <i class="fa fa-table"> <a href="<?=base_url()?>sectors"> Sectores </a></i> 
                          </li>
                          <li>
                             <i class="fa fa-table"> <a href="<?=base_url()?>sectors/runViewSectorInClients/<?=$idSector?>"> Clientes </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Edit Clientes
                          </li> 
                       
                        </ol>
                    </div>
                </div>

          
        <?= form_open('clients/updateClientInSector/'.$id.'/'.$idSector); ?>    
          <?php 
              if ($client){
                 ?>
                
          <div class="form-group">
                    <label>Name Client:</label>
                    <?= form_error('clientname') ?>
                    <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control" value="<?= $client->nameClient?>" required/>
                 </div>
                 <div class="form-group">
                    <label>Status:</label>
                    <?= form_error('status') ?>
                    <select name="status"  class="form-control" value="<?=$client->status ?>" required>
                       <option value="Activo">Activo</option> 
                       <option value="Inactivo">Inactivo</option> 
                    </select>
                 </div>
                 <div class="form-group">
                    <label for="sector">Sector:</label>
                    <?= form_error('typeSector') ?>
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
                 <button type="submit" class="btn btn-primary text-right">Save</button> 

           </form>
           </div>
              <?php
              }else{
                  redirect('clients');
              }
          ?>    
                        
                           