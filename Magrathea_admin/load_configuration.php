<?php

require ("admin_load.php");

$config = MagratheaConfigStatic::GetConfig();

?>


<div class="row-fluid">
	<div class="span12 mag_section">
		<header>
			<span class="breadc">Configuration</span>
		</header>
		<content>
			<p>General configuration for the site.</p>
		</content>
	</div>
</div>

<div class="row-fluid"><div class="span12" id="config_result"></div></div>

<form name="general_config" id="general_config" onSubmit="return false;">
<div class="row-fluid">
	<div class="span12 mag_section">
		<header class="hide_opt">
				<h3>General Configuration</h3>
				<span class="arrow toggle" style="display: none;"><a href="#"><i class="icon-chevron-down"></i></a></span>
		</header>
		<content>
<?
	foreach($config["general"] as $key => $value){
		echo "<div class='row-fluid'><div class='span3 right'>".$key."</div><div class='span9'>";
		if( $key == "use_environment" ){
			echo "<select name='use_environment' id='use_environment'>";
			foreach($config as $area => $items){
				if( $area == "general" ) continue;
				echo "<option value='".$area."'>".$area."</option>";
			}
			echo "</select>";
			echo "<span class='help-block'>\"use_environment\" is Deprecated...<br/> but here you can choose the environment that will be used...</span>";
		} else if( $value == "true" || $value == "false" ){
			echo "<input type='hidden' name='".$key."' value='false'>"; // don't worry... if the value is true, this will be overwritten...
			echo "<input class='ibutton' type='checkbox' name='".$key."' id='".$key."' value='true' ".($value=="true" ? "checked='checked'" : "")." />";
		} else {
			echo "<input type='text' name='".$key."' id='".$key."' value='".$value."'>";
		}
		echo "</div></div>";
	}
	$environment = $GLOBALS['environment'];	
?>
				<div class='row-fluid'>
					<div class='span12 center'>
						<button class='btn btn-success' onClick='saveConfig();'><i class="icon-save"></i>&nbsp;&nbsp;&nbsp;&nbsp;Save Configuration</button>
					</div>
				</div>
			</content>
		</div>
	</div>
</div>
</form>

<form name="specific_config" id="specific_config" onSubmit="return false;">
<div class="row-fluid">
	<div class="span12 mag_section">
		<header class="hide_opt">
				<h3><?=$environment?> Configuration</h3>
				<span class="arrow toggle" style="display: none;"><a href="#"><i class="icon-chevron-down"></i></a></span>
		</header>
		<content>
<?
	foreach($config[$environment] as $key => $value){
		echo "<div class='row-fluid'><div class='span3 right'>".$key."</div><div class='span9'>";
		if( $key == "use_environment" ){
			echo "<select name='use_environment' id='use_environment'>";
			foreach($config as $area => $items){
				if( $area == "general" ) continue;
				echo "<option value='".$area."'>".$area."</option>";
			}
			echo "</select>";
			echo "<span class='help-block'>Remember: The environment that you are using must match with the current objects. Otherwise you will have a bad time...</span>";
		} else if( $value == "true" || $value == "false" ){
			echo "<input type='hidden' name='".$key."' value='false'>"; // don't worry... if the value is true, this will be overwritten...
			echo "<input class='ibutton' type='checkbox' name='".$key."' id='".$key."' value='true' ".($value=="true" ? "checked='checked'" : "")." />";
		} else {
			echo "<input type='text' name='".$key."' id='".$key."' value='".$value."'>";
		}
		echo "</div></div>";
	}
?>
				<div class='row-fluid'>
					<div class='span12 center'>
						<button class='btn btn-success' onClick='saveConfig();'><i class="icon-save"></i>&nbsp;&nbsp;&nbsp;&nbsp;Save Configuration</button>
					</div>
				</div>
			</content>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
jQuery( function($) { 
	$(".ibutton").iButton({
		labelOn: "true", labelOff: "false", easing: 'easeOutBounce', duration: 500
	});
});
</script>