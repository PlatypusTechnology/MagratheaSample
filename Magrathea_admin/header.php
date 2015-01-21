<?php

  require_once ("admin_load.php");


  $config = MagratheaConfigStatic::GetConfig();

  $config_names = array();
  foreach ($config as $session => $content) {
    if($session == "general") continue;
    array_push($config_names, $session);
  }


?>

  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
          <a class="brand" href="#">Magrathea Admin</a>
          <div class="nav-collapse collapse">
            <form class="navbar-form pull-right" method="post">
              <select name="new_config_section" id="new_config_section" onChange="submit();">
                <?php
                $env = "";
                if(isset($GLOBALS['environment'])) $env = $GLOBALS['environment'];
                foreach ($config_names as $item) {
                  echo "<option name='".$item."' value='".$item."'' ".($item==$env ? "selected" : "").">".$item."</option>";
                }
                ?>
              </select>
            </form>
          </div>
      </div>
    </div>
  </div>
