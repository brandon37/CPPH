        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
              <div class="col-xs-12 col-sm-12">
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
                                    <i class="fa fa-edit"></i> Editar Departamento
                                </li> 
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <?= form_open('departments/updateDepartment/'.$id); ?>    
                      <?php 
                        if ($department){
                           ?>
                           <div class="col-xs-6 col-sm-6 well">  
                           <div class="form-group">
                               <label class="" for="Departamento">Departamento:</label><br>
                               <?= form_error('department')?>
                               <input type="text" size="20" id="Departamento" name="department" placeholder="Departmento" class="form-Departamento form-control" value="<?= $department->nameDepartment?>" required/>
                           </div>
                         <br>
                           <button type="submit" class="btn btn-primary">Save</button> 

                     </form>
                        <?php 
                        }else{
                            redirect('departments');
                        }
                    ?>           
                   </div> 
              </div>
          </div>                  