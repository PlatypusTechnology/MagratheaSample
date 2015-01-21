<?php

require ("admin_load.php");

$table_name = $_POST["table"];
$obj_name = $_POST["object1"];
$rel_name = $_POST["object2"];


$query = "SHOW COLUMNS FROM ".$table_name;
$columns = $magdb->queryAll($query);

?>
Field for <?=$obj_name?> ID: 
<select id="relation_table_id_for_obj" name="relation_table_id_for_obj" class='input-medium'>
	<?
	foreach($columns as $c){
		echo "<option value='".$c['field']."'>".$c['field']."</option>";
	}
	?>
</select>
<br/>

Field for <?=$rel_name?> ID: 
<select id="relation_table_id_for_rel" name="relation_table_id_for_rel" class='input-medium'>
	<?
	foreach($columns as $c){
		echo "<option value='".$c['field']."'>".$c['field']."</option>";
	}
	?>
</select>
