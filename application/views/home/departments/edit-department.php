        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Departamentos
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                            </li>

                            <li>
                               <i class="fa fa-table"> <a href="<?=base_url()?>departments"> Departamentos </a></i> 
                            </li>
                           
                            <li class="active">
                                <i class="fa fa-edit"></i> Edit Departamentos
                            </li> 
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
        <?= form_open('departments/updateDepartment/'.$id); ?>    
          <?php 
              if ($department){
                 ?>
                 <div class="form-group">
                     <?= form_error('department')?>
                     <label class="sr-only" for="clientname">Departamento:</label>
                     <input type="text" size="20" id="clientname" name="department" placeholder="Departmento" class="form-clientname form-control" value="<?= $department->nameDepartment?>" required/>
                 </div>
               
                 <button type="submit" class="btn btn-primary">Save</button> 

           </form>
              <?php 
              }else{
                  redirect('departments');
              }
          ?>           
                               