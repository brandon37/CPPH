    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                     Control De Ordenes De Compras
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>

                        <li>
                           <i class="fa fa-table"> <a href="<?=base_url()?>sectors"> Sectores </a></i> 
                        </li>

                        <li>
                           <i class="fa fa-table"> <a href="<?=base_url()?>sectors/runViewSectorInClients/<?=$idSector?>"> Clientes </a></i> 
                        </li>
                         
                        <li>
                            <i class="fa fa-table"><a href="<?=base_url()?>clients/runViewClientProjectsInSector/<?=$idSector?>/<?=$idClient ?>"> Proyectos del Cliente</a></i> 
                        </li> 
                        <li>
                            <i class="fa fa-table"> <a href="<?=base_url()?>ordershopping/runViewOrderShoppingsProjectClientInSector/<?=$idProject?>/<?= $idClient?>/<?= $idSector ?> "> Ordenes De Compras</a></i>
                        </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Editar Orden de Compra
                          </li> 
                    </ol>
                </div>
            </div>
      <?= form_open('ordershopping/updateordershopping/'.$idProject.'/'.$idClient.'/'.$idSector); ?>    
        <?php 
            if ($ordershopping){
               ?>    
                 <div class="form-group">
                     <?= form_error('nameProject') ?>
                     <label class="" for="nameProject">Name Project:</label>
                     <select name="nameProject"  class="form-control" required>
                        <option value="<?= $ordershopping->nameProject?>" selected=selected><?= $ordershopping->nameProject?></option>
                        <?php 
                        foreach ($projects->result() as $opt) { 
                          if ($ordershopping->nameProject != $opt->nameProject)
                           {
                        ?>
                             <option value="<?=$opt->nameProject ?>"><?=$opt->nameProject?></option> 
                       <?php
                            }
                        }
                        ?>
                     </select>
                     
                 </div>
                 <div class="form-group">
                    <label class="" for="text">concept:</label>
                    <?= form_error('concept') ?>
                    <input type="text" size="20" id="concept" name="concept"placeholder="concept" class="form-concept form-control" value="<?= $ordershopping->concept ?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="" for="amount">amount:</label>
                    <?= form_error('amount') ?>
                    <input type="text" size="20" id="amount" name="amount" placeholder="amount" class="form-amount form-control" value="<?= $ordershopping->amount ?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="" for="dateCreation">Date Creation:</label>
                    <?= form_error('dateCreation') ?>
                    <input type="date" size="20" id="dateCreation" name="dateCreation" placeholder="Date Creation"  class="form-dateCreation form-control" value="<?= $ordershopping->dateCreation ?>" required/>
                 </div>
                 <div class="form-group">
                    <label class="" for="dateTermination">Date Termination:</label>
                    <?= form_error('dateTermination') ?>
                    <input type="date" size="20" id="dateTermination" name="dateTermination" placeholder="Date Termination" class="form-dateTermination form-control" value="<?= $ordershopping->dateTermination ?>" required/>
                 </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Save</button> 
               </div> 

               </div> 
             </form>
            <?php 
            }else{
                redirect('ordershopping/runViewOrderShoppingsProjectClientInSector/'.$idProject.'/'.$idClient.'/'.$idSector);
            }
        ?>           
                           