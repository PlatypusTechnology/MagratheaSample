<?

require_once ("admin_load.php");

$tables = getAllTables($configSection["db_name"], $magdb);
$objects = getAllObjects();

?>

  <ul class="nav nav-list bs-docs-sidenav affix menu">
    <li class="submenu"><a href="#"><i class="icon-table"></i> Tables <span class="number"><?=count($tables)?></span></a>
    	<ul class="nav nav-list menu_sublist" style="display: none;">
		<?
		if(is_array($tables)){
			foreach($tables as $tb){
				echo '<li><a href="javascript:loadTable(\''.$tb['table_name'].'\');"><i class="icon-chevron-right icon_light"></i>'.$tb['table_name'].'</a></li>';
			}
		}
		?>
    	</ul>
    </li>
    <li class="submenu"><a href="#"><i class="icon-inbox"></i> Objects <span class="number"><?=count($objects)?></span></a>
			<ul class="nav nav-list menu_sublist" style="display: none;">
		<?
		if(is_array($objects)){
			foreach($objects as $obj => $details){
				echo '<li><a href="javascript:loadObject(\''.$obj.'\');"><i class="icon-chevron-right icon_light"></i>'.$obj.'</a></li>';
			}
		}
		?>
			</ul>
    </li>
	<li><a href="javascript:loadConfig();"><i class="icon-cogs"></i> Configuration</a></li>
    <li><a href="javascript:loadCoder();"><i class="icon-pencil"></i> Generate Code</a></li>
    <li><a href="javascript:loadPlugins();"><i class="icon-lightbulb"></i> Plugins</a></li>
    <li class="submenu"><a href="javascript:loadTests();"><i class="icon-beaker"></i> Tests</a>
    	<div id="tests_response"></div>
    </li>
  </ul>

