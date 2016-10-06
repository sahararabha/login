<?php
class database{
	protected $local = 'localhost';
	protected $dbUser = 'projectp_db';
	protected $dbPass = '123654';
	protected $dbName = 'projectp_database';
	protected $connect;
	function __construct(){
		$this->connect = new PDO('mysql:host='.$this->local.';dbname='.$this->dbName,$this->dbUser,$this->dbPass);
		$this->connect->query("SET NAMES utf8");
	}
	
	public function insert($TblName,$param=array()){
		if($this->Existence($TblName))
		{
			$sql = 'INSERT INTO `'.$TblName.'` (`'.implode('`, `',array_keys($param)).'`) VALUES ("'.implode('", "',$param).'")';
			$res = $this->connect->query($sql);
			if($res)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	
	public function select($TblName,$rows='*' ,$join=null,$where=null,$order=null,$limit=null){
		if($this->Existence($TblName))
		{
			$query = 'SELECT '.$rows.' FROM `'.$TblName.'`';
			if($join != null)
			{
				$query .= ' JOIN '.$join;
			}
			if($where != null)
			{
				$query .= ' WHERE '.$where;
			}
			if($order != null)
			{
				$query .= ' ORDER BY '.$order;
			}
			if($limit != null)
			{
				$query .= ' LIMIT '.$limit;
			}
			return $this->connect->query($query);
		}
	}
	
	
	public function delete($TblName,$where=null){
		if($this->Existence($TblName))
		{
			$query = 'DELETE FROM `'.$TblName.'`';
			if($where != null)
			{
				$query .= ' WHERE '.$where;
			}
			$this->connect->query($query);
		}
	}
	
	public function update($TblName,$param=array(),$where){
		if($this->Existence($TblName))
		{
			$fetch = array();
			foreach($param as $fild=>$value)
			{
				$fetch[] = $fild.' = "'.$value.'"';
			}
			$query = 'UPDATE  `'.$TblName.'` SET  '.implode(',',$fetch).' WHERE  '.$where;
			$this->connect->query($query);
		}
	}
	
	
	private function Existence($table){
		$row = $this->connect->query('SHOW TABLES FROM '.$this->dbName.' LIKE "'.$table.'"');
		if($row)
		{
			$Count = $row->rowCount();
			if($Count == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}