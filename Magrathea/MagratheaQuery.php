<?php

/* * * * * 
 * 	MAGRATHEA QUERY
 * 	version: 0.7
 * 		last modified: 2013-07-29 by Paulo
 * * * * */

class MagratheaQuery{

	protected $select;
	protected $selectArr;
	protected $obj_base;
	protected $obj_array;
	protected $tables;
	protected $join;
	protected $joinArr;
	protected $where;
	protected $whereArr;
	protected $order;
	protected $limit;

	protected $sql;

	private function GiveMeThisObjectCorrect($object){
		if(is_string($object)){
			if(class_exists($object)){
				$object = new $object();
			} else {
				throw new MagratheaModelException("Model does not exists: ".$object);
			}
		}
		return $object;
	}

	public function __construct(){
		$this->obj_array = array();
		$this->select = "SELECT ";
		$this->selectArr = array();
		$this->join = "";
		$this->joinArr = array();
		$this->where = "";
		$this->whereArr = array();
		$this->order = "";
		return $this;
	}

	static public function Create(){
		return new self();
	}
	static public function Select(){
		return new self();
	}
	static public function Delete(){
		return new MagratheaQueryDelete();
	}

	static public function Insert(){
		return new MagratheaQueryInsert();
	}

	public function Table($t){
		$this->tables = $t;
		return $this;
	}
	public function Obj($obj){
		$obj = $this->GiveMeThisObjectCorrect($obj);
		$this->obj_base = $obj;
		$this->tables = $obj->GetDbTable();
		$this->SelectObj($obj);
		return $this;
	}

	public function SelectStr($sel) {
		array_push($this->selectArr, $sel);
		return $this;
	}
	public function SelectObj($obj){
		$fields = $obj->GetFieldsForSelect();
		array_push($this->selectArr, $fields);
		return $this;
	}
	public function SelectArrObj($arrObj){
		foreach ($arrObj as $key => $value) {
			$sThis = $value->GetFieldsForSelect();
			array_push($this->selectArr, $sThis);
		}
		return $this;
	}

	public function Join($joinGlue){
		array_push($this->joinArr, $joinGlue);
		return $this;
	}
	public function HasOne($object, $field){
		$object = $this->GiveMeThisObjectCorrect($object);
		$this->SelectObj($object);
		$joinGlue = " INNER JOIN ".$object->GetDbTable()." ON ".$this->obj_base->GetDbTable().".".$field." = ".$object->GetDbTable().".".$this->obj_base->GetPkName();
		array_push($this->joinArr, $joinGlue);
		array_push($this->obj_array, $object);
		return $this;
	}
	public function BelongsTo($object, $field){
		$object = $this->GiveMeThisObjectCorrect($object);
		$this->SelectObj($object);
		$joinGlue = " INNER JOIN ".$object->GetDbTable()." ON ".$object->GetDbTable().".".$field." = ".$this->obj_base->GetDbTable().".".$this->obj_base->GetPkName();
		array_push($this->joinArr, $joinGlue);
		return $this;
	}


	public function GetObjArray(){
		return $this->obj_array;
	}

	public function Where($whereSql, $condition="AND"){
		if(is_array($whereSql)){
			return $this->WhereArray($whereSql);
		}
		array_push($this->whereArr, $whereSql);
		return $this;
	}
	public function WhereArray($arr, $condition = "AND"){
		$newWhere = $this->BuildWhere($arr, $condition);
		array_push($this->whereArr, $newWhere);
		return $this;
	}

	public function Order($o){
		$this->order = $o;
		return $this;
	}

	public function Limit($l){
		$this->limit = $l;
		return $this;
	}

	public function SQL(){
		$this->sql = "";
		$sqlSelect = $this->select;
		if(count($this->selectArr) > 0){
			$sqlSelect .= implode(', ', $this->selectArr);
		} else {
			$sqlSelect .= "*";
		}
		$this->sql = $sqlSelect." FROM ".$this->tables;
		if(count($this->joinArr) > 0){
			$this->sql .= " ".implode(' ', $this->joinArr)." ";
		}
		$sqlWhere = $this->where;
		if(count($this->whereArr) > 0){
			$sqlWhere .= $this->where.implode(" AND ", $this->whereArr);
		}
		if(trim($sqlWhere)!=""){
			$this->sql .= " WHERE ".$sqlWhere;
		}
		if(trim($this->order)!=""){
			$this->sql .= " ORDER BY ".$this->order;
		}
		if(trim($this->limit)!=""){
			$this->sql .= " LIMIT ".$this->limit;
		}

		return $this->sql;
	}

	// STATIC AND HELPERS:
	public static function BuildWhere($arr, $condition){
		$first = true;
		$whereSql = "";
		foreach($arr as $field => $value){
			if( !$first ){ $whereSql .= " ".$condition; $first = false; }
			$whereSql .= " ".$field." = '".$value."' ";
			$first = false;
		}
		return $whereSql;
	}

	// gets an array with "fields" and returns it with "table.fields"
	// sample:
	// 		array_walk($joinObjDbValues, 'BuildSelect', $joinObjTable);
	public static function BuildSelect(&$value, $key, $tableName) { 
		$value = $tableName.".".$key." AS '".$tableName."/".$key."'"; 
	}
	public static function SplitArrayResult($arr){
		$returnArray = array();
		foreach ($arr as $key => $value) {
			$position = strpos($key, '/');
			if(!$position) return;

			$returnTable = substr($key, 0, $position);
			$returnField = substr($key, $position+1);

			if( @is_null($returnArray[$returnTable]) ) $returnArray[$returnTable] = array();
			$returnArray[$returnTable][$returnField] = $value;
		}
		return $returnArray;
	}


}

class MagratheaQueryInsert extends MagratheaQuery {

	private $fieldNames;
	private $arrValues;

	public function __construct(){
		$this->obj_array = array();
		$this->fieldNames = array();
		$this->arrValues = array();
		return $this;
	}

	public function Values($vals){
		foreach ($vals as $key => $value) {
			array_push($this->fieldNames, $key);
			array_push($this->arrValues, $value);
		}
		return $this;
	}

	public function SQL(){
		$this->sql = "INSERT INTO ".$this->tables;
		$this->sql .= " (".implode(', ', $this->fieldNames).") ";
		$this->sql .= " VALUES ";
		$this->sql .= " (".implode(', ', $this->arrValues).") ";
		return $this->sql;
	}

}

class MagratheaQueryDelete extends MagratheaQuery {

	public function __construct(){
		$this->obj_array = array();
		$this->join = "";
		$this->joinArr = array();
		$this->where = "";
		$this->whereArr = array();
		$this->order = "";
		return $this;
	}

	public function SQL(){
		$this->sql = "DELETE FROM ".$this->tables;
		if(count($this->joinArr) > 0){
			$this->sql .= " ".implode(' ', $this->joinArr)." ";
		}
		$sqlWhere = $this->where;
		if(count($this->whereArr) > 0){
			$sqlWhere .= $this->where.implode(" AND ", $this->whereArr);
		}
		if(trim($sqlWhere)!=""){
			$this->sql .= " WHERE ".$sqlWhere;
		}
		if(trim($this->order)!=""){
			$this->sql .= " ORDER BY ".$this->order;
		}
		return $this->sql;
	}

}



?>