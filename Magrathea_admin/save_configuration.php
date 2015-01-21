<?php

require ("admin_load.php");
	
	$data = $_POST;

	$mconfig = new MagratheaConfig();
	$mconfig->setPath(__DIR__);
	$mconfig->setFile("/../configs/magrathea_objects.conf");
	$config = $mconfig->getConfig();
	$config["general"] = $data;
	$mconfig->setConfig($config);
	if( !$mconfig->Save(true) ){ 
		echo "<!--false-->";
		?>
		<div class="alert alert-error">
			<button class="close" data-dismiss="alert" type="button">×</button>
			<strong>Shit... What the fuck happened?!</strong><br/>
			Could not create object config file. Please, be sure that PHP can write in the folder "Magrathea/configs/"...
		</div>
		<?
		die;
	}

?>
<!--true--->
<div class="alert alert-success">
	<button class="close" data-dismiss="alert" type="button">×</button>
	<strong>Yeah, baby!</strong><br/>
	Configurations are saved! It works! It's alive! muahuhaua!! =P
</div>

