 
   <div id="page-wrapper">

          <div class="container-fluid">

                <!-- Page Heading -->
              <div class="col-xs-12 col-sm-12">
                  
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
                                      <i class="fa fa-edit"></i> Editar Cliente
                                  </li> 
                               
                                </ol>
                            </div>
                  </div>
                    <?= form_open('clients/updateClientInSector/'.$id.'/'.$idSector); ?>    
                    <?php 
                      if ($client){
                         ?>
                  <div class="col-xs-6 col-sm-6 well">
                        <div class="form-group">
                                  <label>Name Client:</label>
                                  <?= form_error('clientname') ?>
                                  <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control" value="<?= $client->nameClient?>" required/>
                               </div>
                               <div class="form-group">
                                  <label>Status:</label>
                                  <?= form_error('status') ?>
                                  <select name="status"  class="form-control" required>
                                  <?php if($client->status == "Activo")
                                       { ?>
                                          <option value="Activo" selected="Selected">Activo</option> 
                                          <option value="Inactivo">Inactivo</option> 
                                   <?php } else 
                                          {?>
                                            <option value="Activo">Activo</option> 
                                            <option value="Inactivo" selected="Selected">Inactivo</option> 
                                      <?php } ?>
                                  </select>
                               </div>
                               <div class="form-group">
                                  <label for="sector">Sector:</label>
                                  <?= form_error('typeSector') ?>
                                  <select name="typeSector"  class="form-control" required>
                                      <option value="<?= $sector->typeSector ?>" selected="selected"> <?= $sector->typeSector ?> </option>
                                      <?php 
                                      foreach ($sectors->result() as $opt) { 
                                       if ($sector->typeSector != $opt->typeSector) 
                                        {
                                      ?>

                                        <option value="<?=$opt->typeSector ?>"><?=$opt->typeSector?></option> 
                                     <?php
                                        }
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
                </div> 
          </div>

      </div>        
                           