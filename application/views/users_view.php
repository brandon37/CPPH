<?php 
	if ($users){
	foreach ($users->result() as $opc) { ?>
		<ul>
			<li><a href="<?= $opc->idusuarios;?>"><?= $opc->nombre?> </a>  </li>
		</ul>


	<?php } 
	}else{
		echo "Error en la aplicacion ";
	}
?>