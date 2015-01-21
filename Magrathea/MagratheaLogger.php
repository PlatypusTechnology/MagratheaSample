<?php

class MagratheaLogger {
	private static $logFile = "/logs/log.txt";
	private static $path = __DIR__;

	public static function Log($logThis){
		$date = @date("Y-m-d h:i:s");
		$line = "[".$date."] = ".$logThis."\n\n";
		$file = self::$path.self::$logFile;
		file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
	}

}

?>