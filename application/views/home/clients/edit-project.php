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
                             <i class="fa fa-table"> <a href="<?=base_url()?>projects/"> Proyectos </a></i> 
                          </li>

                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Editar Proyecto
                          </li>                          
                        </ol>
                    </div>
                </div>
              <?= form_open('projects/updateProject/'.$project->idProject)?>    
                <?php 
                    if ($project){
                       ?>
                    <div class="col-xs-6 col-sm-6 well"> 
                         <div class="form-group">
                             <label class="" for="projectname">Name Project:</label>
                             <?=  form_error('projectname') ?>
                             <input type="text" size="20" id="nameProject" name="projectname" value="<?=$project->nameProject?>" placeholder="Name Project" class="form-projectname form-control" required/>
                         </div>
                         <div class="form-group">
                            <label class="" for="price">Price:</label>
                            <?= form_error('price')?>
                            <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" value="<?=$project->price?>" required/>
                         </div>
                         <div class="form-group">
                            <label class="" for="dateCreation">Date Creation:</label>
                            <?= form_error('dateCreation')?>
                            <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" value="<?=$project->dateCreation?>" required/>
                         </div>
                         <div class="form-group">
                            <input type="hidden" size="20" id="dateTermination" name="dateTermination" class="form-dateTermination form-control" value="<?=$project->dateTermination?>" required/>
                         </div>
                         <div class="form-group">
                            <label class="" for="client">Client:</label>
                            <?= form_error('nameClient')?>
                            <?php if ($client) { ?>     
                                <select name="nameClient"  class="form-control"  required>
                                    <?php 
                                    foreach ($client->result() as $opt)
                                     { 
                                    ?>
                                      <option value="<?=$opt->nameClient ?>"><?=$opt->nameClient?></option> 
                                   <?php
                                    }
                                    ?>
                                </select>
                             <?php  }else{
                                echo "<h5 class='text-danger'>Los Clientes Se Encuentran inactivos Favor De Activarlos</h5>";
                                } ?>
                         </div>

                         <button type="submit" class="btn btn-primary">Save</button> 

                 </form>
                    <?php 
                    }else{
                        redirect('projects');
                    }
                ?>     
            </div> 

        </div>

      </div>            
           
