    <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Proyectos
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                              <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                          </li>

                          <li>
                              <i class="fa fa-table">
                                  <a href="<?= base_url()?>departments"> Sectores</a>
                              </i>
                          </li>

                          <li>
                             <i class="fa fa-table"> <a href="<?=base_url()?>projects/runViewDepartmentProjects/<?= $idDepartment?>"> Proyectos Del Departamento </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Editar Proyecto
                          </li>                          
                        </ol>
                    </div>
                </div>
                <?= form_open('projects/updateProjectInDeparment/'.$idProject.'/'.$idDepartment)?>    
                  <?php 
                      if ($Project){
                         ?>
                         <div class="col-xs-6 col-sm-6 well">  
                           <div class="form-group">
                              <label class="" for="projectname">Name Project:</label>
                              <?=  form_error('projectname') ?>
                              <input type="text" size="20" id="nameProject" name="projectname" value="<?= $Project->nameProject ?>" placeholder="Name Project" class="form-projectname form-control" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="text">Department:</label>
                              <?= form_error('department')?>
                              <select name="department"  class="form-control" required>
                                  <option value="<?= $department->nameDepartment?>" selected="selected" > <?= $department->nameDepartment ?></option>
                                   
                                  <?php 
                                  foreach ($departments->result() as $opt) { 
                                    if ($department->nameDepartment != $opt->nameDepartment){
                                  ?>
                                    <option value="<?=$opt->nameDepartment ?>"><?=$opt->nameDepartment?></option> 
                                 <?php
                                    }
                                  }
                                  ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="" for="price">Price:</label>
                              <?= form_error('price')?>
                              <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" value="<?=$Project->price?>" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="dateCreation">Date Creation:</label>
                              <?= form_error('dateCreation')?>
                              <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" value="<?=$Project->dateCreation?>" required/>
                           </div>
                           <div class="form-group">
                              <label class="" for="dateTermination">Date Termination:</label>
                              <?= form_error('dateTermination')?>
                              <input type="date" size="20" id="dateTermination" name="dateTermination" class="form-dateTermination form-control" value="<?=$Project->dateTermination?>" required/>
                           </div>
                           <div class="form-group">
                            <label class="" for="client">Client:</label>
                            <?= form_error('nameClient')?>
                            <select name="nameClient"  class="form-control" required>
                              <option value="<?= $client->nameClient ?>"> <?= $client->nameClient ?></option>
                                <?php 
                                foreach ($clients->result() as $opt)
                                  {                        
                                    if ($client->nameClient != $opt->nameClient)
                                     {  ?>
                                        <option value="<?=$opt->nameClient ?>"><?=$opt->nameClient?></option> 
                              <?php
                                     }
                              ?>
                              <?php
                                   }
                                
                                ?>
                            </select>
                           </div>
                           <button type="submit" class="btn btn-primary">Save</button> 
                   </form>
                      <?php 
                      }else{
                         
                      }
                  ?> 
                  </div> 
            </div>    
        </div>            
