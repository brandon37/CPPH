  <div id="page-wrapper">

      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">
                   Control De Sectores
                  </h1>
                  <ol class="breadcrumb">
                      <li>
                          <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
          
                      </li>
                      <li>
                         <i class="fa fa-table"> <a href="<?=base_url()?>sectors"> Sectores </a></i> 
          
                      </li>
                       
                      <li class="active">
                          <i class="fa fa-edit"></i> Edit Sectores
                      </li>

                  </ol>
              </div>
          </div>
      <?= form_open('sectors/updateSector/'.$id); ?>    
        <?php 
            if ($sector){
               ?>
               <div class="form-group">
                   <?= form_error('sector')?>
                   <label class="sr-only" for="clientname">Sector:</label>
                   <input type="text" size="20" id="clientname" name="sector" placeholder="Name Sector" class="form-clientname form-control" value="<?= $sector->typeSector?>" required/>
               </div>
             
               <button type="submit" class="btn btn-primary">Save</button> 

         </form>
            <?php 
            }else{
                redirect('sectors');
            }
        ?>           
                             