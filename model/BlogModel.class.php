<?php
	class blogModel{
		public $mysqli;
		function __construct(){
			$this->mysqli = new mysqli("localhost","root","","ztstunew");
			$this->mysqli->query('set names utf8');
		}
		public function addBlog($content,$user_id){
			$sql = "insert into blog(content,user_id) value('{$content}',{$user_id})";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		public function getBlogLists(){
			$sql = "select * from blog";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
		    return $data;
		}
		// public function getUserInfoByName($name){
		// 	$sql = "select * from user where name = '{$name}'";
		// 	$res = $this->mysqli->query($sql);
		// 	$data = $res->fetch_all(MYSQL_ASSOC);
		// 	return $data[0];
		// }
	}