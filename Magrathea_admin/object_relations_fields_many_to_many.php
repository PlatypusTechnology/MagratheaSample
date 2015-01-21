<?php

require ("admin_load.php");

$tables = getAllTables($configSection["db_name"], $magdb);
$obj_name = $_POST["object"];

?>

use this table to make the relation:&nbsp;
<select id="relation_table" name="relation_table" class='input-medium'>
	<option value='0'>- -</option>
	<?
	foreach($tables as $table){
		echo "<option value='".$table['table_name']."'>".$table['table_name']."</option>";
	}
	?>
</select>

<br/>
<div id="relation_table_fields"></div>