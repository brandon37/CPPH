    <div id="page-wrapper">

        <div class="container-fluid">

                <!-- Page Heading -->
            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Projectos
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                            <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                          </li>

                          <li>
                             <i class="fa fa-table"> <a href="<?=base_url()?>projects"> Projectos </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Editar Projecto
                          </li>                          
                        </ol>
                    </div>
                </div>
              <?= form_open('projects/updateProject/'.$id); ?>    
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
                            <label class="" for="text">Department:</label>
                            <?= form_error('department')?>
                            <select name="department"  class="form-control" required> 
                            <option value="<?= $project->nameDepartment ?>" selected="selected"><?= $project->nameDepartment ?></option> 
                                <?php 
                                foreach ($department->result() as $opt) { 
                                    if ($project->nameDepartment != $opt->nameDepartment) 
                                     {
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
                            <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" value="<?=$project->price?>" required/>
                         </div>
                         <div class="form-group">
                            <label class="" for="dateCreation">Date Creation:</label>
                            <?= form_error('dateCreation')?>
                            <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" value="<?=$project->dateCreation?>" required/>
                         </div>
                         <div class="form-group">
                            <label class="" for="dateTermination">Date Termination:</label>
                            <?= form_error('dateTermination')?>
                            <input type="date" size="20" id="dateTermination" name="dateTermination" class="form-dateTermination form-control" value="<?=$project->dateTermination?>" required/>
                         </div>
                         <div class="form-group">
                            <label class="" for="client">Client:</label>
                            <?= form_error('nameClient')?>
                            <select name="nameClient"  class="form-control" value="<?= $project->nameClient ?>" required>
                                <option value="<?=$project->nameClient ?>" selected="selected" ><?=$project->nameClient?></option> 
                                <?php 
                                foreach ($client->result() as $opt) { 
                                   if ($project->nameClient != $opt->nameClient) 
                                    {
                                ?>
                                      <option value="<?=$opt->nameClient ?>"><?=$opt->nameClient?></option> 
                               <?php
                                    }
                                }
                                ?>
                            </select>
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