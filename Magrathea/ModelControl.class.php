<?php

abstract class MagratheaModelControl{
	protected static $modelName;
	protected static $dbTable;

	public static function RunQuery($sql){
		$magdb = Magdb::Instance();
		$objects = array();
		$result = $magdb->queryAll($sql);
		foreach($result as $item){
			$splitResult = MagratheaQuery::SplitArrayResult($item);
			$new_object = new static::$modelName();
			if(count($splitResult) > 0)
				$item = $splitResult[$new_object->GetDbTable()];
			$new_object->LoadObjectFromTableRow($item);
			array_push($objects, $new_object);
		}
		return $objects;
	}
	public static function QueryResult($sql){
		return Magdb::Instance()->queryAll($sql);
	}


	public static function RunMagQuery($magQuery){ self::Run($magQuery); }

	public static function Run($magQuery){
		$array_obj = $magQuery->GetObjArray();
		if(count($array_obj) > 0){
			$objects = array();
			$result = static::QueryResult($magQuery->SQL());
			foreach ($result as $r) {
				$splitResult = MagratheaQuery::SplitArrayResult($r);
				$new_object = new static::$modelName();
				if(count($splitResult) > 0)
					$r = $splitResult[$new_object->GetDbTable()];
				$new_object->LoadObjectFromTableRow($r);
				foreach($array_obj as $obj){
					$obj->LoadObjectFromTableRow($splitResult[$obj->GetDbTable()]);
					$objname = get_class($obj);
					$new_object->$objname = clone $obj;
					unset($obj);
				}
				array_push($objects, clone $new_object);
			}
			return $objects;
		} else {
			return static::RunQuery($magQuery->SQL());
		}
	}

	public static function GetAll(){
		$sql = "SELECT * FROM ".static::$dbTable;
		return static::RunQuery($sql);
	}

	public static function GetSimpleWhere($whereSql){
		$sql = "SELECT * FROM ".static::$dbTable." WHERE ".$whereSql;
		return static::RunQuery($sql);
	}

	public static function GetWhere($arr, $condition = "AND"){
		$whereSql = MAgratheaQuery::BuildWhere($arr, $condition);
		$sql = "SELECT * FROM ".static::$dbTable." WHERE ".$whereSql;
		return static::RunQuery($sql);
	}

	public static function GetMultipleObjects($array_objects, $joinGlue, $where=""){
		$magQuery = new MagratheaQuery();
		$magQuery->Table(static::$dbTable)->SelectArrObj($array_objects)->Join($joinGlue)->Where($where);

		// db:
		$objects = array();
		$result = Magdb::Instance()->queryAll($magQuery->SQL());

		foreach($result as $item){
			// we have the result... but we have to separate it in the objects... shit, how can I do that?
			$splitResult = MagratheaQuery::SplitArrayResult($item);
			$itemArr = array();
			foreach ($array_objects as $key => $value) {
				$new_object = new $value();
				$new_object->LoadObjectFromTableRow($splitResult[$new_object->GetDbTable()]);
				$itemArr[$key] = $new_object;
			}
			array_push($objects, $itemArr);
		}
		return $objects;
	}

}

?>