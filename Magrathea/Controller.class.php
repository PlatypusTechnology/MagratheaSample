<?php

class MagratheaController {

	protected $Smarty;

	public $forceMethodCall = false;
	public $displayStatic = false;

	public function StartSmarty(){
		global $Smarty;
		$this->Smarty = $Smarty;
	}

	public function Redirect($control, $action){
		self::Load($control, $action);
		return;
	}

	public function Display($template){
		$this->Smarty->display($template);
	}

	public function DisplayStatic($staticName, $template){
		$staticName = strtolower($staticName);
		$code = $this->Smarty->fetch($template);
		$code .= "\n<!-- code generated at ".date("Y-m-d h:i:s")." -->";
		$appFolder = MagratheaConfigStatic::GetConfig($GLOBALS["environment"]."/site_path");
		$filePath = $appFolder."/Static/".$staticName;
		$file_handler = fopen($filePath, 'w');
		fwrite($file_handler, $code);
		fclose($file_handler);
		$this->LoadIfExists($staticName);
	}

	public static function LoadIfExists($staticName){
		$staticName = strtolower($staticName);
		$appFolder = MagratheaConfigStatic::GetConfig($GLOBALS["environment"]."/site_path");
		$filePath = $appFolder."/Static/".$staticName;
		if( file_exists($filePath) ){
			$code = file_get_contents($filePath);
			print($code);
			return true;
		} else {
			return false;
		}
	}

	public static function Load($controlName, $action, $params=""){
		$controlName = $controlName."Controller";

		try {
			if(!class_exists($controlName)){
				$ex = new MagratheaControllerException("Class ".$controlName." does not exist!");
				$ex->killerError = false;
				throw $ex;
			}
			$control = new $controlName;
			$control->StartSmarty();
			$control->$action($params);
		} catch (Exception $e) {
			throw $e;
			self::ErrorHandle($e);
		}
	}

	public static function ErrorHandle($ex){
		if(is_a($ex, "MagratheaException")){
			$ex->display();
			die;
		} 
		die($ex->getMessage());
	}

	public function __call($method_name, $args = array()){
		if(method_exists($this->Smarty, $method_name)){
			return call_user_func_array(array(&$this->Smarty, $method_name), $args);
		} else {
			throw new MAgratheaControlException("Function could not be found (even in Smarty):".$method_name);
			
		}
	}
	
}


?>