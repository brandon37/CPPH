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
                            <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>home">Dashboard</a>
                          </li>

                          <li>
                             <i class="fa fa-table"> <a href="<?=base_url()?>ordershopping"> Ordenes De Coḿpra </a></i> 
                          </li>
                           
                          <li class="active">
                              <i class="fa fa-edit"></i> Edit Ordenes de Compra
                          </li> 
                    </ol>
                </div>
            </div>
      <?= form_open('ordershopping/updateordershopping/'.$id); ?>    
        <?php 
            if ($ordershopping){
               ?>    
                 <div class="form-group">
                     <?= form_error('nameProyect') ?>
                     <label class="sr-only" for="nameProyect">Name Proyect:</label>
                     <select name="nameProyect"  class="form-control" value="<?= $ordershopping->nameProyect ?>" required>
                        <?php 
                        foreach ($proyects->result() as $opt) { 
                        ?>
                          <option value="<?=$opt->nameProyect ?>"><?=$opt->nameProyect?></option> 
                       <?php
                        }
                        ?>
                     </select>
                     
                 </div>
                 <div class="form-group">
                    <?= form_error('concept') ?>
                    <label class="sr-only" for="text">concept:</label>
                    <input type="text" size="20" id="concept" name="concept"placeholder="concept" class="form-concept form-control" value="<?= $ordershopping->concept ?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('amount') ?>
                    <label class="sr-only" for="amount">amount:</label>
                    <input type="text" size="20" id="amount" name="amount" placeholder="amount" class="form-amount form-control" value="<?= $ordershopping->amount ?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateCreation') ?>
                    <label class="sr-only" for="dateCreation">Date Creation:</label>
                    <input type="date" size="20" id="dateCreation" name="dateCreation" placeholder="Date Creation"  class="form-dateCreation form-control" value="<?= $ordershopping->dateCreation ?>" required/>
                 </div>
                 <div class="form-group">
                    <?= form_error('dateTermination') ?>
                    <label class="sr-only" for="dateTermination">Date Termination:</label>
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
                redirect('ordershopping');
            }
        ?>           
                           