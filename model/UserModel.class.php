<?php
	/**
	* 
	*/
	class UserModel{
		public $mysqli;
		function __construct(){
			$this->mysqli=new mysqli("localhost","root","","ztstunew");
		}
		function addUser($name,$age,$password){
			$sql = "insert into user(name,age,password) value('{$name}',{$age},'{$password}')";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function getUserInfoByName($name) {
			$sql = "select * from user where name = '{$name}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
		function getUserLists(){
			$sql= "select * from user";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
		function deleteUser($id){
			//$id = $_GET['id'] ? (int)$_GET['id'] : 0;
			$sql = "delete from user where id={$id}";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function getUserinfo($id){
			//$id = $_GET['id'] ? (int)$_GET['id'] : 0;
			$sql = "select * from user where id={$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			$info = $data[0];
			return $info;
		}
		function updateUser($id,$name,$age,$password){
			$sql = "update user set name='{$name}',age={$age},password='{$password}' where id={$id};";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		public function getUserInfoById($id){
			$sql = "select * from user where id= {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
    }