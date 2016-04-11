    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
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
                              <i class="fa fa-edit"></i> Edit Projectos
                          </li>                          
                        </ol>
                    </div>
                </div>
      <?= form_open('projects/updateProject/'.$id); ?>    
        <?php 
            if ($project){
               ?>
                 <div class="form-group">
                    <?=  form_error('projectname') ?>
                     <label class="sr-only" for="projectname">NameProject:</label>
                     <input type="text" size="20" id="nameProject" name="projectname" value="<?=$project->nameProject?>" placeholder="Name Project" class="form-projectname form-control" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('department')?>
                    <label class="sr-only" for="text">Departament:</label>
                    <select name="department"  class="form-control" value="<?= $project->nameDepartment ?>" required>
                        <?php 
                        foreach ($department->result() as $opt) { 
                        ?>
                          <option value="<?=$opt->nameDepartment ?>"><?=$opt->nameDepartment?></option> 
                       <?php
                        }
                        ?>
                    </select>
                 </div>
                 <div class="form-group">
                    <?= form_error('price')?>
                    <label class="sr-only" for="price">Price:</label>
                    <input type="text" size="20" id="price" name="price" placeholder="Price" class="form-price form-control" value="<?=$project->price?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateCreation')?>
                    <label class="sr-only" for="dateCreation">Date Creation:</label>
                    <input type="date" size="20" id="dateCreation" name="dateCreation" class="form-dateCreation form-control" value="<?=$project->dateCreation?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateTermination')?>
                    <label class="sr-only" for="dateTermination">Date Termination:</label>
                    <input type="date" size="20" id="dateTermination" name="dateTermination" class="form-dateTermination form-control" value="<?=$project->dateTermination?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('nameClient')?>
                    <label class="sr-only" for="client">Client:</label>
                    <select name="nameClient"  class="form-control" value="<?= $project->nameClient ?>" required>
                        <?php 
                        foreach ($client->result() as $opt) { 
                        ?>
                          <option value="<?=$opt->nameClient ?>"><?=$opt->nameClient?></option> 
                       <?php
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
                           