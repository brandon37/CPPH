        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Control De Clientes Inactivos
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>

                
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Clientes Inactivos
                            </li>
                             <p class="text-right">
                                <a href="<?=base_url()?>clients" class="btn btn-large btn-info"><i class="icon-home icon-white"></i>Active Clients</a>
                            </p>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Clientes</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Satuts</th>
                                        <th>Sector</th>
                                        <th>Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <?php 
                                        if ($query){
                                        foreach ($query->result() as $opc) { ?>
                                            <tr>
                                                <td><?= $opc->nameClient?></td>
                                                <td><?= $opc->status?></td>
                                                <td><?= $opc->typeSector?></td>
                                                <td><a href="<?=base_url()?>clients/runViewEditInactiveClient/<?=$opc->idClient?>" >Edit</a></td>
                                                <td class="text-center text-danger">
                                                    <a href="<?=base_url()?>clients/deleteInactiveClient/<?=$opc->idClient?>" class="confirmationDeleteClient">X</a>  
                                                </td>
                                            </tr>


                                        <?php } 
                                        }else{
                                            echo "Error No Existe Ningun Cliente Favor De Agregar";
                                        }
                                    ?>           
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                    <?= $pagination ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

         