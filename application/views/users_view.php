<div class="">
<?php 
	if ($users){
	foreach ($users->result() as $opc) { ?>
		<ul>
			<li><?= $opc->nombre?></li>
		</ul>


	<?php } 
	}else{
		echo "Error en la aplicacion ";
	}
?>
</div>