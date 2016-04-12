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
                             <i class="fa fa-table"> <a href="<?=base_url()?>clients/InactiveClients"> Clientes </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Edit Clientes
                          </li> 
                       
                        </ol>
                    </div>
                </div>
      <?= form_open('clients/updateInactiveClient/'.$id); ?>    
        <?php 
            if ($client){
               ?>
                 <div class="form-group">
                    <label for="clientname">NameClient:</label>
                    <?= form_error('clientname') ?>
                    <input type="text" size="20" id="clientname" name="clientname" placeholder="Name Client" class="form-clientname form-control" value="<?= $client->nameClient?>" required/>
                 </div>
                 <div class="form-group">
                    <label for="text">Status:</label>
                    <?= form_error('status') ?>
                    <select name="status"  class="form-control" required>
                        <option value="Activo">Activo</option> 
                        <option value="Inactivo">Inactivo</option> 
                  </select>
                 </div>
                  <div class="form-group">
                    <label for="sector">Sector:</label>
                    <?= form_error('sector') ?>
                    <input type="text" size="20" id="sector" name="typeSector" placeholder="Sector" class="form-sector form-control" value="<?= $client->typeSector?>" required/>
                 </div>
                 <button type="submit" class="btn btn-primary">Save</button> 

         </form>
            <?php 
            }else{
                redirect('clients/inactiveClients');
            }
        ?>           
                           