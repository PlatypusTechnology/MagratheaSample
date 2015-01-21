<?php

require ("admin_load.php");

	$data = $_POST;
	$object_name = $data["object_name"];
	$table_name = $data["table_name"];

	// validate object name:
	if( empty($object_name) ){ 
		echo "<!--false-->";
		?>
		<div class="alert alert-error">
			<button class="close" data-dismiss="alert" type="button">×</button>
			<strong>Oh, crap! =(</strong><br/>
			You forgot to tell us the name of the object, boy...
		</div>
		<?
		die;
	} else {
		if( !ctype_alpha ( $object_name ) ){
			echo "<!--false-->";
			?>
			<div class="alert alert-error">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<strong>Ops, you did it wrong! =(</strong></br/>
				An object name must have only chars...
			</div>
			<?
			die;
		} else {
			$object_name = ucfirst($object_name);
		}
	}

	$mconfig = new MagratheaConfig();
	$filePath = "/../configs/magrathea_objects.conf";
	$mconfig->setPath(__DIR__);
	$mconfig->setFile($filePath);
	if( !$mconfig->createFileIfNotExists() ){
		echo "<!--false-->";
		?>
		<div class="alert alert-error">
			<button class="close" data-dismiss="alert" type="button">×</button>
			<strong>Shit... error creating object!</strong><br/>
			Could not create object config file. Please, be sure that PHP can write in the folder "<?=__DIR__.$filePath?>"...
		</div>
		<?
		die;
	}
	$objdata = $mconfig->getConfig();

	$table_data = array();
	$table_data["table_name"] = $table_name;
	$table_data["db_pk"] = $data["db_pk"];
	$table_data["lazy_load"] = "true";
	
	$fields = $data["fields"];
	foreach( $fields as $f ){
		$table_data[$f."_alias"] = $data["alias_".$f];
		$table_data[$f."_type"] = $data["type_".$f];
	}

	$objdata[$object_name] = $table_data;
	$mconfig->setConfig($objdata);
	if( !$mconfig->Save(true) ){ 
		echo "<!--false-->";
		?>
		<div class="alert alert-error">
			<button class="close" data-dismiss="alert" type="button">×</button>
			<strong>Shit... error creating object!</strong><br/>
			Could not create object config file. Please, be sure that PHP can write in the folder "/configs/"...
		</div>
		<?
		die;
	}

	echo "<!--true--->";

?>
<div class="alert alert-success">
	<button class="close" data-dismiss="alert" type="button">×</button>
	<strong>Yeah, baby!</strong><br/>
	Object was <?=@($data["obj_exists"] ? "updated" : "created")?>.
</div>

